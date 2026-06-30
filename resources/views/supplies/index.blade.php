<x-app-layout>
    <div class="py-10 bg-[#f5f5f7] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-neutral-900">Supplies</h1>
                    <p class="text-xs text-neutral-500 mt-0.5">Logs of input applications (fertilizer, seeds, etc.) applied to crops.</p>
                </div>
                <a href="{{ route('supplies.create') }}" class="inline-flex items-center justify-center px-4 py-2 text-xs font-semibold text-white bg-neutral-900 hover:bg-neutral-800 rounded-xl transition shadow-sm">
                    Apply Supply/Input
                </a>
            </div>

            @if(session('success'))
                <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-xl text-xs">
                    {{ session('success') }}
                </div>
            @endif

            @if($supplies->isEmpty())
                <div class="bg-white rounded-2xl border border-neutral-100 p-12 text-center shadow-sm">
                    <p class="text-sm text-neutral-400">No supplies recorded yet.</p>
                    <a href="{{ route('supplies.create') }}" class="mt-4 inline-flex items-center text-xs font-semibold text-neutral-900 underline">
                        Record your first application
                    </a>
                </div>
            @else
                <div class="bg-white rounded-2xl border border-neutral-100 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-neutral-200 text-left text-sm">
                            <thead class="bg-neutral-50">
                                <tr>
                                    <th class="px-6 py-3.5 text-xs font-bold text-neutral-500 uppercase tracking-wider">Crop</th>
                                    <th class="px-6 py-3.5 text-xs font-bold text-neutral-500 uppercase tracking-wider">Plot / Farmer</th>
                                    <th class="px-6 py-3.5 text-xs font-bold text-neutral-500 uppercase tracking-wider">Input Material</th>
                                    <th class="px-6 py-3.5 text-xs font-bold text-neutral-500 uppercase tracking-wider">Applied Qty</th>
                                    <th class="px-6 py-3.5 text-xs font-bold text-neutral-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3.5 text-xs font-bold text-neutral-500 uppercase tracking-wider text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-200/60">
                                @foreach($supplies as $supply)
                                    <tr class="hover:bg-neutral-50/50 transition-colors">
                                        <td class="px-6 py-4">
                                            <span class="font-bold text-neutral-900">{{ $supply->crop->name }}</span>
                                            <span class="text-xs text-neutral-400 block">{{ $supply->crop->variety }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-neutral-800 block font-medium">{{ $supply->crop->plot->name }}</span>
                                            <span class="text-xs text-neutral-400 block">{{ $supply->crop->plot->farmer->name }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="font-medium text-neutral-900">{{ $supply->input->name }}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="font-bold text-neutral-800">{{ $supply->quantity }}</span>
                                            <span class="text-xs text-neutral-400 ml-0.5">{{ $supply->input->unit }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-xs text-neutral-500">
                                            {{ \Carbon\Carbon::parse($supply->loading_date)->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-right text-xs">
                                            <div class="flex items-center justify-end space-x-3">
                                                <a href="{{ route('supplies.edit', $supply) }}" title="Edit">
                                                    <x-icon-edit />
                                                </a>
                                                <form method="POST" action="{{ route('supplies.destroy', $supply) }}" onsubmit="return confirm('Are you sure you want to delete this supply record?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Delete" class="align-middle">
                                                        <x-icon-delete />
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
