@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }}>
    <span class="label-text">{{ $value ?? $slot }}</span>
</label>
