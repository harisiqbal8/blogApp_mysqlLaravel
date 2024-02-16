@props(['name', 'onkeypress' => '', 'onfocusout' => ''])
<div class="mb-6">
    <x-form.label name="{{ $name }}" />
    <input class="border border-gray-200 p-2 w-full rounded" 
        name="{{ $name }}"
        id="{{ $name }}" 
        value="{{ old('$name') }}" 
        onkeypress="{{ $onkeypress }}"
        onfocusout="{{ $onfocusout }}" 
        required
        {{ $attributes }}
    >
    <x-form.error name="{{ $name }}" />
</div>
