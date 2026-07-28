<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="background-color: #ffffff;">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- PWA Meta Tags -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
        <meta name="apple-mobile-web-app-title" content="ECSPL Farms">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="theme-color" content="#ffffff">
        <link rel="manifest" href="/manifest.json">
        <link rel="apple-touch-icon" sizes="180x180" href="/pwa-icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/pwa-icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/pwa-icons/favicon-16x16.png">

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
                        if (url.pathname.includes('/logout') || url.pathname.includes('/login') || url.pathname.includes('/register')) {
                            if (window.navigator.standalone) {
                                e.preventDefault();
                                window.location.href = link.href;
                            }
                            return;
                        }

                        e.preventDefault();
                        navigateTo(link.href);
                    } catch (err) {}
                });

                // Listen to popstate
                window.addEventListener('popstate', () => {
                    navigateTo(window.location.href, false);
                });
            });

            // Advanced PWA Custom Prompt & Universal Install Helper
            document.addEventListener('DOMContentLoaded', () => {
                const installBanner = document.getElementById('pwa-install-banner');
                const installBtn = document.getElementById('pwa-install-btn');
                const closeBtn = document.getElementById('pwa-close-btn');
                
                const headerInstallBtn = document.getElementById('pwa-header-install-btn');
                
                const iosTooltip = document.getElementById('ios-install-tooltip');
                const iosCloseBtn = document.getElementById('ios-close-btn');

                let deferredPrompt;

                // Ensure header install button is visible by default (user requested always visible)
                if (headerInstallBtn) {
                    headerInstallBtn.style.display = 'inline-block';
                }

                // 1. Listen for Chrome/Android's install prompt
                window.addEventListener('beforeinstallprompt', (e) => {
                    e.preventDefault();
                    deferredPrompt = e;
                    
                    // Show standard floating banner after 2.5s if not running in standalone mode
                    const isStandalone = window.matchMedia('(display-mode: standalone)').matches || 
                                         window.matchMedia('(display-mode: fullscreen)').matches || 
                                         window.navigator.standalone;
                    if (!isStandalone && installBanner) {
                        setTimeout(() => {
                            installBanner.style.display = 'flex';
                            setTimeout(() => {
                                installBanner.classList.remove('translate-y-32', 'opacity-0');
                            }, 50);
                        }, 2500);
                    }
                });

                // Function to trigger native prompt
                const triggerInstall = async () => {
                    if (!deferredPrompt) return;
                    deferredPrompt.prompt();
                    const { outcome } = await deferredPrompt.userChoice;
                    console.log(`PWA Installation outcome: ${outcome}`);
                    deferredPrompt = null;
                    
                    // Hide floating banner
                    if (installBanner) {
                        installBanner.classList.add('translate-y-32', 'opacity-0');
                        setTimeout(() => { installBanner.style.display = 'none'; }, 300);
                    }
                };

                // Function to display platform-specific instructions in the tooltip
                const showInstructions = () => {
                    const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
                    const isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
                    const isAndroid = /Android/i.test(navigator.userAgent);
                    const instrText = document.getElementById('pwa-instructions-text');
                    const instrSubtitle = document.getElementById('pwa-instructions-subtitle');
                    
                    if (isIOS) {
                        if (instrSubtitle) {
                            instrSubtitle.innerText = 'Run ECSPL Farms as a full-screen app on iOS';
                        }
                        if (instrText) {
                            instrText.innerHTML = `Tap the <span class="font-bold text-neutral-800">Share button</span> <span class="inline-block px-1.5 py-0.5 bg-white border rounded shadow-sm"><svg class="w-3 h-3 inline text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3-3m0 0l3 3m-3-3v12"/></svg></span> in Safari, then select <span class="font-bold text-neutral-800">"Add to Home Screen"</span>.`;
                        }
                    } else if (isAndroid) {
                        if (instrSubtitle) {
                            instrSubtitle.innerText = 'Run ECSPL Farms as a full-screen app on Android';
                        }
                        if (instrText) {
                            instrText.innerHTML = `Tap Chrome's <span class="font-bold text-neutral-800">three-dots menu</span> <span class="inline-block px-1 bg-white border rounded shadow-sm">⋮</span>, then select <span class="font-bold text-neutral-800">"Install App"</span> or <span class="font-bold text-neutral-800">"Add to Home Screen"</span>.`;
                        }
                    } else {
                        if (instrSubtitle) {
                            instrSubtitle.innerText = 'Run ECSPL Farms as a full-screen app on Desktop';
                        }
                        if (instrText) {
                            instrText.innerHTML = `Click the <span class="font-bold text-neutral-800">Install icon</span> in your browser's address bar, or open the browser menu and select <span class="font-bold text-neutral-800">"Install ECSPL Farms"</span>.`;
                        }
                    }

                    if (iosTooltip) {
                        iosTooltip.style.display = 'flex';
                        setTimeout(() => {
                            iosTooltip.classList.remove('translate-y-32', 'opacity-0');
                        }, 50);
                    }
                };

                // Wire up desktop/mobile header install icon click
                if (headerInstallBtn) {
                    headerInstallBtn.addEventListener('click', () => {
                        if (deferredPrompt) {
                            triggerInstall();
                        } else {
                            showInstructions();
                        }
                    });
                }

                // Wire up banner install button click
                if (installBtn) {
                    installBtn.addEventListener('click', () => {
                        if (deferredPrompt) {
                            triggerInstall();
                        } else {
                            showInstructions();
                        }
                    });
                }

                if (closeBtn) {
                    closeBtn.addEventListener('click', () => {
                        installBanner.classList.add('translate-y-32', 'opacity-0');
                        setTimeout(() => { installBanner.style.display = 'none'; }, 300);
                    });
                }

                if (iosCloseBtn) {
                    iosCloseBtn.addEventListener('click', () => {
                        iosTooltip.classList.add('translate-y-32', 'opacity-0');
                        setTimeout(() => { iosTooltip.style.display = 'none'; }, 300);
                    });
                }

                // iOS Safari automatic tooltip trigger (only if not already running in standalone)
                const isStandalone = window.matchMedia('(display-mode: standalone)').matches || 
                                     window.matchMedia('(display-mode: fullscreen)').matches || 
                                     window.navigator.standalone;
                const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
                const isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
                
                if (!isStandalone && isIOS && isSafari && iosTooltip) {
                    if (!sessionStorage.getItem('ios-pwa-prompt-shown')) {
                        setTimeout(() => {
                            showInstructions();
                            sessionStorage.setItem('ios-pwa-prompt-shown', 'true');
                        }, 3500);
                    }
                }
            });
        </script>

        <!-- Advanced PWA Custom Install Banner -->
        <div id="pwa-install-banner" class="fixed bottom-24 left-1/2 -translate-x-1/2 w-[90%] max-w-md bg-white/95 backdrop-blur-md border border-neutral-200/60 shadow-2xl rounded-2xl p-4 z-[60] flex items-center justify-between gap-4 transition-all duration-300 transform translate-y-32 opacity-0" style="display: none;">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 shrink-0 rounded-xl overflow-hidden shadow-sm">
                    <img src="/pwa-icons/apple-touch-icon.png" alt="ECSPL Farms Logo" class="h-full w-full object-cover">
                </div>
                <div>
                    <h4 class="text-xs font-bold text-neutral-900">Install ECSPL Farms</h4>
                    <p class="text-[10px] text-neutral-500 leading-tight">Add to your home screen for full-screen access</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button id="pwa-install-btn" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-lg transition shadow-sm">
                    Install
                </button>
                <button id="pwa-close-btn" class="p-1.5 hover:bg-neutral-100 rounded-lg text-neutral-400 hover:text-neutral-600 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- PWA Install Guide Tooltip (Universal) -->
        <div id="ios-install-tooltip" class="fixed bottom-24 left-1/2 -translate-x-1/2 w-[90%] max-w-sm bg-white/95 backdrop-blur-md border border-neutral-200/60 shadow-2xl rounded-2xl p-4 z-[60] flex flex-col gap-2.5 transition-all duration-300 transform translate-y-32 opacity-0" style="display: none;">
            <div class="flex items-start justify-between">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 shrink-0 rounded-xl overflow-hidden shadow-sm">
                        <img src="/pwa-icons/apple-touch-icon.png" alt="ECSPL Farms Logo" class="h-full w-full object-cover">
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-neutral-900">Install ECSPL Farms</h4>
                        <p id="pwa-instructions-subtitle" class="text-[10px] text-neutral-500">Run ECSPL Farms as a full-screen app on iOS</p>
                    </div>
                </div>
                <button id="ios-close-btn" class="p-1 hover:bg-neutral-100 rounded-lg text-neutral-400 hover:text-neutral-600 transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div id="pwa-instructions-text" class="text-[11px] text-neutral-600 leading-relaxed bg-neutral-50 p-2.5 rounded-xl border border-neutral-100">
                Tap the <span class="font-bold text-neutral-800">Share button</span> <span class="inline-block px-1.5 py-0.5 bg-white border rounded shadow-sm"><svg class="w-3 h-3 inline text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15M9 12l3-3m0 0l3 3m-3-3v12"/></svg></span> in Safari, then select <span class="font-bold text-neutral-800">"Add to Home Screen"</span>.
            </div>
        </div>
    </body>
</html>
