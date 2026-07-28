<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-neutral-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center w-full justify-between sm:justify-start">
                <!-- Logo -->
                <div class="shrink-0 flex items-center mr-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2.5">
                        <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-600 text-white shadow-sm shadow-emerald-600/25">
                            <svg class="h-5.5 w-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l-.707-.707M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                        <span class="text-lg font-bold tracking-tight text-neutral-900">ECSPL <span class="text-emerald-600 font-semibold">Farms</span></span>
                    </a>
                </div>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden sm:-my-px sm:flex h-full items-center space-x-2">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('farmers.index')" :active="request()->routeIs('farmers.*')">
                        {{ __('Farmers') }}
                    </x-nav-link>
                    <x-nav-link :href="route('plots.index')" :active="request()->routeIs('plots.*')">
                        {{ __('Plots') }}
                    </x-nav-link>
                    <x-nav-link :href="route('crops.index')" :active="request()->routeIs('crops.*')">
                        {{ __('Crops') }}
                    </x-nav-link>
                    <x-nav-link :href="route('inputs.index')" :active="request()->routeIs('inputs.*')">
                        {{ __('Inputs') }}
                    </x-nav-link>
                    <x-nav-link :href="route('soil-reports.index')" :active="request()->routeIs('soil-reports.*')">
                        {{ __('Soil Reports') }}
                    </x-nav-link>
                    <x-nav-link :href="route('supplies.index')" :active="request()->routeIs('supplies.*')">
                        {{ __('Supplies') }}
                    </x-nav-link>
                    <x-nav-link :href="route('observations.index')" :active="request()->routeIs('observations.*')">
                        {{ __('Observations') }}
                    </x-nav-link>
                </div>

                <!-- Header Actions (Notifications & Desktop Dropdown) -->
                <div class="flex items-center gap-2">
                    <!-- Notifications Dropdown -->
                    <div class="relative" x-data="{ open: false, alertCount: 0 }" id="global-notifications">
                        <button @click="open = !open" class="relative p-2 text-neutral-400 hover:text-neutral-600 hover:bg-neutral-50 rounded-full focus:outline-none transition-colors duration-200">
                            <span class="sr-only">View notifications</span>
                            <!-- Bell Icon -->
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                            </svg>
                            <span x-show="alertCount > 0" class="absolute top-1.5 right-1.5 block h-2 w-2 rounded-full bg-emerald-600 ring-2 ring-white" style="display: none;"></span>
                        </button>

                        <div x-show="open" 
                             @click.outside="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2.5 w-80 sm:w-96 origin-top-right rounded-2xl bg-white py-1.5 shadow-xl ring-1 ring-black/5 focus:outline-none z-50 border border-neutral-200/50" 
                             style="display: none;">
                            <div class="px-4 py-2.5 border-b border-neutral-100 flex items-center justify-between">
                                <span class="font-bold text-neutral-800 text-sm">Pune Agromet Alerts</span>
                                <span class="text-[10px] font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-100/50" x-text="alertCount + ' Active'"></span>
                            </div>
                            <div class="max-h-80 overflow-y-auto divide-y divide-neutral-100" id="notification-alerts-list">
                                <div class="px-4 py-6 text-center text-xs text-neutral-400">
                                    Loading regional advisories...
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Dropdown (Desktop & Mobile) -->
                    <div>
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center gap-1.5 p-0.5 sm:px-2.5 sm:py-1.5 border-transparent sm:border sm:border-neutral-200/60 text-sm font-medium rounded-full text-neutral-700 bg-transparent sm:bg-white hover:bg-neutral-50/50 sm:hover:bg-neutral-50 focus:outline-none transition sm:shadow-sm">
                                    <span class="flex h-8 w-8 sm:h-6 sm:w-6 items-center justify-center rounded-full bg-emerald-100 text-emerald-800 text-xs sm:text-[10px] font-bold uppercase shadow-sm sm:shadow-none border border-emerald-200/30 sm:border-transparent">
                                        {{ substr(Auth::user()->name, 0, 2) }}
                                    </span>
                                    <span class="hidden sm:inline max-w-[100px] truncate pr-1">{{ Auth::user()->name }}</span>
                                    <svg class="hidden sm:inline h-4 w-4 text-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 11-1.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Apple-Style Floating Bottom Dock -->
