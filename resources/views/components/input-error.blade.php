@error($attributes->get('for') ?? 'model_name')
<p {{ $attributes->merge(['class' => 'text-sm text-red-600']) }}>{{ $message }}</p>
@enderror
