<x-app-layout>
    <div class="py-10 bg-[#f5f5f7] min-h-screen">
        <div class="max-w-xl mx-auto px-4 sm:px-6 space-y-6">
            
            <div>
                <a href="{{ route('observations.index') }}" class="text-xs font-medium text-neutral-400 hover:text-neutral-950 flex items-center space-x-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    <span>Back to Observations</span>
                </a>
                <h1 class="text-2xl font-bold tracking-tight text-neutral-900 mt-3">Log Observation</h1>
                <p class="text-xs text-neutral-500 mt-0.5">Record field notes, disease warnings, or growth milestones for a crop.</p>
            </div>

            <div class="bg-white rounded-2xl border border-neutral-100 p-6 shadow-sm"
                 x-data="{
                    farmers: {{ $farmers->toJson() }},
                    selectedFarmerId: '{{ old('farmer_id', '') }}',
                    plots: [],
                    selectedPlotId: '{{ old('plot_id', '') }}',
                    crops: [],
                    selectedCropId: '{{ old('crop_id', '') }}',
                    init() {
                        const farmer = this.farmers.find(f => f.id == this.selectedFarmerId);
                        this.plots = farmer ? farmer.plots : [];
                        const plot = this.plots.find(p => p.id == this.selectedPlotId);
                        this.crops = plot ? plot.crops : [];

                        const fId = this.selectedFarmerId;
                        const pId = this.selectedPlotId;
                        const cId = this.selectedCropId;
                        this.selectedFarmerId = '';
                        this.selectedPlotId = '';
                        this.selectedCropId = '';

                        this.$nextTick(() => {
                            this.selectedFarmerId = fId;
                            this.selectedPlotId = pId;
                            this.selectedCropId = cId;
                        });
                    },
                    updatePlots() {
                        const farmer = this.farmers.find(f => f.id == this.selectedFarmerId);
                        this.plots = farmer ? farmer.plots : [];
                        this.selectedPlotId = '';
                        this.crops = [];
                        this.selectedCropId = '';
                    },
                    updateCrops() {
                        const plot = this.plots.find(p => p.id == this.selectedPlotId);
                        this.crops = plot ? plot.crops : [];
                        this.selectedCropId = '';
                    }
                 }">
                <form method="POST" action="{{ route('observations.store') }}" class="space-y-4">
                    @csrf

                    <!-- Farmer -->
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

                    <!-- Plot -->
                    <div>
                        <label for="plot_id" class="block text-xs font-bold text-neutral-700 uppercase tracking-wider">Select Plot</label>
                        <select id="plot_id" name="plot_id" x-model="selectedPlotId" @change="updateCrops()" :disabled="!selectedFarmerId" required
                                class="mt-1.5 block w-full rounded-xl border-neutral-200 shadow-sm text-sm focus:border-neutral-500 focus:ring-neutral-500 disabled:opacity-50">
                            <option value="">Choose a Plot...</option>
                            <template x-for="plot in plots" :key="plot.id">
                                <option :value="plot.id" x-text="plot.name"></option>
                            </template>
                        </select>
                    </div>

                    <!-- Crop -->
                    <div>
                        <label for="crop_id" class="block text-xs font-bold text-neutral-700 uppercase tracking-wider">Select Crop</label>
                        <select id="crop_id" name="crop_id" x-model="selectedCropId" :disabled="!selectedPlotId" required
                                class="mt-1.5 block w-full rounded-xl border-neutral-200 shadow-sm text-sm focus:border-neutral-500 focus:ring-neutral-500 disabled:opacity-50">
                            <option value="">Choose a Crop...</option>
                            <template x-for="crop in crops" :key="crop.id">
                                <option :value="crop.id" x-text="crop.name + ' (' + crop.variety + ')'"></option>
                            </template>
                        </select>
                        @error('crop_id')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Observation Date -->
                    <div>
                        <label for="observation_date" class="block text-xs font-bold text-neutral-700 uppercase tracking-wider">Observation Date</label>
                        <input id="observation_date" type="date" name="observation_date" value="{{ old('observation_date', date('Y-m-d')) }}" required
                               class="mt-1.5 block w-full rounded-xl border-neutral-200 shadow-sm text-sm focus:border-neutral-500 focus:ring-neutral-500" />
                        @error('observation_date')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Observation Text -->
                    <div>
                        <label for="observation" class="block text-xs font-bold text-neutral-700 uppercase tracking-wider">Observation / Notes</label>
                        <textarea id="observation" name="observation" rows="4" required placeholder="e.g. Tillering stage looking excellent. Minor incidence of stem borer; sprayed neem oil."
                                  class="mt-1.5 block w-full rounded-xl border-neutral-200 shadow-sm text-sm focus:border-neutral-500 focus:ring-neutral-500">{{ old('observation') }}</textarea>
                        @error('observation')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 text-xs font-semibold text-white bg-neutral-900 hover:bg-neutral-800 rounded-xl transition shadow-sm">
                            Save Observation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
