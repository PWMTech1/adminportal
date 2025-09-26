<input type="text" name="{{ $attributes->get('name') }}" id="{{ $attributes->get('id') }}"
    placeholder="{{ $attributes->get('placeholder') }}" value="{{ $attributes->get('value') }}"
    {{ $attributes->get('required') }}
    {{ $attributes->merge([
        'class' => 'form-control block w-full px-3 py-1.5 text-base
                                                font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                                rounded transition ease-in-out m-0 datepicker
                                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none',
    ]) }}
    {{ $attributes->get('readonly') }}>
{{ $slot }}</a>
