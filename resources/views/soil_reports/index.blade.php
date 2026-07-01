<x-app-layout>
    <div class="py-10 bg-[#f5f5f7] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-neutral-900">Soil Reports</h1>
                    <p class="text-xs text-neutral-500 mt-0.5">Historical soil health tests and chemical analysis logs.</p>
                </div>
                <a href="{{ route('soil-reports.create') }}" class="inline-flex items-center justify-center px-4 py-2 text-xs font-semibold text-white bg-neutral-900 hover:bg-neutral-800 rounded-xl transition shadow-sm">
                    Record Soil Report
                </a>
            </div>

            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-xl text-xs">
                    {{ session('success') }}
                </div>
            @endif

            @if($reports->isEmpty())
                <div class="bg-white rounded-2xl border border-neutral-100 p-12 text-center shadow-sm">
                    <p class="text-sm text-neutral-400">No soil reports recorded yet.</p>
                    <a href="{{ route('soil-reports.create') }}" class="mt-4 inline-flex items-center text-xs font-semibold text-neutral-900 underline">
                        Record your first report
                    </a>
                </div>
            @else
                <div class="space-y-6">
                    @foreach($reports as $report)
                        <div class="bg-white rounded-2xl border border-neutral-100 p-6 shadow-sm hover:shadow-md transition-all duration-300 space-y-4">
                            <!-- Top Header -->
                            <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-neutral-100 pb-4">
                                <div>
                                    <h3 class="text-base font-bold text-neutral-950 tracking-tight">
                                        Crop: {{ $report->crop->name }} ({{ $report->crop->variety }})
                                    </h3>
                                    <p class="text-xs text-neutral-400 mt-0.5">
                                        Farmer: {{ $report->crop->plot->farmer->name }} | Plot: {{ $report->crop->plot->name }}
                                    </p>
                                </div>
                                <div class="mt-2 md:mt-0 flex items-center space-x-3">
                                    <span class="text-xs text-neutral-400">Sampled: <strong>{{ \Carbon\Carbon::parse($report->sample_date)->format('M d, Y') }}</strong></span>
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('soil-reports.edit', $report) }}" title="Edit">
                                            <x-icon-edit />
                                        </a>
                                        <form method="POST" action="{{ route('soil-reports.destroy', $report) }}" onsubmit="return confirm('Are you sure you want to delete this soil report?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Delete" class="align-middle">
                                                <x-icon-delete />
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Metrics Grid (Bento Style) -->
                            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-7 gap-4">
                                <div class="bg-neutral-50/50 border border-neutral-100 rounded-xl p-3 text-center">
                                    <span class="text-[10px] text-neutral-400 uppercase font-bold tracking-wider">pH</span>
                                    <p class="text-sm font-bold text-neutral-800 mt-1">{{ $report->Ph }}</p>
                                </div>
                                <div class="bg-neutral-50/50 border border-neutral-100 rounded-xl p-3 text-center">
                                    <span class="text-[10px] text-neutral-400 uppercase font-bold tracking-wider">EC <span class="text-[8px] font-normal lowercase">(dS/m)</span></span>
                                    <p class="text-sm font-bold text-neutral-800 mt-1">{{ $report->EC }}</p>
                                </div>
                                <div class="bg-neutral-50/50 border border-neutral-100 rounded-xl p-3 text-center">
                                    <span class="text-[10px] text-neutral-400 uppercase font-bold tracking-wider">OC <span class="text-[8px] font-normal lowercase">(%)</span></span>
                                    <p class="text-sm font-bold text-neutral-800 mt-1">{{ $report->OC }}</p>
                                </div>
                                <div class="bg-neutral-50/50 border border-neutral-100 rounded-xl p-3 text-center">
                                    <span class="text-[10px] text-emerald-600 uppercase font-bold tracking-wider">N <span class="text-[8px] font-normal lowercase">(kg/ha)</span></span>
                                    <p class="text-sm font-bold text-emerald-800 mt-1">{{ $report->N }}</p>
                                </div>
                                <div class="bg-neutral-50/50 border border-neutral-100 rounded-xl p-3 text-center">
                                    <span class="text-[10px] text-emerald-600 uppercase font-bold tracking-wider">P <span class="text-[8px] font-normal lowercase">(kg/ha)</span></span>
                                    <p class="text-sm font-bold text-emerald-800 mt-1">{{ $report->P }}</p>
                                </div>
                                <div class="bg-neutral-50/50 border border-neutral-100 rounded-xl p-3 text-center">
                                    <span class="text-[10px] text-emerald-600 uppercase font-bold tracking-wider">K <span class="text-[8px] font-normal lowercase">(kg/ha)</span></span>
                                    <p class="text-sm font-bold text-emerald-800 mt-1">{{ $report->K }}</p>
                                </div>
                                <div class="bg-neutral-50/50 border border-neutral-100 rounded-xl p-3 text-center">
                                    <span class="text-[10px] text-neutral-400 uppercase font-bold tracking-wider">Microbial</span>
                                    <p class="text-sm font-bold text-neutral-800 mt-1">{{ number_format($report->microbial_count) }}</p>
                                </div>
                            </div>

                            <!-- Micro Nutrients -->
                            <div class="flex flex-wrap gap-2 pt-2 border-t border-neutral-100 text-[11px] text-neutral-500">
                                <span class="bg-neutral-50 px-2 py-0.5 rounded border border-neutral-100">Boron: <strong>{{ $report->Boron }}</strong></span>
                                <span class="bg-neutral-50 px-2 py-0.5 rounded border border-neutral-100">Fe: <strong>{{ $report->Fe }}</strong></span>
                                <span class="bg-neutral-50 px-2 py-0.5 rounded border border-neutral-100">Zn: <strong>{{ $report->Zn }}</strong></span>
                                <span class="bg-neutral-50 px-2 py-0.5 rounded border border-neutral-100">Cu: <strong>{{ $report->Cu }}</strong></span>
                                <span class="bg-neutral-50 px-2 py-0.5 rounded border border-neutral-100">Mg: <strong>{{ $report->Mg }}</strong></span>
                                <span class="bg-neutral-50 px-2 py-0.5 rounded border border-neutral-100">S: <strong>{{ $report->S }}</strong></span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
