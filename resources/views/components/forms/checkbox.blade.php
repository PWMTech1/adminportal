<input type="checkbox" name="{{ $attributes->get('name') }}" id="{{ $attributes->get('id') }}"
    value="{{ $attributes->get('value') }}" {{ $attributes->get('required') }} {{ $attributes->get('checked') }}
    {{ $attributes->get('disabled') }}>
{{ $slot }}</a>
