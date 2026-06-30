<x-app-layout>
    <div class="py-10 bg-[#f5f5f7] min-h-screen">
        <div class="max-w-xl mx-auto px-4 sm:px-6 space-y-6">
            
            <div>
                <a href="{{ route('inputs.index') }}" class="text-xs font-medium text-neutral-400 hover:text-neutral-950 flex items-center space-x-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    <span>Back to Inputs</span>
                </a>
                <h1 class="text-2xl font-bold tracking-tight text-neutral-900 mt-3">Create Input Item</h1>
                <p class="text-xs text-neutral-500 mt-0.5">Add a new fertilizer, seed variety, or pesticide to the master list.</p>
            </div>

            <div class="bg-white rounded-2xl border border-neutral-100 p-6 shadow-sm">
                <form method="POST" action="{{ route('inputs.store') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-xs font-bold text-neutral-700 uppercase tracking-wider">Input Item Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="e.g. Urea, Neem Cake Manure, Vermicompost, Neem Oil"
                               class="mt-1.5 block w-full rounded-xl border-neutral-200 shadow-sm text-sm focus:border-neutral-500 focus:ring-neutral-500" />
                        @error('name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Unit -->
                    <div>
                        <label for="unit" class="block text-xs font-bold text-neutral-700 uppercase tracking-wider">Measurement Unit</label>
                        <input id="unit" type="text" name="unit" value="{{ old('unit') }}" required placeholder="e.g. kg, Litres, Bags, Tonnes"
                               class="mt-1.5 block w-full rounded-xl border-neutral-200 shadow-sm text-sm focus:border-neutral-500 focus:ring-neutral-500" />
                        @error('unit')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 text-xs font-semibold text-white bg-neutral-900 hover:bg-neutral-800 rounded-xl transition shadow-sm">
                            Save Input Item
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
