<x-app-layout>
    <div class="py-10 bg-[#f5f5f7] min-h-screen">
        <div class="max-w-xl mx-auto px-4 sm:px-6 space-y-6">
            
            <div>
                <a href="{{ route('soil-reports.index') }}" class="text-xs font-medium text-neutral-400 hover:text-neutral-950 flex items-center space-x-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    <span>Back to Soil Reports</span>
                </a>
                <h1 class="text-2xl font-bold tracking-tight text-neutral-900 mt-3">Record Soil Report</h1>
                <p class="text-xs text-neutral-500 mt-0.5">Submit soil test analysis results for a specific crop cultivation cycle.</p>
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
                <form method="POST" action="{{ route('soil-reports.store') }}" class="space-y-6">
                    @csrf

                    <!-- Dynamic Dropdown Hierarchy -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 bg-neutral-50 p-4 rounded-xl border border-neutral-100">
                        <div>
                            <label for="farmer_id" class="block text-[10px] font-bold text-neutral-500 uppercase tracking-wider">Farmer</label>
                            <select id="farmer_id" name="farmer_id" x-model="selectedFarmerId" @change="updatePlots()" required
                                    class="mt-1 block w-full rounded-lg border-neutral-200 text-xs focus:border-neutral-500 focus:ring-neutral-500">
                                <option value="">Select...</option>
                                <template x-for="farmer in farmers" :key="farmer.id">
                                    <option :value="farmer.id" x-text="farmer.name"></option>
                                </template>
                            </select>
                        </div>

                        <div>
                            <label for="plot_id" class="block text-[10px] font-bold text-neutral-500 uppercase tracking-wider">Plot</label>
                            <select id="plot_id" name="plot_id" x-model="selectedPlotId" @change="updateCrops()" :disabled="!selectedFarmerId" required
                                    class="mt-1 block w-full rounded-lg border-neutral-200 text-xs focus:border-neutral-500 focus:ring-neutral-500 disabled:opacity-50">
                                <option value="">Select...</option>
                                <template x-for="plot in plots" :key="plot.id">
                                    <option :value="plot.id" x-text="plot.name"></option>
                                </template>
                            </select>
                        </div>

                        <div>
                            <label for="crop_id" class="block text-[10px] font-bold text-neutral-500 uppercase tracking-wider">Crop</label>
                            <select id="crop_id" name="crop_id" x-model="selectedCropId" :disabled="!selectedPlotId" required
                                    class="mt-1 block w-full rounded-lg border-neutral-200 text-xs focus:border-neutral-500 focus:ring-neutral-500 disabled:opacity-50">
                                <option value="">Select...</option>
                                <template x-for="crop in crops" :key="crop.id">
                                    <option :value="crop.id" x-text="crop.name + ' (' + crop.variety + ')'"></option>
                                </template>
                            </select>
                            @error('crop_id')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Test Date -->
                    <div>
                        <label for="sample_date" class="block text-xs font-bold text-neutral-700 uppercase tracking-wider">Sample Date</label>
                        <input id="sample_date" type="date" name="sample_date" value="{{ old('sample_date', date('Y-m-d')) }}" required
                               class="mt-1.5 block w-full rounded-xl border-neutral-200 shadow-sm text-sm focus:border-neutral-500 focus:ring-neutral-500" />
                        @error('sample_date')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Soil Parameters Grid -->
                    <div>
                        <h3 class="text-xs font-bold text-neutral-700 uppercase tracking-wider border-b border-neutral-100 pb-2 mb-4">Chemical & Biological Values</h3>
                        
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            <!-- Ph -->
                            <div>
                                <label for="Ph" class="block text-[11px] text-neutral-500">pH Level</label>
                                <input id="Ph" type="number" step="0.1" name="Ph" value="{{ old('Ph') }}" required placeholder="e.g. 6.5"
                                       class="mt-1 block w-full rounded-lg border-neutral-200 shadow-sm text-xs focus:border-neutral-500 focus:ring-neutral-500" />
                            </div>

                            <!-- EC -->
                            <div>
                                <label for="EC" class="block text-[11px] text-neutral-500">EC (dS/m)</label>
                                <input id="EC" type="number" step="0.01" name="EC" value="{{ old('EC') }}" required placeholder="e.g. 0.45"
                                       class="mt-1 block w-full rounded-lg border-neutral-200 shadow-sm text-xs focus:border-neutral-500 focus:ring-neutral-500" />
                            </div>

                            <!-- OC -->
                            <div>
                                <label for="OC" class="block text-[11px] text-neutral-500">OC (%)</label>
                                <input id="OC" type="number" step="0.01" name="OC" value="{{ old('OC') }}" required placeholder="e.g. 0.65"
                                       class="mt-1 block w-full rounded-lg border-neutral-200 shadow-sm text-xs focus:border-neutral-500 focus:ring-neutral-500" />
                            </div>

                            <!-- N -->
                            <div>
                                <label for="N" class="block text-[11px] text-neutral-500">Nitrogen (N - kg/ha)</label>
                                <input id="N" type="number" step="0.1" name="N" value="{{ old('N') }}" required
                                       class="mt-1 block w-full rounded-lg border-neutral-200 shadow-sm text-xs focus:border-neutral-500 focus:ring-neutral-500" />
                            </div>

                            <!-- P -->
                            <div>
                                <label for="P" class="block text-[11px] text-neutral-500">Phosphorus (P - kg/ha)</label>
                                <input id="P" type="number" step="0.1" name="P" value="{{ old('P') }}" required
                                       class="mt-1 block w-full rounded-lg border-neutral-200 shadow-sm text-xs focus:border-neutral-500 focus:ring-neutral-500" />
                            </div>

                            <!-- K -->
                            <div>
                                <label for="K" class="block text-[11px] text-neutral-500">Potassium (K - kg/ha)</label>
                                <input id="K" type="number" step="0.1" name="K" value="{{ old('K') }}" required
                                       class="mt-1 block w-full rounded-lg border-neutral-200 shadow-sm text-xs focus:border-neutral-500 focus:ring-neutral-500" />
                            </div>

                            <!-- Boron -->
                            <div>
                                <label for="Boron" class="block text-[11px] text-neutral-500">Boron (ppm)</label>
                                <input id="Boron" type="number" step="0.01" name="Boron" value="{{ old('Boron') }}" required
                                       class="mt-1 block w-full rounded-lg border-neutral-200 shadow-sm text-xs focus:border-neutral-500 focus:ring-neutral-500" />
                            </div>

                            <!-- Fe -->
                            <div>
                                <label for="Fe" class="block text-[11px] text-neutral-500">Iron (Fe - ppm)</label>
                                <input id="Fe" type="number" step="0.01" name="Fe" value="{{ old('Fe') }}" required
                                       class="mt-1 block w-full rounded-lg border-neutral-200 shadow-sm text-xs focus:border-neutral-500 focus:ring-neutral-500" />
                            </div>

                            <!-- Zn -->
                            <div>
                                <label for="Zn" class="block text-[11px] text-neutral-500">Zinc (Zn - ppm)</label>
                                <input id="Zn" type="number" step="0.01" name="Zn" value="{{ old('Zn') }}" required
                                       class="mt-1 block w-full rounded-lg border-neutral-200 shadow-sm text-xs focus:border-neutral-500 focus:ring-neutral-500" />
                            </div>

                            <!-- Cu -->
                            <div>
                                <label for="Cu" class="block text-[11px] text-neutral-500">Copper (Cu - ppm)</label>
                                <input id="Cu" type="number" step="0.01" name="Cu" value="{{ old('Cu') }}" required
                                       class="mt-1 block w-full rounded-lg border-neutral-200 shadow-sm text-xs focus:border-neutral-500 focus:ring-neutral-500" />
                            </div>

                            <!-- Mg -->
                            <div>
                                <label for="Mg" class="block text-[11px] text-neutral-500">Magnesium (Mg - ppm)</label>
                                <input id="Mg" type="number" step="0.01" name="Mg" value="{{ old('Mg') }}" required
                                       class="mt-1 block w-full rounded-lg border-neutral-200 shadow-sm text-xs focus:border-neutral-500 focus:ring-neutral-500" />
                            </div>

                            <!-- S -->
                            <div>
                                <label for="S" class="block text-[11px] text-neutral-500">Sulfur (S - ppm)</label>
                                <input id="S" type="number" step="0.01" name="S" value="{{ old('S') }}" required
                                       class="mt-1 block w-full rounded-lg border-neutral-200 shadow-sm text-xs focus:border-neutral-500 focus:ring-neutral-500" />
                            </div>

                            <!-- Microbial Count -->
                            <div class="col-span-2 sm:col-span-3">
                                <label for="microbial_count" class="block text-[11px] text-neutral-500">Microbial Count (CFU/g)</label>
                                <input id="microbial_count" type="number" name="microbial_count" value="{{ old('microbial_count') }}" required placeholder="e.g. 1800000"
                                       class="mt-1 block w-full rounded-lg border-neutral-200 shadow-sm text-xs focus:border-neutral-500 focus:ring-neutral-500" />
                            </div>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 text-xs font-semibold text-white bg-neutral-900 hover:bg-neutral-800 rounded-xl transition shadow-sm">
                            Save Soil Report
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
