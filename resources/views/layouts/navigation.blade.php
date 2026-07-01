<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-neutral-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center w-full">
                <!-- Logo -->
                <div class="shrink-0 flex items-center mr-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2.5">
                        <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-600 text-white shadow-sm shadow-emerald-600/25">
                            <svg class="h-5.5 w-5.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l-.707-.707M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                        <span class="text-lg font-bold tracking-tight text-neutral-900">Earthy <span class="text-emerald-600 font-semibold">Farms</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:flex h-full items-center">
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
            </div>

            <!-- Settings Dropdown & Notifications -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-2">
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

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 px-2.5 py-1.5 border border-neutral-200/60 text-sm font-medium rounded-full text-neutral-700 bg-white hover:bg-neutral-50 focus:outline-none transition shadow-sm">
                            <span class="flex h-6 w-6 items-center justify-center rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase">
                                {{ substr(Auth::user()->name, 0, 2) }}
                            </span>
                            <span class="max-w-[100px] truncate pr-1">{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4 text-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
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

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-neutral-400 hover:text-neutral-500 hover:bg-neutral-50 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-neutral-100">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('farmers.index')" :active="request()->routeIs('farmers.*')">
                {{ __('Farmers') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('plots.index')" :active="request()->routeIs('plots.*')">
                {{ __('Plots') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('crops.index')" :active="request()->routeIs('crops.*')">
                {{ __('Crops') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('inputs.index')" :active="request()->routeIs('inputs.*')">
                {{ __('Inputs') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('soil-reports.index')" :active="request()->routeIs('soil-reports.*')">
                {{ __('Soil Reports') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('supplies.index')" :active="request()->routeIs('supplies.*')">
                {{ __('Supplies') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('observations.index')" :active="request()->routeIs('observations.*')">
                {{ __('Observations') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-3 border-t border-neutral-100 bg-neutral-50/50">
            <div class="px-4 flex items-center gap-3">
                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-100 text-emerald-800 text-sm font-bold uppercase">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </span>
                <div>
                    <div class="font-semibold text-sm text-neutral-800">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-neutral-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

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
