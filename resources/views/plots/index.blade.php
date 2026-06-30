<x-app-layout>
    <div class="py-10 bg-[#f5f5f7] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-neutral-900">Plots</h1>
                    <p class="text-xs text-neutral-500 mt-0.5">List of land plots mapped to their respective owners.</p>
                </div>
                <a href="{{ route('plots.create') }}" class="inline-flex items-center justify-center px-4 py-2 text-xs font-semibold text-white bg-neutral-900 hover:bg-neutral-800 rounded-xl transition shadow-sm">
                    Add New Plot
                </a>
            </div>

            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-xl text-xs">
                    {{ session('success') }}
                </div>
            @endif

            @if($plots->isEmpty())
                <div class="bg-white rounded-2xl border border-neutral-100 p-12 text-center shadow-sm">
                    <p class="text-sm text-neutral-400">No plots registered yet.</p>
                    <a href="{{ route('plots.create') }}" class="mt-4 inline-flex items-center text-xs font-semibold text-neutral-900 underline">
                        Register your first plot
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($plots as $plot)
                        <div class="bg-white rounded-2xl border border-neutral-100 p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between space-y-4">
                            <div>
                                <div class="flex justify-between items-start">
                                    <h3 class="text-base font-bold text-neutral-900 tracking-tight">{{ $plot->name }}</h3>
                                    <span class="text-[10px] font-bold text-neutral-500 bg-neutral-50 px-2.5 py-1 rounded-full border border-neutral-200/40">
                                        {{ $plot->area }} Acres
                                    </span>
                                </div>
                                <div class="mt-3 space-y-1.5">
                                    <p class="text-xs text-neutral-400">Farmer / Owner:</p>
                                    <p class="text-sm font-semibold text-neutral-800">{{ $plot->farmer->name }}</p>
                                    <p class="text-[11px] text-neutral-500">{{ $plot->farmer->location }}</p>
                                </div>
                            </div>
                            <div class="border-t border-neutral-100 pt-3 flex items-center justify-between">
                                <span class="text-[10px] text-neutral-400">Created: {{ $plot->created_at->format('M d, Y') }}</span>
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('plots.edit', $plot) }}" title="Edit">
                                        <x-icon-edit />
                                    </a>
                                    <form method="POST" action="{{ route('plots.destroy', $plot) }}" onsubmit="return confirm('Are you sure you want to delete this plot?');" class="inline">
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
