<x-app-layout>
    <div class="py-10 bg-[#f5f5f7] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-neutral-900">Observations</h1>
                    <p class="text-xs text-neutral-500 mt-0.5">Field notes, crop health monitoring logs, and general observations.</p>
                </div>
                <a href="{{ route('observations.create') }}" class="inline-flex items-center justify-center px-4 py-2 text-xs font-semibold text-white bg-neutral-900 hover:bg-neutral-800 rounded-xl transition shadow-sm">
                    Log Observation
                </a>
            </div>

            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-xl text-xs">
                    {{ session('success') }}
                </div>
            @endif

            @if($observations->isEmpty())
                <div class="bg-white rounded-2xl border border-neutral-100 p-12 text-center shadow-sm">
                    <p class="text-sm text-neutral-400">No observations logged yet.</p>
                    <a href="{{ route('observations.create') }}" class="mt-4 inline-flex items-center text-xs font-semibold text-neutral-900 underline">
                        Log your first observation
                    </a>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($observations as $obs)
                        <div class="bg-white rounded-2xl border border-neutral-100 p-6 shadow-sm hover:shadow-md transition-all duration-300">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-neutral-100 pb-3">
                                <div>
                                    <span class="text-sm font-bold text-neutral-950">{{ $obs->crop->name }}</span>
                                    <span class="text-xs text-neutral-400 ml-1">({{ $obs->crop->variety }})</span>
                                    <span class="text-xs text-neutral-400 block mt-0.5">
                                        Plot: {{ $obs->crop->plot->name }} | Farmer: {{ $obs->crop->plot->farmer->name }}
                                    </span>
                                </div>
                                <div class="mt-2 sm:mt-0 flex items-center space-x-3">
                                    <span class="text-xs text-neutral-400">Observed: <strong>{{ \Carbon\Carbon::parse($obs->observation_date)->format('M d, Y') }}</strong></span>
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('observations.edit', $obs) }}" title="Edit">
                                            <x-icon-edit />
                                        </a>
                                        <form method="POST" action="{{ route('observations.destroy', $obs) }}" onsubmit="return confirm('Are you sure you want to delete this observation?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Delete" class="align-middle">
                                                <x-icon-delete />
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4 text-sm text-neutral-700 leading-relaxed italic">
                                "{{ $obs->observation }}"
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
