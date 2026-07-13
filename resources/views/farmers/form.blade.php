<!-- Name -->
<div>
    <label for="name" class="block text-xs font-bold text-neutral-700 uppercase tracking-wider">Farmer Name</label>
    <input id="name" type="text" name="name" value="{{ old('name', $farmer->name ?? '') }}" required autofocus placeholder="e.g. Rajesh Kumar"
           class="mt-1.5 block w-full rounded-xl border-neutral-200 shadow-sm text-sm focus:border-neutral-500 focus:ring-neutral-500" />
    @error('name')
        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Contact Number -->
<div>
    <label for="contact_number" class="block text-xs font-bold text-neutral-700 uppercase tracking-wider">Contact Number</label>
    <input id="contact_number" type="text" name="contact_number" value="{{ old('contact_number', $farmer->contact_number ?? '') }}" required placeholder="e.g. +91 98765 00001"
           class="mt-1.5 block w-full rounded-xl border-neutral-200 shadow-sm text-sm focus:border-neutral-500 focus:ring-neutral-500" />
    @error('contact_number')
        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Address -->
<div>
    <label for="address" class="block text-xs font-bold text-neutral-700 uppercase tracking-wider">Address</label>
    <textarea id="address" name="address" rows="3" required placeholder="e.g. Gat No. 112, Pimpalgaon Baswant, Nashik, Maharashtra - 422209"
              class="mt-1.5 block w-full rounded-xl border-neutral-200 shadow-sm text-sm focus:border-neutral-500 focus:ring-neutral-500">{{ old('address', $farmer->address ?? '') }}</textarea>
    @error('address')
        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="pt-2">
    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2.5 text-xs font-semibold text-white bg-neutral-900 hover:bg-neutral-800 rounded-xl transition shadow-sm">
        {{ isset($farmer) ? 'Update Farmer' : 'Save Farmer' }}
    </button>
</div>
