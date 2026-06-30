<x-app-layout>
    <div class="py-10 bg-[#f5f5f7] min-h-screen">
        <div class="max-w-xl mx-auto px-4 sm:px-6 space-y-6">
            
            <div>
                <a href="{{ route('farmers.index') }}" class="text-xs font-medium text-neutral-400 hover:text-neutral-950 flex items-center space-x-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    <span>Back to Farmers</span>
                </a>
                <h1 class="text-2xl font-bold tracking-tight text-neutral-900 mt-3">Edit Farmer</h1>
                <p class="text-xs text-neutral-500 mt-0.5">Update farmer details.</p>
            </div>

            <div class="bg-white rounded-2xl border border-neutral-100 p-6 shadow-sm">
                <form method="POST" action="{{ route('farmers.update', $farmer) }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    @include('farmers.form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
