@foreach ($supply->groupby('Category') as $key => $value)
<div class="accordion flex flex-col">
    <div>
        <input type="checkbox" name="panel" id="{{ 'panel-' . $loop->iteration }}" class="hidden">
        <label for="{{ 'panel-' . $loop->iteration }}" class="relative block bg-blue-400 text-white p-2 shadow
                                    border-b border-grey text-xs">{{ $value->first()->Category }}</label>
        <div class="accordion__content overflow-hidden bg-grey-lighter">
            <x-table>
                <x-slot name="header"></x-slot>
                <x-slot name="body">
                    @foreach ($value as $v)
                    <tr>
                        <x-table.row>
                            {{ $v->Description }}
                        </x-table.row>
                        <x-table.row>
                            {{ $v->Unit }}
                        </x-table.row>

                        <x-table.row class="td-actions text-right">
                            <button type="button"
                                class="addtoorder bg-blue-500 hover:bg-red-700' text-xs text-white text-center py-1 px-1 rounded"
                                data-id="{{$v->Id}}">Add
                                To Order</button>
                        </x-table.row>
                    </tr>
                    @endforeach
                </x-slot>
            </x-table>
        </div>
    </div>
</div>
@endforeach