<x-table class="min-w-full">
    <x-slot name="header">
        <x-table.heading>Description</x-table.heading>
        <x-table.heading>Unit</x-table.heading>
        <x-table.heading>Qty</x-table.heading>
        <x-table.heading></x-table.heading>
    </x-slot>
    <x-slot name="body">
        @if (!empty($supplies))
        @foreach ($supplies as $s => $details)
        <tr>
            <x-table.row>
                {{$details["Description"]}}
            </x-table.row>
            <x-table.row>
                {{$details["Unit"]}}
            </x-table.row>
            @foreach($arrcnt as $c => $val)
            @if($c == $details["Id"])
            <x-table.row>
                <input
                    class="appearance-none block bg-grey-lighter text-xs text-grey-darker border border-red rounded py-1 px-2 mb-1"
                    type="text" style="width: 50px;" name="qty" value="{{ $val }}">
            </x-table.row>
            <x-table.row>
                <a href="javascript:;" class="deletetype" data-id="{{$c}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-trash-2" style="color: red;">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                        </path>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                </a>
            </x-table.row>
            @endif
            @endforeach
        </tr>
        @endforeach
        @endif
    </x-slot>
</x-table>