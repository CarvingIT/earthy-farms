<x-app-layout>
    <div class="py-10 bg-[#f5f5f7] min-h-screen">
        <div class="max-w-xl mx-auto px-4 sm:px-6 space-y-6">
            
            <div>
                <a href="{{ route('plots.index') }}" class="text-xs font-medium text-neutral-400 hover:text-neutral-950 flex items-center space-x-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    <span>Back to Plots</span>
                </a>
                <h1 class="text-2xl font-bold tracking-tight text-neutral-900 mt-3">Add New Plot</h1>
                <p class="text-xs text-neutral-500 mt-0.5">Register a plot of land and map it to a farmer.</p>
            </div>

            <div class="bg-white rounded-2xl border border-neutral-100 p-6 shadow-sm">
                <form method="POST" action="{{ route('plots.store') }}" class="space-y-4">
                    @csrf

                    <!-- Farmer Dropdown -->
                    <div>
                        <label for="farmer_id" class="block text-xs font-bold text-neutral-700 uppercase tracking-wider">Select Farmer</label>
                        <select id="farmer_id" name="farmer_id" required autofocus
                                class="mt-1.5 block w-full rounded-xl border-neutral-200 shadow-sm text-sm focus:border-neutral-500 focus:ring-neutral-500">
                            <option value="">Choose a Farmer...</option>
                            @foreach($farmers as $farmer)
                                <option value="{{ $farmer->id }}" {{ old('farmer_id') == $farmer->id ? 'selected' : '' }}>
                                    {{ $farmer->name }} ({{ $farmer->location }})
                                </option>
                            @endforeach
                        </select>
                        @error('farmer_id')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-xs font-bold text-neutral-700 uppercase tracking-wider">Plot Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Mango Orchard, Rice Field Block A"
                               class="mt-1.5 block w-full rounded-xl border-neutral-200 shadow-sm text-sm focus:border-neutral-500 focus:ring-neutral-500" />
                        @error('name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Area -->
                    <div>
                        <label for="area" class="block text-xs font-bold text-neutral-700 uppercase tracking-wider">Plot Area (in Acres)</label>
                        <input id="area" type="number" step="0.01" name="area" value="{{ old('area') }}" required placeholder="e.g. 3.5"
                               class="mt-1.5 block w-full rounded-xl border-neutral-200 shadow-sm text-sm focus:border-neutral-500 focus:ring-neutral-500" />
                        @error('area')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 text-xs font-semibold text-white bg-neutral-900 hover:bg-neutral-800 rounded-xl transition shadow-sm">
                            Save Plot
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
