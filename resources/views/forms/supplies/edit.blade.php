<x-MainLayout>
    <x-slot name="titlePage">
        Order Supplies
    </x-slot>
    <x-slot name="activePage">
        ordersupplies
    </x-slot>
    @section('content')
    <div class="flex justify-center">
        <div class="w-full block rounded-lg shadow-lg bg-white">
            <div class="py-3 px-6 border-b border-gray-300 bg-indigo-600 text-white">
                <h5 class="font-bold">Edit Supplies</h5>
            </div>
            <form method="post" action="{{ '/forms/ordersupplies/' . $formsupply->first()->FormId }}" autocomplete="off"
                class="form-horizontal">
                @csrf
                @method('put')

                <div class="p-6">
                    <div class="">
                        <div class="form-group mb-2">
                            <label class="text-gray-900 text-sm font-medium mb-2">
                                Submitted On: </label>
                            <label class="text-gray-900 text-sm font-small mb-2">
                                {{ empty($forms->first()->SubmittedOn) ? '' : \Carbon\Carbon::parse($forms->first()->SubmittedOn)->format('m/d/Y') }}</label>
                        </div>
                        <div class="form-group mb-2">
                            <label class="text-gray-900 text-sm font-medium mb-2">Submitted By: </label>
                            <label class="text-gray-900 text-sm font-small mb-2">
                                {{ empty($forms->first()->formusers) ? '' : $forms->first()->formusers->firstname . ' ' . $forms->first()->formusers->lastname }}</label>
                        </div>
                        <div class="form-group mb-2">
                            <x-table>
                                <x-slot name="header">
                                    <x-table.heading>ItemNo</x-table.heading>
                                    <x-table.heading>Unit</x-table.heading>
                                    <x-table.heading>Description</x-table.heading>
                                    <x-table.heading>Quantity</x-table.heading>
                                    <x-table.heading>Unit Price</x-table.heading>
                                    <x-table.heading>Sub Total</x-table.heading>
                                </x-slot>
                                <x-slot name="body">
                                    @foreach($formsupply as $item)
                                    <tr>
                                        <x-table.row>{{$item->SupplyTypes->ItemNo}}</x-table.row>
                                        <x-table.row>{{$item->SupplyTypes->Unit}}</x-table.row>
                                        <x-table.row>{{$item->SupplyTypes->Description}}</x-table.row>
                                        <x-table.row>{{$item->Quantity}}</x-table.row>
                                        <x-table.row>{{number_format($item->SupplyTypes->PhysicianPrice,2)}}
                                        </x-table.row>
                                        <x-table.row>{{$item->Quantity * $item->SupplyTypes->PhysicianPrice}}
                                        </x-table.row>
                                    </tr>
                                    @endforeach
                                </x-slot>
                            </x-table>
                        </div>
                        <div class="form-group mb-2">
                            <label class="text-gray-900 text-sm font-medium mb-2">Reason: </label>
                            <textarea name="reason" class="form-control block w-full px-3 py-1.5 text-base
                                font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                rounded transition ease-in-out m-0 datepicker
                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" cols="10"
                                rows="5"></textarea>
                        </div>
                    </div>
                </div>
                <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                    <button type="submit" value="approve" name="action"
                        class="inline-block px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">Approve</button>
                    <button type="submit" value="reject" name="action"
                        class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase
                            rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-500 focus:shadow-lg focus:outline-none
                            focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">Reject</button>
                    <a href="/formexplorer"
                        class="inline-block px-6 py-2.5 bg-orange-600 text-white font-medium text-xs leading-tight uppercase
                        rounded shadow-md hover:bg-orange-700 hover:shadow-lg focus:bg-orange-500 focus:shadow-lg focus:outline-none
                        focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">{{ __('Back to list') }}</a>
                </div>
            </form>
        </div>
    </div>
    @endsection
</x-MainLayout>