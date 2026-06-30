<x-app-layout>
    <div class="py-10 bg-[#f5f5f7] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-neutral-900">Inputs</h1>
                    <p class="text-xs text-neutral-500 mt-0.5">Master list of agricultural inputs (fertilizers, seeds, chemicals, etc.).</p>
                </div>
                <a href="{{ route('inputs.create') }}" class="inline-flex items-center justify-center px-4 py-2 text-xs font-semibold text-white bg-neutral-900 hover:bg-neutral-800 rounded-xl transition shadow-sm">
                    Create Input Item
                </a>
            </div>

            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-xl text-xs">
                    {{ session('success') }}
                </div>
            @endif

            @if($inputs->isEmpty())
                <div class="bg-white rounded-2xl border border-neutral-100 p-12 text-center shadow-sm">
                    <p class="text-sm text-neutral-400">No inputs defined yet.</p>
                    <a href="{{ route('inputs.create') }}" class="mt-4 inline-flex items-center text-xs font-semibold text-neutral-900 underline">
                        Define your first input
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($inputs as $input)
                        <div class="bg-white rounded-2xl border border-neutral-100 p-6 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between space-y-4">
                            <div>
                                <h3 class="text-sm font-bold text-neutral-950 tracking-tight">{{ $input->name }}</h3>
                                <p class="text-xs text-neutral-400 mt-1">Measured in: <span class="font-semibold text-neutral-700">{{ $input->unit }}</span></p>
                            </div>
                            <div class="border-t border-neutral-100 pt-3 flex items-center justify-between">
                                <span class="text-[10px] text-neutral-400">ID: {{ $input->id }}</span>
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('inputs.edit', $input) }}" title="Edit">
                                        <x-icon-edit />
                                    </a>
                                    <form method="POST" action="{{ route('inputs.destroy', $input) }}" onsubmit="return confirm('Are you sure you want to delete this input?');" class="inline">
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
