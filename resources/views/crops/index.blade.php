<x-app-layout>
    <div class="py-10 bg-[#f5f5f7] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-neutral-900">Crops</h1>
                    <p class="text-xs text-neutral-500 mt-0.5">List of active crops cultivated on your plots.</p>
                </div>
                <a href="{{ route('crops.create') }}" class="inline-flex items-center justify-center px-4 py-2 text-xs font-semibold text-white bg-neutral-900 hover:bg-neutral-800 rounded-xl transition shadow-sm">
                    Plant New Crop
                </a>
            </div>

            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-xl text-xs">
                    {{ session('success') }}
                </div>
            @endif

            @if($crops->isEmpty())
                <div class="bg-white rounded-2xl border border-neutral-100 p-12 text-center shadow-sm">
                    <p class="text-sm text-neutral-400">No crops planted yet.</p>
                    <a href="{{ route('crops.create') }}" class="mt-4 inline-flex items-center text-xs font-semibold text-neutral-900 underline">
                        Plant your first crop
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($crops as $crop)
                        <div class="bg-white rounded-2xl border border-neutral-100 p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between space-y-6">
                            <div>
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-base font-bold text-neutral-950 tracking-tight">{{ $crop->name }}</h3>
                                        <span class="text-xs text-neutral-400">{{ $crop->variety }}</span>
                                    </div>
                                    <span class="text-[10px] font-medium text-neutral-500 bg-neutral-50 px-2.5 py-1 rounded-full border border-neutral-200/40">
                                        {{ $crop->plot->name }}
                                    </span>
                                </div>

                                <div class="mt-4 space-y-1.5 border-t border-neutral-100 pt-4">
                                    <div class="flex justify-between text-xs">
                                        <span class="text-neutral-400">Farmer:</span>
                                        <span class="font-semibold text-neutral-800">{{ $crop->plot->farmer->name }}</span>
                                    </div>
                                    <div class="flex justify-between text-xs">
                                        <span class="text-neutral-400">Sowing Date:</span>
                                        <span class="text-neutral-700">{{ \Carbon\Carbon::parse($crop->sowing_date)->format('M d, Y') }}</span>
                                    </div>
                                    <div class="flex justify-between text-xs">
                                        <span class="text-neutral-400">Est. Harvest:</span>
                                        <span class="text-neutral-700">{{ \Carbon\Carbon::parse($crop->harvest_date)->format('M d, Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="border-t border-neutral-50 pt-3 flex justify-between items-center">
                                <span class="text-[10px] text-neutral-400">Area: {{ $crop->plot->area }} Acres</span>
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('crops.edit', $crop) }}" title="Edit">
                                        <x-icon-edit />
                                    </a>
                                    <form method="POST" action="{{ route('crops.destroy', $crop) }}" onsubmit="return confirm('Are you sure you want to delete this crop?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Delete" class="align-middle">
                                            <x-icon-delete />
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