<div x-data="{ moreOpen: false }" class="sm:hidden">
    <!-- Overlay/Backdrop -->
    <div x-show="moreOpen" 
         @click="moreOpen = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-neutral-900/10 backdrop-blur-[2px] z-40"
         style="display: none;">
    </div>

    <!-- More Expandable Menu (Individual Stacking Liquid Glass Pills on the Right) -->
    <div class="fixed bottom-[84px] right-4 flex flex-col-reverse gap-2.5 items-end z-50">
        <!-- Inputs Pill -->
        @php $isInputsActive = request()->routeIs('inputs.*'); @endphp
        <a href="{{ route('inputs.index') }}" 
           x-show="moreOpen"
           x-transition:enter="transition ease-out duration-300 transform origin-bottom-right"
           x-transition:enter-start="opacity-0 translate-y-6 scale-90"
           x-transition:enter-end="opacity-100 translate-y-0 scale-100"
           x-transition:leave="transition ease-in duration-200 delay-[120ms] transform origin-bottom-right"
           x-transition:leave-start="opacity-100 translate-y-0 scale-100"
           x-transition:leave-end="opacity-0 translate-y-6 scale-90"
           class="flex items-center gap-2.5 px-4 h-11 rounded-full transition-all duration-300 border {{ $isInputsActive ? 'bg-gradient-to-b from-white to-stone-50/90 border-white text-emerald-600 font-semibold shadow-[inset_0_1px_1.5px_rgba(255,255,255,0.95),0_4px_12px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.02)]' : 'bg-gradient-to-b from-white/95 to-stone-50/90 border-white/60 hover:bg-white text-neutral-700 shadow-[inset_0_1px_1px_rgba(255,255,255,0.9),0_6px_20px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.02)]' }}"
           style="display: none;">
            <div class="p-0.5 {{ $isInputsActive ? 'text-emerald-600' : 'text-neutral-400' }}">
                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            <span class="text-xs tracking-tight">Inputs</span>
        </a>

        <!-- Soil Reports Pill -->
        @php $isSoilActive = request()->routeIs('soil-reports.*'); @endphp
        <a href="{{ route('soil-reports.index') }}" 
           x-show="moreOpen"
           x-transition:enter="transition ease-out duration-300 delay-[40ms] transform origin-bottom-right"
           x-transition:enter-start="opacity-0 translate-y-10 scale-90"
           x-transition:enter-end="opacity-100 translate-y-0 scale-100"
           x-transition:leave="transition ease-in duration-200 delay-[80ms] transform origin-bottom-right"
           x-transition:leave-start="opacity-100 translate-y-0 scale-100"
           x-transition:leave-end="opacity-0 translate-y-10 scale-90"
           class="flex items-center gap-2.5 px-4 h-11 rounded-full transition-all duration-300 border {{ $isSoilActive ? 'bg-gradient-to-b from-white to-stone-50/90 border-white text-emerald-600 font-semibold shadow-[inset_0_1px_1.5px_rgba(255,255,255,0.95),0_4px_12px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.02)]' : 'bg-gradient-to-b from-white/95 to-stone-50/90 border-white/60 hover:bg-white text-neutral-700 shadow-[inset_0_1px_1px_rgba(255,255,255,0.9),0_6px_20px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.02)]' }}"
           style="display: none;">
            <div class="p-0.5 {{ $isSoilActive ? 'text-emerald-600' : 'text-neutral-400' }}">
                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <span class="text-xs tracking-tight">Soil Reports</span>
        </a>

        <!-- Supplies Pill -->
        @php $isSuppliesActive = request()->routeIs('supplies.*'); @endphp
        <a href="{{ route('supplies.index') }}" 
           x-show="moreOpen"
           x-transition:enter="transition ease-out duration-300 delay-[80ms] transform origin-bottom-right"
           x-transition:enter-start="opacity-0 translate-y-14 scale-90"
           x-transition:enter-end="opacity-100 translate-y-0 scale-100"
           x-transition:leave="transition ease-in duration-200 delay-[40ms] transform origin-bottom-right"
           x-transition:leave-start="opacity-100 translate-y-0 scale-100"
           x-transition:leave-end="opacity-0 translate-y-14 scale-90"
           class="flex items-center gap-2.5 px-4 h-11 rounded-full transition-all duration-300 border {{ $isSuppliesActive ? 'bg-gradient-to-b from-white to-stone-50/90 border-white text-emerald-600 font-semibold shadow-[inset_0_1px_1.5px_rgba(255,255,255,0.95),0_4px_12px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.02)]' : 'bg-gradient-to-b from-white/95 to-stone-50/90 border-white/60 hover:bg-white text-neutral-700 shadow-[inset_0_1px_1px_rgba(255,255,255,0.9),0_6px_20px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.02)]' }}"
           style="display: none;">
            <div class="p-0.5 {{ $isSuppliesActive ? 'text-emerald-600' : 'text-neutral-400' }}">
                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1" />
                </svg>
            </div>
            <span class="text-xs tracking-tight">Supplies</span>
        </a>

        <!-- Observations Pill -->
        @php $isObsActive = request()->routeIs('observations.*'); @endphp
        <a href="{{ route('observations.index') }}" 
           x-show="moreOpen"
           x-transition:enter="transition ease-out duration-300 delay-[120ms] transform origin-bottom-right"
           x-transition:enter-start="opacity-0 translate-y-18 scale-90"
           x-transition:enter-end="opacity-100 translate-y-0 scale-100"
           x-transition:leave="transition ease-in duration-200 transform origin-bottom-right"
           x-transition:leave-start="opacity-100 translate-y-0 scale-100"
           x-transition:leave-end="opacity-0 translate-y-18 scale-90"
           class="flex items-center gap-2.5 px-4 h-11 rounded-full transition-all duration-300 border {{ $isObsActive ? 'bg-gradient-to-b from-white to-stone-50/90 border-white text-emerald-600 font-semibold shadow-[inset_0_1px_1.5px_rgba(255,255,255,0.95),0_4px_12px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.02)]' : 'bg-gradient-to-b from-white/95 to-stone-50/90 border-white/60 hover:bg-white text-neutral-700 shadow-[inset_0_1px_1px_rgba(255,255,255,0.9),0_6px_20px_rgba(0,0,0,0.06),0_1px_2px_rgba(0,0,0,0.02)]' }}"
           style="display: none;">
            <div class="p-0.5 {{ $isObsActive ? 'text-emerald-600' : 'text-neutral-400' }}">
                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </div>
            <span class="text-xs tracking-tight">Observations</span>
        </a>
    </div>

    <!-- Floating Dock (Apple Liquid Glass with Expanding Pills) -->
    <div class="fixed bottom-6 left-1/2 -translate-x-1/2 w-[90%] max-w-[360px] bg-gradient-to-b from-white/70 to-white/30 backdrop-blur-2xl border border-white/60 shadow-[inset_0_1.5px_1px_rgba(255,255,255,0.85),0_12px_36px_rgba(0,0,0,0.05),0_1px_3px_rgba(0,0,0,0.05)] rounded-full p-1.5 flex items-center justify-between gap-1 z-50">
        <!-- Dashboard Tab -->
        @php $isActive = request()->routeIs('dashboard'); @endphp
        <a href="{{ route('dashboard') }}" 
           class="flex items-center justify-center rounded-full h-11 transition-all duration-300 {{ $isActive ? 'bg-gradient-to-b from-white to-stone-50/90 border border-white text-emerald-600 shadow-[inset_0_1px_1.5px_rgba(255,255,255,0.95),0_3px_8px_rgba(0,0,0,0.04),0_1px_2px_rgba(0,0,0,0.02)] px-3.5 gap-2 font-medium' : 'bg-gradient-to-b from-white/20 to-white/5 w-11 border border-white/20 text-neutral-500 shadow-[inset_0_0.5px_0.5px_rgba(255,255,255,0.3)] hover:text-neutral-700 hover:bg-white/30' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            @if ($isActive)
                <span class="text-xs font-bold tracking-tight">Home</span>
            @endif
        </a>

        <!-- Farmers Tab -->
        @php $isActive = request()->routeIs('farmers.*'); @endphp
        <a href="{{ route('farmers.index') }}" 
           class="flex items-center justify-center rounded-full h-11 transition-all duration-300 {{ $isActive ? 'bg-gradient-to-b from-white to-stone-50/90 border border-white text-emerald-600 shadow-[inset_0_1px_1.5px_rgba(255,255,255,0.95),0_3px_8px_rgba(0,0,0,0.04),0_1px_2px_rgba(0,0,0,0.02)] px-3.5 gap-2 font-medium' : 'bg-gradient-to-b from-white/20 to-white/5 w-11 border border-white/20 text-neutral-500 shadow-[inset_0_0.5px_0.5px_rgba(255,255,255,0.3)] hover:text-neutral-700 hover:bg-white/30' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
            @if ($isActive)
                <span class="text-xs font-bold tracking-tight">Farmers</span>
            @endif
        </a>

        <!-- Plots Tab -->
        @php $isActive = request()->routeIs('plots.*'); @endphp
        <a href="{{ route('plots.index') }}" 
           class="flex items-center justify-center rounded-full h-11 transition-all duration-300 {{ $isActive ? 'bg-gradient-to-b from-white to-stone-50/90 border border-white text-emerald-600 shadow-[inset_0_1px_1.5px_rgba(255,255,255,0.95),0_3px_8px_rgba(0,0,0,0.04),0_1px_2px_rgba(0,0,0,0.02)] px-3.5 gap-2 font-medium' : 'bg-gradient-to-b from-white/20 to-white/5 w-11 border border-white/20 text-neutral-500 shadow-[inset_0_0.5px_0.5px_rgba(255,255,255,0.3)] hover:text-neutral-700 hover:bg-white/30' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.89-2.445c.44-.22.707-.667.707-1.16V5.241c0-.778-.73-1.341-1.48-.966l-5.02 2.51a1.156 1.156 0 01-.966 0L9.08 4.305a1.154 1.154 0 00-.966 0l-5.48 2.74A1.23 1.23 0 001.88 8.1v10.59c0 .777.729 1.34 1.48.966l5.02-2.51a1.156 1.156 0 01.966 0l4.657 2.328z" />
            </svg>
            @if ($isActive)
                <span class="text-xs font-bold tracking-tight">Plots</span>
            @endif
        </a>

        <!-- Crops Tab -->
        @php $isActive = request()->routeIs('crops.*'); @endphp
        <a href="{{ route('crops.index') }}" 
           class="flex items-center justify-center rounded-full h-11 transition-all duration-300 {{ $isActive ? 'bg-gradient-to-b from-white to-stone-50/90 border border-white text-emerald-600 shadow-[inset_0_1px_1.5px_rgba(255,255,255,0.95),0_3px_8px_rgba(0,0,0,0.04),0_1px_2px_rgba(0,0,0,0.02)] px-3.5 gap-2 font-medium' : 'bg-gradient-to-b from-white/20 to-white/5 w-11 border border-white/20 text-neutral-500 shadow-[inset_0_0.5px_0.5px_rgba(255,255,255,0.3)] hover:text-neutral-700 hover:bg-white/30' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            @if ($isActive)
                <span class="text-xs font-bold tracking-tight">Crops</span>
            @endif
        </a>

        <!-- More Tab (Corner Pill of More) -->
        @php 
            $isMoreActive = request()->routeIs('inputs.*', 'soil-reports.*', 'supplies.*', 'observations.*', 'profile.*');
        @endphp
        <button @click="moreOpen = !moreOpen" 
                class="flex items-center justify-center rounded-full h-11 transition-all duration-300 border border-white/20 text-neutral-500 shadow-[inset_0_0.5px_0.5px_rgba(255,255,255,0.3)]"
                :class="(moreOpen || {{ $isMoreActive ? 'true' : 'false' }}) 
                    ? 'bg-gradient-to-b from-white to-stone-50/90 border border-white text-emerald-600 shadow-[inset_0_1px_1.5px_rgba(255,255,255,0.95),0_3px_8px_rgba(0,0,0,0.04),0_1px_2px_rgba(0,0,0,0.02)] px-3.5 gap-2 font-medium' 
                    : 'bg-gradient-to-b from-white/20 to-white/5 w-11 border-white/20 text-neutral-500 shadow-[inset_0_0.5px_0.5px_rgba(255,255,255,0.3)] hover:text-neutral-700 hover:bg-white/30'">
            <!-- Inactive/Active Dots Icon -->
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
            </svg>
            <span x-show="moreOpen || {{ $isMoreActive ? 'true' : 'false' }}" class="text-xs font-bold tracking-tight" style="display: none;">More</span>
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cacheKey = 'pune_agromet_cache';
        const cacheTimeKey = 'pune_agromet_cache_time';
        const oneHour = 60 * 60 * 1000;

        const cachedData = localStorage.getItem(cacheKey);
        const cachedTime = localStorage.getItem(cacheTimeKey);
        const now = new Date().getTime();

        if (cachedData && cachedTime && (now - cachedTime < oneHour)) {
            processAlerts(JSON.parse(cachedData));
        } else {
            fetch('https://api.open-meteo.com/v1/forecast?latitude=18.5204&longitude=73.8567&daily=temperature_2m_max,relative_humidity_2m_max,precipitation_sum&timezone=auto&forecast_days=7')
                .then(response => response.json())
                .then(data => {
                    if (data.daily) {
                        localStorage.setItem(cacheKey, JSON.stringify(data.daily));
                        localStorage.setItem(cacheTimeKey, now);
                        processAlerts(data.daily);
                    }
                })
                .catch(error => {
                    console.error('Error fetching agromet alerts:', error);
                    const list = document.getElementById('notification-alerts-list');
                    if (list) {
                        list.innerHTML = `<div class="px-4 py-4 text-center text-xs text-neutral-400">Failed to load alerts.</div>`;
                    }
                });
        }

        function processAlerts(daily) {
            const advisories = [];
            
            // 1. Unseasonal Rain Warning
            const maxRain = Math.max(...daily.precipitation_sum);
            if (maxRain > 4) {
                advisories.push({
                    crop: 'All Crops',
                    title: 'Rainfall Alert',
                    severity: 'High',
                    alert: `Expected rainfall of up to ${maxRain}mm. Postpone sprays.`,
                    region: 'Pune District'
                });
            }

            // 2. Downy Mildew Risk (Grapes)
            const maxHumid = Math.max(...daily.relative_humidity_2m_max);
            const avgMaxTemp = daily.temperature_2m_max.reduce((a, b) => a + b, 0) / daily.temperature_2m_max.length;
            if (maxHumid > 75 && avgMaxTemp > 20 && avgMaxTemp < 32) {
                advisories.push({
                    crop: 'Grapes',
                    title: 'Downy Mildew Warning',
                    severity: 'High',
                    alert: `Mildew risk due to high humidity (${maxHumid}%). Apply copper fungicides.`,
                    region: 'Junnar & Narayangaon'
                });
            }

            // 3. Onion Purple Blotch
            const minTemp = Math.min(...daily.temperature_2m_max);
            if (maxHumid > 70 && minTemp < 18) {
                advisories.push({
                    crop: 'Onion',
                    title: 'Purple Blotch Warning',
                    severity: 'Medium',
                    alert: `Morning dew increases blight risk. Spray Mancozeb preventively.`,
                    region: 'Chakan & Khed'
                });
            }

            // 4. Heat Stress
            const maxTemp = Math.max(...daily.temperature_2m_max);
            if (maxTemp > 37) {
                advisories.push({
                    crop: 'Sugarcane',
                    title: 'Thermal Stress',
                    severity: 'High',
                    alert: `Peak temp hitting ${maxTemp}°C. Increase irrigation cycles.`,
                    region: 'Baramati & Indapur'
                });
            }

            // Update alpine component state
            const el = document.getElementById('global-notifications');
            if (el && el.__x && el.__x.$data) {
                el.__x.$data.alertCount = advisories.length;
            } else if (el) {
                // Fallback for newer Alpine instances or standard binding
                setTimeout(() => {
                    const alpineData = Alpine.$data(el);
                    if (alpineData) {
                        alpineData.alertCount = advisories.length;
                    }
                }, 100);
            }

            const list = document.getElementById('notification-alerts-list');
            if (!list) return;

            if (advisories.length === 0) {
                list.innerHTML = `
                    <div class="px-4 py-6 text-center text-xs text-neutral-400">
                        No active alerts. Weather is optimal.
                    </div>
                `;
                return;
            }

            list.innerHTML = '';
            advisories.forEach(adv => {
                const severityColor = adv.severity === 'High' ? 'text-red-600 bg-red-50 border-red-100' : 'text-amber-600 bg-amber-50 border-amber-100';
                const severityBar = adv.severity === 'High' ? 'bg-red-500' : 'bg-amber-500';
                const html = `
                    <div class="px-4 py-3 hover:bg-neutral-50/80 transition duration-150 relative overflow-hidden pl-6">
                        <span class="absolute left-0 top-0 bottom-0 w-1 ${severityBar}"></span>
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-[9px] font-bold uppercase tracking-wider text-neutral-400">${adv.region}</span>
                            <span class="px-2 py-0.5 text-[9px] font-bold rounded-full border ${severityColor}">${adv.crop}</span>
                        </div>
                        <p class="text-xs font-bold text-neutral-800 mt-1">${adv.title}</p>
                        <p class="text-[11px] text-neutral-500 mt-0.5 leading-relaxed">${adv.alert}</p>
                    </div>
                `;
                list.insertAdjacentHTML('beforeend', html);
            });
        }
    });
</script>
