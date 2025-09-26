<option value="{{ $attributes->get('value') }}"
    {{ empty($attributes->get('selected')) ? '' : 'selected="' . $attributes->get('selected') . '"' }}>
    {{ $slot }}
</option>
