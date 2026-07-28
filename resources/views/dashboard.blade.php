<x-app-layout>
    <!-- Root Container (Neutral System Background for Desktop vs. iOS Light Grouped Background for Mobile) -->
    <div class="py-6 sm:py-8 bg-[#f2f2f7] sm:bg-[#fafaf9] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- ========================================== -->
            <!-- 1. DESKTOP VIEWPORT LAYOUT                 -->
            <!-- ========================================== -->
            <div class="hidden sm:block space-y-8">
                <!-- Original desktop header -->
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-extrabold tracking-tight text-neutral-900">ECSPL Farms</h1>
                        <p class="text-sm text-neutral-500 mt-1">Real-time overview of your agricultural network, soil health, and crop logs.</p>
                    </div>
                    <div>
                        <span class="inline-flex items-center gap-2 text-sm font-semibold text-neutral-700 bg-white px-4 py-2 rounded-full border border-neutral-200/60 shadow-sm">
                            <span class="h-2.5 w-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            {{ now()->format('l, M d, Y') }}
                        </span>
                    </div>
                </div>

                @if(session('success'))
                    <div class="p-4 bg-emerald-50 border border-emerald-200/50 text-emerald-800 rounded-2xl text-sm flex items-center space-x-2 shadow-sm">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-semibold text-base">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Original 5-column bento grid for desktop -->
                <div class="grid grid-cols-5 gap-5">
                    <!-- Stat 1: Farmers -->
                    <div class="bg-white rounded-2xl border border-neutral-200/50 p-6 shadow-[0_8px_30px_rgb(0,0,0,0.015)] hover:-translate-y-0.5 hover:shadow-[0_12px_40px_rgb(0,0,0,0.03)] transition-all duration-300 flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-neutral-400">Farmers</span>
                            <span class="p-2 rounded-xl bg-emerald-50 text-emerald-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </span>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-3xl font-extrabold text-neutral-900">{{ $stats['farmers'] }}</h3>
                            <p class="text-xs text-neutral-500 mt-1">Active growers</p>
                        </div>
                    </div>

                    <!-- Stat 2: Plots -->
                    <div class="bg-white rounded-2xl border border-neutral-200/50 p-6 shadow-[0_8px_30px_rgb(0,0,0,0.015)] hover:-translate-y-0.5 hover:shadow-[0_12px_40px_rgb(0,0,0,0.03)] transition-all duration-300 flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-neutral-400">Plots</span>
                            <span class="p-2 rounded-xl bg-amber-50 text-amber-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                            </span>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-3xl font-extrabold text-neutral-900">{{ $stats['plots'] }}</h3>
                            <p class="text-xs text-neutral-500 mt-1">Cultivated sectors</p>
                        </div>
                    </div>

                    <!-- Stat 3: Crops -->
                    <div class="bg-white rounded-2xl border border-neutral-200/50 p-6 shadow-[0_8px_30px_rgb(0,0,0,0.015)] hover:-translate-y-0.5 hover:shadow-[0_12px_40px_rgb(0,0,0,0.03)] transition-all duration-300 flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-neutral-400">Active Crops</span>
                            <span class="p-2 rounded-xl bg-teal-50 text-teal-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </span>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-3xl font-extrabold text-neutral-900">{{ $stats['crops'] }}</h3>
                            <p class="text-xs text-neutral-500 mt-1">In-season varieties</p>
                        </div>
                    </div>

                    <!-- Stat 4: Area -->
                    <div class="bg-white rounded-2xl border border-neutral-200/50 p-6 shadow-[0_8px_30px_rgb(0,0,0,0.015)] hover:-translate-y-0.5 hover:shadow-[0_12px_40px_rgb(0,0,0,0.03)] transition-all duration-300 flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-neutral-400">Total Area</span>
                            <span class="p-2 rounded-xl bg-lime-50 text-lime-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h2a2.5 2.5 0 002.5-2.5V8.5a.5.5 0 01.5-.5h.5m-6 9a2 2 0 002-2v-1a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </span>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-3xl font-extrabold text-neutral-900">{{ number_format($stats['total_area'], 1) }} <span class="text-sm font-normal text-neutral-400">Acres</span></h3>
                            <p class="text-xs text-neutral-500 mt-1">Managed acreage</p>
                        </div>
                    </div>

                    <!-- Stat 5: Inputs -->
                    <div class="bg-white rounded-2xl border border-neutral-200/50 p-6 shadow-[0_8px_30px_rgb(0,0,0,0.015)] hover:-translate-y-0.5 hover:shadow-[0_12px_40px_rgb(0,0,0,0.03)] transition-all duration-300 flex flex-col justify-between">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-bold uppercase tracking-wider text-neutral-400">Materials</span>
                            <span class="p-2 rounded-xl bg-neutral-100 text-neutral-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </span>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-3xl font-extrabold text-neutral-900">{{ $stats['inputs'] }}</h3>
                            <p class="text-xs text-neutral-500 mt-1">Inventory catalog</p>
                        </div>
                    </div>
                </div>

                <!-- Desktop Symmetrical 3-Column Layout -->
                <div class="grid grid-cols-4 gap-6">
                    <!-- Column 1: Control Center & Observations -->
                    <div class="col-span-1 space-y-6 flex flex-col">
                        <div class="bg-white rounded-2xl border border-neutral-200/60 p-6 shadow-[0_8px_30px_rgb(0,0,0,0.015)]">
                            <div class="mb-5 border-b border-neutral-100 pb-3">
                                <h2 class="text-lg font-bold text-neutral-900">Control Center</h2>
                                <p class="text-xs text-neutral-500 mt-0.5">Quickly record daily operations.</p>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-3.5">
                                <a href="{{ route('farmers.create') }}" class="group flex flex-col justify-between p-4 rounded-xl bg-neutral-50/60 hover:bg-emerald-950 hover:text-white transition-all duration-300 border border-neutral-200/40 hover:border-emerald-950">
                                    <span class="p-2 rounded-lg bg-white group-hover:bg-emerald-900/50 w-fit transition-colors">
                                        <svg class="w-5 h-5 text-neutral-500 group-hover:text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                                    </span>
                                    <div class="mt-4">
                                        <span class="text-sm font-bold block text-neutral-800 group-hover:text-white">Grower</span>
                                        <span class="text-xs text-neutral-400 group-hover:text-emerald-200 mt-1 block">Add Partner</span>
                                    </div>
                                </a>

                                <a href="{{ route('plots.create') }}" class="group flex flex-col justify-between p-4 rounded-xl bg-neutral-50/60 hover:bg-emerald-950 hover:text-white transition-all duration-300 border border-neutral-200/40 hover:border-emerald-950">
                                    <span class="p-2 rounded-lg bg-white group-hover:bg-emerald-900/50 w-fit transition-colors">
                                        <svg class="w-5 h-5 text-neutral-500 group-hover:text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                                    </span>
                                    <div class="mt-4">
                                        <span class="text-sm font-bold block text-neutral-800 group-hover:text-white">Plot</span>
                                        <span class="text-xs text-neutral-400 group-hover:text-emerald-200 mt-1 block">Subdivide Land</span>
                                    </div>
                                </a>

                                <a href="{{ route('crops.create') }}" class="group flex flex-col justify-between p-4 rounded-xl bg-neutral-50/60 hover:bg-emerald-950 hover:text-white transition-all duration-300 border border-neutral-200/40 hover:border-emerald-950">
                                    <span class="p-2 rounded-lg bg-white group-hover:bg-emerald-900/50 w-fit transition-colors">
                                        <svg class="w-5 h-5 text-neutral-500 group-hover:text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l-.707-.707M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </span>
                                    <div class="mt-4">
                                        <span class="text-sm font-bold block text-neutral-800 group-hover:text-white">Sow Crop</span>
                                        <span class="text-xs text-neutral-400 group-hover:text-emerald-200 mt-1 block">Plant Season</span>
                                    </div>
                                </a>

                                <a href="{{ route('inputs.create') }}" class="group flex flex-col justify-between p-4 rounded-xl bg-neutral-50/60 hover:bg-emerald-950 hover:text-white transition-all duration-300 border border-neutral-200/40 hover:border-emerald-950">
                                    <span class="p-2 rounded-lg bg-white group-hover:bg-emerald-900/50 w-fit transition-colors">
                                        <svg class="w-5 h-5 text-neutral-500 group-hover:text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                    </span>
                                    <div class="mt-4">
                                        <span class="text-sm font-bold block text-neutral-800 group-hover:text-white">Material</span>
                                        <span class="text-xs text-neutral-400 group-hover:text-emerald-200 mt-1 block">Add Inventory</span>
                                    </div>
                                </a>

                                <a href="{{ route('soil-reports.create') }}" class="group flex flex-col justify-between p-4 rounded-xl bg-neutral-50/60 hover:bg-emerald-950 hover:text-white transition-all duration-300 border border-neutral-200/40 hover:border-emerald-950">
                                    <span class="p-2 rounded-lg bg-white group-hover:bg-emerald-900/50 w-fit transition-colors">
                                        <svg class="w-5 h-5 text-neutral-500 group-hover:text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                                    </span>
                                    <div class="mt-4">
                                        <span class="text-sm font-bold block text-neutral-800 group-hover:text-white">Soil Test</span>
                                        <span class="text-xs text-neutral-400 group-hover:text-emerald-200 mt-1 block">Log Analysis</span>
                                    </div>
                                </a>

                                <a href="{{ route('supplies.create') }}" class="group flex flex-col justify-between p-4 rounded-xl bg-neutral-50/60 hover:bg-emerald-950 hover:text-white transition-all duration-300 border border-neutral-200/40 hover:border-emerald-950">
                                    <span class="p-2 rounded-lg bg-white group-hover:bg-emerald-900/50 w-fit transition-colors">
                                        <svg class="w-5 h-5 text-neutral-500 group-hover:text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0zM13 11V6a1 1 0 012 0v5h4v3H5v-3h8z"></path></svg>
                                    </span>
                                    <div class="mt-4">
                                        <span class="text-sm font-bold block text-neutral-800 group-hover:text-white">Apply Input</span>
                                        <span class="text-xs text-neutral-400 group-hover:text-emerald-200 mt-1 block">Distribute</span>
                                    </div>
                                </a>

                                <a href="{{ route('observations.create') }}" class="group flex flex-col justify-between p-4 rounded-xl bg-neutral-50/60 hover:bg-emerald-950 hover:text-white transition-all duration-300 border border-neutral-200/40 hover:border-emerald-950 col-span-2">
                                    <div class="flex items-center gap-4">
                                        <span class="p-2 rounded-lg bg-white group-hover:bg-emerald-900/50 w-fit transition-colors">
                                            <svg class="w-5 h-5 text-neutral-500 group-hover:text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </span>
                                        <div>
                                            <span class="text-sm font-bold block text-neutral-800 group-hover:text-white">Field Observation</span>
                                            <span class="text-xs text-neutral-400 group-hover:text-emerald-200 mt-1 block">Log Crop Status & Health Notes</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Recent Observations Bento -->
                        <div class="bg-white rounded-2xl border border-neutral-200/60 p-6 shadow-[0_8px_30px_rgb(0,0,0,0.015)] flex-1 flex flex-col" x-data="{ expanded: false }">
                            <div class="flex items-center justify-between mb-5 border-b border-neutral-100 pb-3">
                                <div>
                                    <h2 class="text-lg font-bold text-neutral-900">Field Observations</h2>
                                    <p class="text-xs text-neutral-500 mt-0.5">Crop logs and agronomy updates.</p>
                                </div>
                                <a href="{{ route('observations.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-600 hover:text-emerald-800 transition-colors">
                                    Timeline
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>

                            @if($stats['recent_observations']->isEmpty())
                                <div class="flex-1 flex items-center justify-center py-8 text-center text-sm text-neutral-400 bg-neutral-50/50 rounded-2xl border border-dashed border-neutral-200">
                                    No observations logged yet.
                                </div>
                            @else
                                <div class="relative pl-5 border-l-2 border-neutral-200 space-y-6 ml-2.5">
                                    @foreach($stats['recent_observations'] as $index => $obs)
                                        <div class="relative" x-show="expanded || {{ $index }} < 2" x-transition.duration.200ms>
                                            <span class="absolute -left-[26px] top-1 flex h-3.5 w-3.5 items-center justify-center rounded-full bg-emerald-600 ring-4 ring-white"></span>
                                            <div class="flex flex-col gap-1.5">
                                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                                    <div class="flex flex-wrap items-center gap-2">
                                                        <span class="text-sm font-bold text-neutral-800">{{ $obs->crop->name }}</span>
                                                        <span class="text-xs text-neutral-400">by {{ $obs->crop->plot->farmer->name }}</span>
                                                    </div>
                                                    <span class="text-xs text-neutral-400 font-medium">{{ \Carbon\Carbon::parse($obs->observation_date)->diffForHumans() }}</span>
                                                </div>
                                                <div class="text-xs font-semibold text-neutral-500 bg-neutral-100 px-2.5 py-1 rounded-full w-fit">
                                                    {{ $obs->crop->plot->name }}
                                                </div>
                                                <div class="mt-1 p-4 rounded-xl bg-neutral-50/60 border border-neutral-200/30">
                                                    <p class="text-sm text-neutral-600 leading-relaxed italic">
                                                        "{{ $obs->observation }}"
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                @if($stats['recent_observations']->count() > 2)
                                    <div class="mt-auto pt-5 border-t border-neutral-100 flex justify-center">
                                        <button @click="expanded = !expanded" class="text-xs font-bold text-emerald-600 hover:text-emerald-800 transition-colors inline-flex items-center gap-1">
                                            <span x-text="expanded ? 'Show Less' : 'Show All ({{ $stats['recent_observations']->count() }})'"></span>
                                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': expanded }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>

                    <!-- Column 2: Soil Health & Diagnostics -->
                    <div class="col-span-2 space-y-6 flex flex-col">
                        <div class="bg-gradient-to-r from-emerald-900 to-teal-950 text-white rounded-2xl p-6 shadow-md flex items-center justify-between gap-4">
                            <div class="flex items-start gap-4">
                                <span class="p-3 rounded-xl bg-emerald-800/50 border border-emerald-700/50 shrink-0 text-emerald-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                                </span>
                                <div>
                                    <h3 class="text-lg font-bold">Soil Diagnostics Summary</h3>
                                    <p class="text-sm text-emerald-200/90 mt-1 leading-relaxed">
                                        Average pH across tested plots is <span class="font-bold text-white">6.8 (Optimal)</span>. Microbial activity shows excellent biological health. Review nutrient diagnostics below for site-specific treatment.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl border border-neutral-200/60 p-6 shadow-[0_8px_30px_rgb(0,0,0,0.015)] flex-1 flex flex-col">
                            <div class="flex items-center justify-between mb-5 border-b border-neutral-100 pb-3">
                                <div>
                                    <h2 class="text-lg font-bold text-neutral-900">Soil Analysis Diagnostics</h2>
                                    <p class="text-xs text-neutral-500 mt-0.5">Nutritional profiles and biochemical soil metrics.</p>
                                </div>
                                <a href="{{ route('soil-reports.index') }}" class="inline-flex items-center gap-1 text-xs font-bold text-emerald-600 hover:text-emerald-800 transition-colors">
                                    View Logs
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>

                            @if($stats['recent_soil_reports']->isEmpty())
                                <div class="flex-1 flex items-center justify-center py-12 text-center text-sm text-neutral-400 bg-neutral-50/50 rounded-2xl border border-dashed border-neutral-200">
                                    No soil diagnostic reports recorded.
                                </div>
                            @else
                                <div class="grid grid-cols-2 gap-5 flex-1">
                                    @foreach($stats['recent_soil_reports'] as $report)
                                        <div class="p-5 rounded-2xl border border-neutral-200/60 bg-white shadow-sm flex flex-col justify-between gap-5 hover:border-neutral-300 transition-colors duration-250">
                                            <div>
                                                <div class="flex justify-between items-start gap-4">
                                                    <div>
                                                        <h4 class="text-base font-bold text-neutral-800">{{ $report->crop->name }}</h4>
                                                        <p class="text-xs font-semibold text-neutral-400 mt-0.5">{{ $report->crop->variety }}</p>
                                                    </div>
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/40">
                                                        pH {{ $report->Ph }}
                                                    </span>
                                                </div>
                                                <p class="text-xs text-neutral-500 mt-2.5">Plot: <span class="font-semibold text-neutral-700">{{ $report->crop->plot->name }}</span> • {{ $report->crop->plot->farmer->name }}</p>
                                                
                                                <div class="mt-5 space-y-3">
                                                    <div class="space-y-1">
                                                        <div class="flex justify-between text-xs font-bold text-neutral-500">
                                                            <span>Nitrogen (N)</span>
                                                            <span class="text-neutral-800">{{ $report->N }} mg/kg</span>
                                                        </div>
                                                        <div class="h-2 w-full bg-neutral-100 rounded-full overflow-hidden">
                                                            <div class="h-full bg-emerald-500 rounded-full" style="width: {{ min(100, ($report->N / 350) * 100) }}%"></div>
                                                        </div>
                                                    </div>
                                                    <div class="space-y-1">
                                                        <div class="flex justify-between text-xs font-bold text-neutral-500">
                                                            <span>Phosphorus (P)</span>
                                                            <span class="text-neutral-800">{{ $report->P }} mg/kg</span>
                                                        </div>
                                                        <div class="h-2 w-full bg-neutral-100 rounded-full overflow-hidden">
                                                            <div class="h-full bg-amber-500 rounded-full" style="width: {{ min(100, ($report->P / 50) * 100) }}%"></div>
                                                        </div>
                                                    </div>
                                                    <div class="space-y-1">
                                                        <div class="flex justify-between text-xs font-bold text-neutral-500">
                                                            <span>Potassium (K)</span>
                                                            <span class="text-neutral-800">{{ $report->K }} mg/kg</span>
                                                        </div>
                                                        <div class="h-2 w-full bg-neutral-100 rounded-full overflow-hidden">
                                                            <div class="h-full bg-teal-500 rounded-full" style="width: {{ min(100, ($report->K / 400) * 100) }}%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="flex justify-between items-center text-xs text-neutral-400 border-t border-neutral-100 pt-3">
                                                <span>Tested: {{ \Carbon\Carbon::parse($report->sample_date)->format('M d, Y') }}</span>
                                                <span class="font-bold text-emerald-600 inline-flex items-center gap-1 bg-emerald-50/50 px-2 py-1 rounded-lg border border-emerald-100">
                                                    🧬 {{ number_format($report->microbial_count / 1000000, 1) }}M CFU/g
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-6 pt-5 border-t border-neutral-100/80">
                                    <h3 class="text-[11px] font-bold text-neutral-400 uppercase tracking-wider mb-3">Deccan Basin Soil Management Guidelines</h3>
                                    <div class="grid grid-cols-3 gap-4">
                                        <div class="p-3.5 rounded-xl bg-amber-50/40 border border-amber-100/50 flex flex-col justify-between">
                                            <div>
                                                <div class="flex items-center gap-1.5 text-amber-800 font-bold text-xs">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                                    Nitrogen (N)
                                                </div>
                                                <p class="text-[10px] text-neutral-500 mt-1.5 leading-relaxed">Deccan soils are naturally low in N. Supplement with neem-coated urea or vermicompost during crop vegetative phase.</p>
                                            </div>
                                        </div>
                                        <div class="p-3.5 rounded-xl bg-emerald-50/40 border border-emerald-100/50 flex flex-col justify-between">
                                            <div>
                                                <div class="flex items-center gap-1.5 text-emerald-800 font-bold text-xs">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                                    Phosphorus (P)
                                                </div>
                                                <p class="text-[10px] text-neutral-500 mt-1.5 leading-relaxed">Calcareous conditions fix phosphorus. Band-place Single Super Phosphate (SSP) near the root zone for optimal uptake.</p>
                                            </div>
                                        </div>
                                        <div class="p-3.5 rounded-xl bg-blue-50/40 border border-blue-100/50 flex flex-col justify-between">
                                            <div>
                                                <div class="flex items-center gap-1.5 text-blue-800 font-bold text-xs">
                                                    <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>
                                                    Potassium (K)
                                                </div>
                                                <p class="text-[10px] text-neutral-500 mt-1.5 leading-relaxed">Black cotton soils are K-rich. Reserve potassium fertilizers for high-demand crops like sugarcane or grapes.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Column 3: Live Agromet & Forecast -->
                    <div class="col-span-1 space-y-6 flex flex-col">
                        <div class="bg-white rounded-2xl border border-neutral-200/60 p-6 shadow-[0_8px_30px_rgb(0,0,0,0.015)]">
                            <div class="flex items-center justify-between mb-5 border-b border-neutral-100 pb-3">
                                <div>
                                    <h2 class="text-lg font-bold text-neutral-900">Pune Field Telemetry</h2>
                                    <p class="text-xs text-neutral-500 mt-0.5">Live Deccan Plateau grid readings.</p>
                                </div>
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-100 animate-pulse">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    Live Feed
                                </span>
                            </div>

                            <div class="mb-5 p-3 rounded-xl bg-neutral-50/50 border border-neutral-200/30 flex items-center justify-between">
                                <span class="text-xs font-semibold text-neutral-500">Current Sky:</span>
                                <span class="text-xs font-bold text-neutral-800 flex items-center gap-1.5" id="telemetry-condition">
                                    <span class="animate-pulse text-xs">☀️</span> Loading...
                                </span>
                            </div>

                            <div class="grid grid-cols-2 gap-4" id="telemetry-grid">
                                <div class="p-4 rounded-xl bg-neutral-50/60 border border-neutral-200/30">
                                    <span class="text-xs font-bold text-neutral-400 uppercase tracking-wider block">Air Temp</span>
                                    <div class="flex items-baseline gap-1 mt-2">
                                        <span class="text-2xl font-extrabold text-neutral-800" id="telemetry-temp">--</span>
                                        <span class="text-sm font-semibold text-neutral-500">°C</span>
                                    </div>
                                </div>
                                <div class="p-4 rounded-xl bg-neutral-50/60 border border-neutral-200/30">
                                    <span class="text-xs font-bold text-neutral-400 uppercase tracking-wider block">Humidity</span>
                                    <div class="flex items-baseline gap-1 mt-2">
                                        <span class="text-2xl font-extrabold text-neutral-800" id="telemetry-humidity">--</span>
                                        <span class="text-sm font-semibold text-neutral-500">%</span>
                                    </div>
                                </div>
                                <div class="p-4 rounded-xl bg-neutral-50/60 border border-neutral-200/30">
                                    <span class="text-xs font-bold text-neutral-400 uppercase tracking-wider block">Soil Temp</span>
                                    <div class="flex items-baseline gap-1 mt-2">
                                        <span class="text-2xl font-extrabold text-neutral-800" id="telemetry-soil-temp">--</span>
                                        <span class="text-sm font-semibold text-neutral-500">°C</span>
                                    </div>
                                </div>
                                <div class="p-4 rounded-xl bg-neutral-50/60 border border-neutral-200/30">
                                    <span class="text-xs font-bold text-neutral-400 uppercase tracking-wider block">Soil Moisture</span>
                                    <div class="flex items-baseline gap-1 mt-2">
                                        <span class="text-2xl font-extrabold text-neutral-800" id="telemetry-soil-moisture">--</span>
                                        <span class="text-sm font-semibold text-neutral-500">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl border border-neutral-200/60 p-6 shadow-[0_8px_30px_rgb(0,0,0,0.015)] flex-1 flex flex-col">
                            <div class="mb-5 border-b border-neutral-100 pb-3 flex justify-between items-center">
                                <div>
                                    <h2 class="text-lg font-bold text-neutral-900">7-Day Agromet Forecast</h2>
                                    <p class="text-xs text-neutral-500 mt-0.5">Micro-climate trend for Pune grid.</p>
                                </div>
                                <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-100">Deccan Basin</span>
                            </div>

                            <div class="space-y-3.5 flex-1" id="forecast-list">
                                <div class="animate-pulse space-y-3">
                                    <div class="h-10 bg-neutral-100 rounded-xl"></div>
                                    <div class="h-10 bg-neutral-100 rounded-xl"></div>
                                    <div class="h-10 bg-neutral-100 rounded-xl"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- 2. MOBILE VIEWPORT LAYOUT (NATIVE iOS STYLE) -->
            <!-- ========================================== -->
            <div class="sm:hidden space-y-6">
                <!-- iOS Bold Page Header -->
                <div class="flex flex-col gap-0.5">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-emerald-600">ECSPL Farms</span>
                    <h1 class="text-3.5xl font-black tracking-tight text-neutral-900">Dashboard</h1>
                    <span class="text-xs font-semibold text-neutral-400 mt-0.5">{{ now()->format('l, F d') }}</span>
                </div>

                <!-- Weather Hero Widget (Frosted Glass Apple Weather style) -->
                <div class="bg-gradient-to-br from-emerald-800/95 to-teal-950/95 text-white rounded-[28px] p-5 shadow-[inset_0_1.5px_1px_rgba(255,255,255,0.4),0_8px_30px_rgba(4,120,87,0.15)] relative overflow-hidden backdrop-blur-md">
                    <!-- Subtle background noise/light overlay -->
                    <div class="absolute -right-10 -top-10 w-36 h-36 bg-emerald-400/20 rounded-full blur-2xl"></div>
                    
                    <div class="flex justify-between items-start z-10 relative">
                        <div>
                            <span class="text-xs font-bold tracking-wider text-emerald-300 uppercase block">Live Telemetry</span>
                            <span class="text-base font-bold text-white block mt-0.5">Pune Field Grid</span>
                            <span class="text-[11px] font-semibold text-emerald-200/90 mt-2 block" id="telemetry-condition-mobile">
                                <span class="animate-pulse">☀️</span> Loading condition...
                            </span>
                        </div>
                        <div class="flex items-baseline gap-0.5">
                            <span class="text-5xl font-light text-white" id="telemetry-temp-mobile">--</span>
                            <span class="text-xl font-medium text-emerald-300">°C</span>
                        </div>
                    </div>

                    <div class="my-4 border-t border-emerald-700/40"></div>

                    <!-- 2x2 Clean iOS modular weather metrics -->
                    <div class="grid grid-cols-2 gap-y-4 gap-x-2.5 z-10 relative">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-8 rounded-full bg-emerald-700/40 flex items-center justify-center text-emerald-300 text-xs">
                                💧
                            </div>
                            <div>
                                <span class="text-[9px] text-emerald-300 font-bold uppercase tracking-wider block">Humidity</span>
                                <span class="text-sm font-extrabold text-white mt-0.5 block"><span id="telemetry-humidity-mobile">--</span>%</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="h-8 w-8 rounded-full bg-emerald-700/40 flex items-center justify-center text-emerald-300 text-xs">
                                🌱
                            </div>
                            <div>
                                <span class="text-[9px] text-emerald-300 font-bold uppercase tracking-wider block">Soil Moisture</span>
                                <span class="text-sm font-extrabold text-white mt-0.5 block"><span id="telemetry-soil-moisture-mobile">--</span>%</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="h-8 w-8 rounded-full bg-emerald-700/40 flex items-center justify-center text-emerald-300 text-xs">
                                🌡️
                            </div>
                            <div>
                                <span class="text-[9px] text-emerald-300 font-bold uppercase tracking-wider block">Soil Temp</span>
                                <span class="text-sm font-extrabold text-white mt-0.5 block"><span id="telemetry-soil-temp-mobile">--</span>°C</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="h-8 w-8 rounded-full bg-emerald-700/40 flex items-center justify-center text-emerald-300 text-xs">
                                🧬
                            </div>
                            <div>
                                <span class="text-[9px] text-emerald-300 font-bold uppercase tracking-wider block">Biologicals</span>
                                <span class="text-sm font-extrabold text-white mt-0.5 block">Excellent</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- iOS Control Center Grid Widget -->
                <div class="bg-white rounded-[28px] border border-neutral-200/50 p-5 shadow-[0_4px_24px_rgba(0,0,0,0.015)]">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-neutral-400 mb-4 block px-1">Control Center</span>
                    <div class="grid grid-cols-4 gap-y-4 gap-x-2">
                        <!-- Action 1: Grower -->
                        <a href="{{ route('farmers.create') }}" class="flex flex-col items-center">
                            <div class="h-12 w-12 rounded-full bg-emerald-500 text-white flex items-center justify-center shadow-md shadow-emerald-500/10 hover:scale-105 transition duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                            </div>
                            <span class="text-[10px] font-bold text-neutral-600 mt-2 text-center truncate w-full">Grower</span>
                        </a>

                        <!-- Action 2: Plot -->
                        <a href="{{ route('plots.create') }}" class="flex flex-col items-center">
                            <div class="h-12 w-12 rounded-full bg-amber-500 text-white flex items-center justify-center shadow-md shadow-amber-500/10 hover:scale-105 transition duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                            </div>
                            <span class="text-[10px] font-bold text-neutral-600 mt-2 text-center truncate w-full">Add Plot</span>
                        </a>

                        <!-- Action 3: Sow -->
                        <a href="{{ route('crops.create') }}" class="flex flex-col items-center">
                            <div class="h-12 w-12 rounded-full bg-teal-500 text-white flex items-center justify-center shadow-md shadow-teal-500/10 hover:scale-105 transition duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m12.728 12.728l-.707-.707M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-[10px] font-bold text-neutral-600 mt-2 text-center truncate w-full">Sow Crop</span>
                        </a>

                        <!-- Action 4: Inventory -->
                        <a href="{{ route('inputs.create') }}" class="flex flex-col items-center">
                            <div class="h-12 w-12 rounded-full bg-sky-500 text-white flex items-center justify-center shadow-md shadow-sky-500/10 hover:scale-105 transition duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                            <span class="text-[10px] font-bold text-neutral-600 mt-2 text-center truncate w-full">Add Stock</span>
                        </a>

                        <!-- Action 5: Test Soil -->
                        <a href="{{ route('soil-reports.create') }}" class="flex flex-col items-center">
                            <div class="h-12 w-12 rounded-full bg-indigo-500 text-white flex items-center justify-center shadow-md shadow-indigo-500/10 hover:scale-105 transition duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            </div>
                            <span class="text-[10px] font-bold text-neutral-600 mt-2 text-center truncate w-full">Soil Test</span>
                        </a>

                        <!-- Action 6: Apply Input -->
                        <a href="{{ route('supplies.create') }}" class="flex flex-col items-center">
                            <div class="h-12 w-12 rounded-full bg-rose-500 text-white flex items-center justify-center shadow-md shadow-rose-500/10 hover:scale-105 transition duration-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0zM13 11V6a1 1 0 012 0v5h4v3H5v-3h8z"></path></svg>
                            </div>
                            <span class="text-[10px] font-bold text-neutral-600 mt-2 text-center truncate w-full">Apply Input</span>
                        </a>

                        <!-- Action 7: Observe -->
                        <a href="{{ route('observations.create') }}" class="flex flex-col items-center col-span-2">
                            <div class="h-12 w-[100%] rounded-full bg-purple-500 text-white flex items-center justify-center shadow-md shadow-purple-500/10 hover:scale-[1.02] transition duration-200 gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                <span class="text-[10px] font-bold text-white">Log Observation</span>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- iOS Farms Status (Settings-Style Inset Grouped List) -->
                <div class="bg-white rounded-[28px] border border-neutral-200/50 p-4 shadow-[0_4px_24px_rgba(0,0,0,0.015)]">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-neutral-400 mb-2 block px-1.5">Farms Status</span>
                    <div class="flex flex-col">
                        <!-- Grower Inset Row -->
                        <a href="{{ route('farmers.index') }}" class="py-3 px-1.5 flex items-center justify-between border-b border-neutral-100 active:bg-neutral-50 transition duration-150">
                            <div class="flex items-center gap-3.5">
                                <div class="h-8.5 w-8.5 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                                <span class="text-sm font-bold text-neutral-800">Farmers</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="text-sm font-bold text-neutral-900">{{ $stats['farmers'] }}</span>
                                <svg class="w-3.5 h-3.5 text-neutral-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </a>

                        <!-- Plots Inset Row -->
                        <a href="{{ route('plots.index') }}" class="py-3 px-1.5 flex items-center justify-between border-b border-neutral-100 active:bg-neutral-50 transition duration-150">
                            <div class="flex items-center gap-3.5">
                                <div class="h-8.5 w-8.5 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                                </div>
                                <span class="text-sm font-bold text-neutral-800">Plots</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="text-sm font-bold text-neutral-900">{{ $stats['plots'] }}</span>
                                <svg class="w-3.5 h-3.5 text-neutral-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </a>

                        <!-- Crops Inset Row -->
                        <a href="{{ route('crops.index') }}" class="py-3 px-1.5 flex items-center justify-between border-b border-neutral-100 active:bg-neutral-50 transition duration-150">
                            <div class="flex items-center gap-3.5">
                                <div class="h-8.5 w-8.5 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                                <span class="text-sm font-bold text-neutral-800">Active Crops</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="text-sm font-bold text-neutral-900">{{ $stats['crops'] }}</span>
                                <svg class="w-3.5 h-3.5 text-neutral-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </a>

                        <!-- Area Inset Row -->
                        <div class="py-3 px-1.5 flex items-center justify-between border-b border-neutral-100">
                            <div class="flex items-center gap-3.5">
                                <div class="h-8.5 w-8.5 rounded-xl bg-lime-50 text-lime-600 flex items-center justify-center">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h2a2.5 2.5 0 002.5-2.5V8.5a.5.5 0 01.5-.5h.5m-6 9a2 2 0 002-2v-1a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <span class="text-sm font-bold text-neutral-800">Total Area</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="text-sm font-bold text-neutral-900">{{ number_format($stats['total_area'], 1) }} Acres</span>
                            </div>
                        </div>

                        <!-- Materials Inset Row -->
                        <a href="{{ route('inputs.index') }}" class="py-3 px-1.5 flex items-center justify-between active:bg-neutral-50 transition duration-150">
                            <div class="flex items-center gap-3.5">
                                <div class="h-8.5 w-8.5 rounded-xl bg-neutral-100 text-neutral-600 flex items-center justify-center">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                </div>
                                <span class="text-sm font-bold text-neutral-800">Inventory Items</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="text-sm font-bold text-neutral-900">{{ $stats['inputs'] }}</span>
                                <svg class="w-3.5 h-3.5 text-neutral-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- iOS Weather 7-Day Forecast (Apple style grouped card list) -->
                <div class="bg-white rounded-[28px] border border-neutral-200/50 p-5 shadow-[0_4px_24px_rgba(0,0,0,0.015)]">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-neutral-400 mb-3.5 block px-1">Deccan Grid Forecast</span>
                    <div class="divide-y divide-neutral-100 rounded-2xl bg-neutral-50/40 p-1 border border-neutral-200/30" id="forecast-list-mobile">
                        <!-- Loading states -->
                        <div class="animate-pulse space-y-3 p-3">
                            <div class="h-8 bg-neutral-100 rounded-lg"></div>
                            <div class="h-8 bg-neutral-100 rounded-lg"></div>
                            <div class="h-8 bg-neutral-100 rounded-lg"></div>
                        </div>
                    </div>
                </div>

                <!-- iOS Recent Observations (Apple Notes style cards) -->
                <div class="space-y-3">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-neutral-400 block px-4 mt-8">Recent Field Notes</span>
                    @if($stats['recent_observations']->isEmpty())
                        <div class="py-8 text-center text-xs text-neutral-400 bg-white rounded-2xl border border-neutral-200/50">
                            No logs submitted yet.
                        </div>
                    @else
                        @foreach($stats['recent_observations']->take(3) as $obs)
                            <div class="bg-white rounded-[24px] border border-neutral-200/50 p-5 shadow-[0_4px_24px_rgba(0,0,0,0.015)] flex flex-col gap-2">
                                <div class="flex justify-between items-start gap-4">
                                    <div>
                                        <span class="text-sm font-extrabold text-neutral-800 block">{{ $obs->crop->name }}</span>
                                        <span class="text-[10px] font-bold text-neutral-400 mt-0.5 block uppercase tracking-wider">{{ $obs->crop->plot->name }}</span>
                                    </div>
                                    <span class="text-[10px] text-neutral-400 font-semibold">{{ \Carbon\Carbon::parse($obs->observation_date)->diffForHumans() }}</span>
                                </div>
                                <p class="text-xs text-neutral-500 leading-relaxed italic bg-stone-50/50 border border-neutral-100/50 p-3 rounded-xl mt-1">
                                    "{{ $obs->observation }}"
                                </p>
                                <div class="flex items-center gap-1.5 mt-1 text-[9px] font-extrabold text-neutral-400 uppercase tracking-wider">
                                    <span>👤 {{ $obs->crop->plot->farmer->name }}</span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <!-- iOS Recent Soil Health Reports (Apple Health Diagnostic style cards) -->
                <div class="space-y-3">
                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-neutral-400 block px-4 mt-8">Soil Diagnostic Reports</span>
                    @if($stats['recent_soil_reports']->isEmpty())
                        <div class="py-8 text-center text-xs text-neutral-400 bg-white rounded-2xl border border-neutral-200/50">
                            No soil reports submitted yet.
                        </div>
                    @else
                        @foreach($stats['recent_soil_reports']->take(2) as $report)
                            <div class="bg-white rounded-[24px] border border-neutral-200/50 p-5 shadow-[0_4px_24px_rgba(0,0,0,0.015)]">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <span class="text-sm font-extrabold text-neutral-800 block">{{ $report->crop->name }}</span>
                                        <span class="text-[10px] font-bold text-neutral-400 mt-0.5 block uppercase tracking-wider">{{ $report->crop->plot->name }}</span>
                                    </div>
                                    <span class="px-2.5 py-1 text-[10px] font-bold rounded-full border {{ $report->Ph >= 6.0 && $report->Ph <= 7.2 ? 'bg-emerald-50 text-emerald-700 border-emerald-100/50' : 'bg-amber-50 text-amber-700 border-amber-100/50' }}">
                                        pH {{ $report->Ph }}
                                    </span>
                                </div>
                                
                                <div class="space-y-3">
                                    <!-- N -->
                                    <div>
                                        <div class="flex justify-between text-[10px] font-bold text-neutral-400 uppercase tracking-wide">
                                            <span>Nitrogen (N)</span>
                                            <span class="text-neutral-700">{{ $report->N }} mg/kg</span>
                                        </div>
                                        <div class="h-2 w-full bg-neutral-100 rounded-full mt-1.5 overflow-hidden">
                                            <div class="h-full bg-emerald-500 rounded-full" style="width: {{ min(100, ($report->N / 350) * 100) }}%"></div>
                                        </div>
                                    </div>
                                    <!-- P -->
                                    <div>
                                        <div class="flex justify-between text-[10px] font-bold text-neutral-400 uppercase tracking-wide">
                                            <span>Phosphorus (P)</span>
                                            <span class="text-neutral-700">{{ $report->P }} mg/kg</span>
                                        </div>
                                        <div class="h-2 w-full bg-neutral-100 rounded-full mt-1.5 overflow-hidden">
                                            <div class="h-full bg-amber-500 rounded-full" style="width: {{ min(100, ($report->P / 50) * 100) }}%"></div>
                                        </div>
                                    </div>
                                    <!-- K -->
                                    <div>
                                        <div class="flex justify-between text-[10px] font-bold text-neutral-400 uppercase tracking-wide">
                                            <span>Potassium (K)</span>
                                            <span class="text-neutral-700">{{ $report->K }} mg/kg</span>
                                        </div>
                                        <div class="h-2 w-full bg-neutral-100 rounded-full mt-1.5 overflow-hidden">
                                            <div class="h-full bg-teal-500 rounded-full" style="width: {{ min(100, ($report->K / 400) * 100) }}%"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-4 pt-3.5 border-t border-neutral-100 flex justify-between items-center text-[10px] text-neutral-400 font-bold uppercase tracking-wider">
                                    <span>Sample: {{ \Carbon\Carbon::parse($report->sample_date)->format('M d, Y') }}</span>
                                    <span class="text-emerald-600 bg-emerald-50/50 px-2 py-0.5 rounded-lg border border-emerald-100">
                                        CFU: {{ number_format($report->microbial_count / 1000000, 1) }}M/g
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            
            <!-- Global agromet weather forecast details fetching script -->
            <script>
                function getWeatherDetails(code) {
                    switch (code) {
                        case 0:
                            return { emoji: '☀️', label: 'Clear Sky' };
                        case 1:
                            return { emoji: '🌤️', label: 'Mainly Clear' };
                        case 2:
                            return { emoji: '⛅', label: 'Partly Cloudy' };
                        case 3:
                            return { emoji: '☁️', label: 'Overcast' };
                        case 45:
                        case 48:
                            return { emoji: '🌫️', label: 'Foggy' };
                        case 51:
                        case 53:
                        case 55:
                            return { emoji: '🌦️', label: 'Light Drizzle' };
                        case 61:
                        case 63:
                            return { emoji: '🌧️', label: 'Rainy' };
                        case 65:
                            return { emoji: '🌧️', label: 'Heavy Rain' };
                        case 80:
                        case 81:
                        case 82:
                            return { emoji: '🌦️', label: 'Passing Showers' };
                        case 95:
                        case 96:
                        case 99:
                            return { emoji: '⛈️', label: 'Thunderstorms' };
                        default:
                            return { emoji: '☀️', label: 'Sunny' };
                    }
                }

                document.addEventListener('DOMContentLoaded', function () {
                    fetch('https://api.open-meteo.com/v1/forecast?latitude=18.5204&longitude=73.8567&current=temperature_2m,relative_humidity_2m,weather_code&hourly=soil_temperature_0_to_7cm,soil_moisture_0_to_7cm&daily=weather_code,temperature_2m_max,relative_humidity_2m_max,precipitation_sum&timezone=auto&forecast_days=7')
                        .then(response => response.json())
                        .then(data => {
                            if (data.current) {
                                const temp = Math.round(data.current.temperature_2m);
                                const humidity = data.relative_humidity_2m || data.current.relative_humidity_2m;
                                
                                // Update temp on desktop & mobile
                                const elTemp = document.getElementById('telemetry-temp');
                                const elTempMob = document.getElementById('telemetry-temp-mobile');
                                if (elTemp) elTemp.textContent = temp;
                                if (elTempMob) elTempMob.textContent = temp;

                                // Update humidity on desktop & mobile
                                const elHum = document.getElementById('telemetry-humidity');
                                const elHumMob = document.getElementById('telemetry-humidity-mobile');
                                if (elHum) elHum.textContent = humidity;
                                if (elHumMob) elHumMob.textContent = humidity;
                                
                                if (data.current.weather_code !== undefined) {
                                    const cond = getWeatherDetails(data.current.weather_code);
                                    
                                    const elCond = document.getElementById('telemetry-condition');
                                    const elCondMob = document.getElementById('telemetry-condition-mobile');
                                    if (elCond) elCond.innerHTML = `<span class="text-sm">${cond.emoji}</span> ${cond.label}`;
                                    if (elCondMob) elCondMob.innerHTML = `<span class="text-lg mr-1.5">${cond.emoji}</span> ${cond.label}`;
                                }
                            }
                            if (data.hourly) {
                                const hourIndex = new Date().getHours();
                                if (data.hourly.soil_temperature_0_to_7cm && data.hourly.soil_temperature_0_to_7cm[hourIndex] !== undefined) {
                                    const sTemp = Math.round(data.hourly.soil_temperature_0_to_7cm[hourIndex]);
                                    const elSTemp = document.getElementById('telemetry-soil-temp');
                                    const elSTempMob = document.getElementById('telemetry-soil-temp-mobile');
                                    if (elSTemp) elSTemp.textContent = sTemp;
                                    if (elSTempMob) elSTempMob.textContent = sTemp;
                                }
                                if (data.hourly.soil_moisture_0_to_7cm && data.hourly.soil_moisture_0_to_7cm[hourIndex] !== undefined) {
                                    const moisturePercent = (data.hourly.soil_moisture_0_to_7cm[hourIndex] * 100).toFixed(1);
                                    const elSMoist = document.getElementById('telemetry-soil-moisture');
                                    const elSMoistMob = document.getElementById('telemetry-soil-moisture-mobile');
                                    if (elSMoist) elSMoist.textContent = moisturePercent;
                                    if (elSMoistMob) elSMoistMob.textContent = moisturePercent;
                                }
                            }
                            if (data.daily) {
                                generateForecast(data.daily, 'forecast-list');
                                generateForecast(data.daily, 'forecast-list-mobile');
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching telemetry:', error);
                            const forecasts = ['forecast-list', 'forecast-list-mobile'];
                            forecasts.forEach(id => {
                                const container = document.getElementById(id);
                                if (container) {
                                    container.innerHTML = `
                                        <div class="p-4 text-center text-sm text-neutral-400">
                                            Unable to load weather forecast.
                                        </div>
                                    `;
                                }
                            });
                        });
                });

                function generateForecast(daily, containerId) {
                    const container = document.getElementById(containerId);
                    if (!container) return;
                    container.innerHTML = '';

                    const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

                    daily.time.forEach((timeStr, index) => {
                        const date = new Date(timeStr);
                        const dayName = index === 0 ? 'Today' : days[date.getDay()];
                        const maxTemp = Math.round(daily.temperature_2m_max[index]);
                        const rain = daily.precipitation_sum[index];
                        
                        const weatherCode = daily.weather_code ? daily.weather_code[index] : 0;
                        const weather = getWeatherDetails(weatherCode);
                        const weatherEmoji = weather.emoji;
                        const weatherLabel = weather.label;

                        const rainDisplay = rain > 0 ? `${rain.toFixed(1)} mm` : '0 mm';

                        const html = `
                            <div class="flex items-center justify-between py-3 px-3.5 border-b border-neutral-100 last:border-0 hover:bg-neutral-50/50 transition duration-150">
                                <div class="flex items-center gap-2.5 min-w-0">
                                    <span class="text-xl shrink-0" title="${weatherLabel}">${weatherEmoji}</span>
                                    <div class="min-w-0">
                                        <span class="text-xs font-extrabold text-neutral-800 block truncate">${dayName}</span>
                                        <span class="text-[10px] font-semibold text-neutral-400 block truncate" title="${weatherLabel}">${weatherLabel}</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 shrink-0 text-right">
                                    <div class="w-14">
                                        <span class="text-[9px] text-neutral-400 font-bold block uppercase tracking-wider leading-none">Precip.</span>
                                        <span class="text-xs font-bold ${rain > 0 ? 'text-blue-500' : 'text-neutral-500'} mt-0.5 block leading-none">${rainDisplay}</span>
                                    </div>
                                    <div class="w-10">
                                        <span class="text-[9px] text-neutral-400 font-bold block uppercase tracking-wider leading-none">Max</span>
                                        <span class="text-xs font-extrabold text-neutral-800 mt-0.5 block leading-none">${maxTemp}°C</span>
                                    </div>
                                </div>
                            </div>
                        `;
                        container.insertAdjacentHTML('beforeend', html);
                    });
                }
            </script>
        </div>
    </div>
</x-app-layout>
