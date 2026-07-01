<x-app-layout>
    <div class="py-10 bg-[#f5f5f7] min-h-screen">
        <div class="max-w-xl mx-auto px-4 sm:px-6 space-y-6">
            
            <div>
                <a href="{{ route('crops.index') }}" class="text-xs font-medium text-neutral-400 hover:text-neutral-950 flex items-center space-x-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    <span>Back to Crops</span>
                </a>
                <h1 class="text-2xl font-bold tracking-tight text-neutral-900 mt-3">Plant New Crop</h1>
                <p class="text-xs text-neutral-500 mt-0.5">Register a crop sowing event on a specific plot of land.</p>
            </div>

            <div class="bg-white rounded-2xl border border-neutral-100 p-6 shadow-sm" 
                 x-data="{
                    farmers: {{ $farmers->toJson() }},
                    selectedFarmerId: '{{ old('farmer_id', '') }}',
                    plots: [],
                    selectedPlotId: '{{ old('plot_id', '') }}',
                    init() {
                        const farmer = this.farmers.find(f => f.id == this.selectedFarmerId);
                        this.plots = farmer ? farmer.plots : [];

                        const fId = this.selectedFarmerId;
                        const pId = this.selectedPlotId;
                        this.selectedFarmerId = '';
                        this.selectedPlotId = '';

                        this.$nextTick(() => {
                            this.selectedFarmerId = fId;
                            this.selectedPlotId = pId;
                        });
                    },
                    updatePlots() {
                        const farmer = this.farmers.find(f => f.id == this.selectedFarmerId);
                        this.plots = farmer ? farmer.plots : [];
                        this.selectedPlotId = '';
                    }
                 }">
                <form method="POST" action="{{ route('crops.store') }}" class="space-y-4">
                    @csrf

                    <!-- Farmer Dropdown -->
                    <div>
                        <label for="farmer_id" class="block text-xs font-bold text-neutral-700 uppercase tracking-wider">Select Farmer</label>
                        <select id="farmer_id" name="farmer_id" x-model="selectedFarmerId" @change="updatePlots()" required
                                class="mt-1.5 block w-full rounded-xl border-neutral-200 shadow-sm text-sm focus:border-neutral-500 focus:ring-neutral-500">
                            <option value="">Choose a Farmer...</option>
                            <template x-for="farmer in farmers" :key="farmer.id">
                                <option :value="farmer.id" x-text="farmer.name"></option>
                            </template>
                        </select>
                    </div>

                    <!-- Plot Dropdown (Dynamic) -->
                    <div>
                        <label for="plot_id" class="block text-xs font-bold text-neutral-700 uppercase tracking-wider">Select Plot</label>
                        <select id="plot_id" name="plot_id" x-model="selectedPlotId" :disabled="!selectedFarmerId" required
                                class="mt-1.5 block w-full rounded-xl border-neutral-200 shadow-sm text-sm focus:border-neutral-500 focus:ring-neutral-500 disabled:opacity-50 disabled:bg-neutral-50">
                            <option value="">Choose a Plot...</option>
                            <template x-for="plot in plots" :key="plot.id">
                                <option :value="plot.id" x-text="plot.name + ' (' + plot.area + ' Acres)'" :selected="plot.id == selectedPlotId"></option>
                            </template>
                        </select>
                        @error('plot_id')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Crop Name -->
                    <div>
                        <label for="name" class="block text-xs font-bold text-neutral-700 uppercase tracking-wider">Crop Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Rice, Wheat, Sugarcane, Chilli"
                               class="mt-1.5 block w-full rounded-xl border-neutral-200 shadow-sm text-sm focus:border-neutral-500 focus:ring-neutral-500" />
                        @error('name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Crop Variety -->
                    <div>
                        <label for="variety" class="block text-xs font-bold text-neutral-700 uppercase tracking-wider">Crop Variety</label>
                        <input id="variety" type="text" name="variety" value="{{ old('variety') }}" required placeholder="e.g. Basmati 370, HD 2967, Guntur Teja"
                               class="mt-1.5 block w-full rounded-xl border-neutral-200 shadow-sm text-sm focus:border-neutral-500 focus:ring-neutral-500" />
                        @error('variety')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sowing Date -->
                    <div>
                        <label for="sowing_date" class="block text-xs font-bold text-neutral-700 uppercase tracking-wider">Sowing Date</label>
                        <input id="sowing_date" type="date" name="sowing_date" value="{{ old('sowing_date') }}" required
                               class="mt-1.5 block w-full rounded-xl border-neutral-200 shadow-sm text-sm focus:border-neutral-500 focus:ring-neutral-500" />
                        @error('sowing_date')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Estimated Harvest Date -->
                    <div>
                        <label for="harvest_date" class="block text-xs font-bold text-neutral-700 uppercase tracking-wider">Estimated Harvest Date</label>
                        <input id="harvest_date" type="date" name="harvest_date" value="{{ old('harvest_date') }}" required
                               class="mt-1.5 block w-full rounded-xl border-neutral-200 shadow-sm text-sm focus:border-neutral-500 focus:ring-neutral-500" />
                        @error('harvest_date')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 text-xs font-semibold text-white bg-neutral-900 hover:bg-neutral-800 rounded-xl transition shadow-sm">
                            Save Crop
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
