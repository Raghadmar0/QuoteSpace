@props(['name', 'label', 'type' => 'text', 'value' => '', 'hint' => ''])

<div class="mb-5">
    <label for="{{ $name }}" class="block text-xs font-semibold uppercase tracking-wider text-stone-700 mb-1.5">
        {{ $label }}
    </label>
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        value="{{ old($name, $value) }}"
        {{ $attributes->merge(['class' => 'w-full px-3.5 py-2.5 text-sm bg-stone-50 border border-stone-300 rounded-lg focus:ring-2 focus:ring-emerald-600 focus:border-emerald-600 focus:bg-white transition']) }}
    >
    @if ($hint)
        <p class="mt-1 text-xs text-stone-500">{{ $hint }}</p>
    @endif
    <x-validation-error :field="$name" />
</div>
