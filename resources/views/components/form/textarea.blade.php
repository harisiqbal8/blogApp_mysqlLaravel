@props(['name'])
<div class="mb-6">
    <div class="flex mb-2 justify-between">
        <x-form.label name="{{ $name }}" />
    </div>
    <textarea 
        class="border border-gray-200 p-2 w-full rounded" 
        type="textarea" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        required>{{ $slot ?? old($name) }}</textarea>
    <x-form.error name="{{ $name }}" />
</div>