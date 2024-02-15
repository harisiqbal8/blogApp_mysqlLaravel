@props(['name'])
<div class="mb-6">
    <div class="flex mb-2 justify-between">
        <label class="block uppercase font-bold text-xs text-gray-700" for="{{ $name }}">
            {{ ucwords($name) }}
        </label>
        {{ $slot }}
    </div>
    <textarea class="border border-gray-700 p-2 w-full" type="textarea" name="{{ $name }}" id="{{ $name }}" required>{{ old($name) }}</textarea>
    @error($name)
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>