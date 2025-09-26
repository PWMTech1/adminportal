<button type="{{ $attributes->get('type') }}"
    {{ $attributes->merge([
        'class' => 'inline-block px-6 py-2.5 text-white font-medium text-xs leading-tight
                    uppercase rounded shadow-md hover:shadow-lg focus:shadow-lg
                    focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out',
    ]) }}
    onclick="{{ $attributes->get('onclick') }}">
    {{ $slot }}
</button>
