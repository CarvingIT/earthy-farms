<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <!-- iOS Mobile Page Progress Bar Indicator -->
        <div id="ios-progress" class="fixed top-0 left-0 h-[2px] bg-emerald-500 z-50 transition-all duration-300 w-0" style="display: none;"></div>

        <div class="min-h-screen bg-gray-100">
            <!-- Nav Wrapper for SPA active highlights synchronization -->
            <div id="nav-wrapper">
                @include('layouts.navigation')
            </div>

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="pb-28 sm:pb-0" id="main-content">
                {{ $slot }}
            </main>
        </div>

        <style>
            /* iOS Directional Page Transitions */
            #main-content {
                transition: opacity 0.22s cubic-bezier(0.33, 1, 0.68, 1), transform 0.22s cubic-bezier(0.33, 1, 0.68, 1);
                will-change: transform, opacity;
            }
            /* Slide Left (moving forward/right in nav tabs) */
            .page-transition-out-left {
                opacity: 0;
                transform: translate3d(-32px, 0, 0);
            }
            .page-transition-enter-right {
                opacity: 0;
                transform: translate3d(32px, 0, 0);
            }
            /* Slide Right (moving backward/left in nav tabs) */
            .page-transition-out-right {
                opacity: 0;
                transform: translate3d(32px, 0, 0);
            }
            .page-transition-enter-left {
                opacity: 0;
                transform: translate3d(-32px, 0, 0);
            }
            /* Cross Dissolve (nested detail views or sub-navigation) */
            .page-transition-fade-out {
                opacity: 0;
                transform: scale3d(0.98, 0.98, 1);
            }
            .page-transition-fade-enter {
                opacity: 0;
                transform: scale3d(0.98, 0.98, 1);
            }

            /* iOS Staggered Widget Entrance Anim */
            .animate-slide-up-fade {
                animation: slideUpFade 0.32s cubic-bezier(0.33, 1, 0.68, 1) both;
            }
            @keyframes slideUpFade {
                from {
                    opacity: 0;
                    transform: translate3d(0, 15px, 0);
                }
                to {
                    opacity: 1;
                    transform: translate3d(0, 0, 0);
                }
            }
            .stagger-1 { animation-delay: 35ms; }
            .stagger-2 { animation-delay: 70ms; }
            .stagger-3 { animation-delay: 105ms; }
            .stagger-4 { animation-delay: 140ms; }
            .stagger-5 { animation-delay: 175ms; }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const main = document.getElementById('main-content');
                const navWrapper = document.getElementById('nav-wrapper');
                const progress = document.getElementById('ios-progress');
                let isNavigating = false;

                function showProgress() {
                    progress.style.display = 'block';
                    progress.style.width = '0%';
                    progress.offsetHeight; // force reflow
                    progress.style.width = '75%';
                }

                function hideProgress() {
                    progress.style.width = '100%';
                    setTimeout(() => {
                        progress.style.display = 'none';
                        progress.style.width = '0%';
                    }, 200);
                }

                // Apple tab index definition
                function getTabIndex(urlStr) {
                    try {
                        const path = new URL(urlStr).pathname;
                        if (path.startsWith('/dashboard')) return 0;
                        if (path.startsWith('/farmers')) return 1;
                        if (path.startsWith('/plots')) return 2;
                        if (path.startsWith('/crops')) return 3;
                        if (path.startsWith('/inputs')) return 4;
                        if (path.startsWith('/soil-reports')) return 5;
                        if (path.startsWith('/supplies')) return 6;
                        if (path.startsWith('/observations')) return 7;
                    } catch (e) {}
                    return 8; // nested sub-level
                }

                async function navigateTo(url, pushState = true) {
                    if (isNavigating) return;
                    isNavigating = true;
                    showProgress();

                    // Calculate navigation direction psychology
                    const currentIdx = getTabIndex(window.location.href);
                    const targetIdx = getTabIndex(url);
                    
                    let outClass = 'page-transition-out-left';
                    let enterClass = 'page-transition-enter-right';

                    if (targetIdx < currentIdx) {
                        // Sliding backward
                        outClass = 'page-transition-out-right';
                        enterClass = 'page-transition-enter-left';
                    } else if (targetIdx === currentIdx || targetIdx === 8 || currentIdx === 8) {
                        // Nested child navigation or same tab, use smooth cross-dissolve scale-fade
                        outClass = 'page-transition-fade-out';
                        enterClass = 'page-transition-fade-enter';
                    }

                    main.className = 'pb-28 sm:pb-0 ' + outClass;

                    try {
                        const response = await fetch(url);
                        if (!response.ok) throw new Error('Failed to load page');
                        const html = await response.text();

                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        
                        const newMainContent = doc.getElementById('main-content')?.innerHTML || doc.querySelector('main')?.innerHTML;
                        const newNavContent = doc.getElementById('nav-wrapper')?.innerHTML;
                        const newTitle = doc.querySelector('title')?.innerText;

                        setTimeout(() => {
                            // Update content
                            if (newMainContent) main.innerHTML = newMainContent;
                            if (newNavContent) navWrapper.innerHTML = newNavContent;
                            if (newTitle) document.title = newTitle;

                            if (pushState) {
                                history.pushState(null, '', url);
                            }

                            // Re-evaluate Alpine and Scripts
                            evalScripts(main);
                            evalScripts(navWrapper);

                            // Trigger page transition in
                            main.className = 'pb-28 sm:pb-0 ' + enterClass;
                            main.offsetHeight; // force layout
                            main.className = 'pb-28 sm:pb-0'; // reset all animation classes
                            
                            hideProgress();
                            isNavigating = false;
                        }, 120);
                    } catch (error) {
                        console.error('SPA Router Error:', error);
                        window.location.href = url; // Fallback
                    }
                }

                function evalScripts(container) {
                    if (!container) return;
                    container.querySelectorAll('script').forEach(oldScript => {
                        const newScript = document.createElement('script');
                        Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
                        newScript.appendChild(document.createTextNode(oldScript.innerHTML));
                        oldScript.parentNode.replaceChild(newScript, oldScript);
                    });
                }

                // Intercept anchor clicks
                document.body.addEventListener('click', (e) => {
                    const link = e.target.closest('a');
                    if (!link) return;

                    const href = link.getAttribute('href');
                    if (!href || href.startsWith('#') || href.startsWith('javascript:')) return;
                    if (link.hasAttribute('download') || link.getAttribute('target') === '_blank') return;

                    try {
                        const url = new URL(link.href);
                        if (url.origin !== window.location.origin) return;
                        
                        // Let authentication, logout, or administrative routes reload fully
                        if (url.pathname.includes('/logout') || url.pathname.includes('/login') || url.pathname.includes('/register')) return;

                        e.preventDefault();
                        navigateTo(link.href);
                    } catch (err) {}
                });

                // Listen to popstate
                window.addEventListener('popstate', () => {
                    navigateTo(window.location.href, false);
                });
            });
        </script>
    </body>
</html>
