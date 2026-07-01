<x-app-layout>
    <div class="py-10 bg-[#f5f5f7] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-neutral-900">Farmers</h1>
                    <p class="text-xs text-neutral-500 mt-0.5">List of registered agricultural partners and their locations.</p>
                </div>
                <a href="{{ route('farmers.create') }}" class="inline-flex items-center justify-center px-4 py-2 text-xs font-semibold text-white bg-neutral-900 hover:bg-neutral-800 rounded-xl transition shadow-sm">
                    Add New Farmer
                </a>
            </div>

            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-xl text-xs">
                    {{ session('success') }}
                </div>
            @endif

            @if($farmers->isEmpty())
                <div class="bg-white rounded-2xl border border-neutral-100 p-12 text-center shadow-sm">
                    <p class="text-sm text-neutral-400">No farmers registered yet.</p>
                    <a href="{{ route('farmers.create') }}" class="mt-4 inline-flex items-center text-xs font-semibold text-neutral-900 underline">
                        Register your first farmer
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($farmers as $farmer)
                        <div class="bg-white rounded-2xl border border-neutral-100 p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between space-y-4">
                            <div>
                                <div class="flex justify-between items-start">
                                    <h3 class="text-base font-bold text-neutral-900 tracking-tight">{{ $farmer->name }}</h3>
                                    <span class="text-[10px] font-medium text-neutral-400 bg-neutral-50 px-2.5 py-1 rounded-full border border-neutral-200/40">
                                        {{ $farmer->plots_count }} {{ Str::plural('Plot', $farmer->plots_count) }}
                                    </span>
                                </div>
                                <div class="mt-3 space-y-2">
                                    <div class="flex items-start space-x-2 text-xs text-neutral-500">
                                        <svg class="w-4 h-4 text-neutral-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        <span>{{ $farmer->location }}</span>
                                    </div>
                                    <div class="flex items-start space-x-2 text-xs text-neutral-500">
                                        <svg class="w-4 h-4 text-neutral-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                        <span>{{ $farmer->address }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="border-t border-neutral-100 pt-3 flex items-center justify-between">
                                <span class="text-[10px] text-neutral-400">Registered: {{ $farmer->created_at->format('M d, Y') }}</span>
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('farmers.edit', $farmer) }}" title="Edit">
                                        <x-icon-edit />
                                    </a>
                                    <form method="POST" action="{{ route('farmers.destroy', $farmer) }}" onsubmit="return confirm('Are you sure you want to delete this farmer and all associated plots?');" class="inline">
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
