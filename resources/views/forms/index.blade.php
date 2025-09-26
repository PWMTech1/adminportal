<?php
use App\Http\Controllers\HomeController;
use App\Roles;
$permissions = HomeController::getAllPermissionsPerUser();

?>
<x-MainLayout>
    <x-slot name="titlePage">
        FFS Stipends Management
    </x-slot>
    <x-slot name="activePage">
        adjustments
    </x-slot>
    @section('content')
        <a href="/forms/mileage"
            class="bg-green-500 hover:bg-green-700' text-xs text-white text-center py-2 px-3 rounded mt-2 mb-3">Mileage</a>
        @if ($permissions->AllowAll)
            <a href="/forms/stiphends"
                class="bg-green-500 hover:bg-green-700' text-xs text-white text-center py-2 px-3 rounded mt-2 mb-3">Additional
                Stipends</a>
        @endif
        <form method="GET" action="/formexplorer">
            <div class="d-flex">
                <div class="mx-auto">
                    <div class="flex flex-wrap -mx-3 mb-2 mt-3">
                        <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-first-name">
                                Type
                            </label>
                            <select
                                class="text-xs block appearance-none bg-gray-50 border border-gray-300 text-gray-900 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="formtype">
                                <option value="">Select Type</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->Id }}">{{ $type->Description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0 pl-8">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-first-name">
                                Status
                            </label>
                            <select
                                class="text-xs block appearance-none bg-gray-50 border border-gray-300 text-gray-900 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="formstatus">
                                <option value="">Select Status</option>
                                @foreach ($status as $status)
                                    <option value="{{ $status->Id }}">{{ $status->Description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0 pl-8 mt-3">
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700' text-xs text-white text-center py-2 px-3 rounded mt-2">Filter
                                Results</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="d-flex">
            <div class="mx-auto">
                <div class="flex flex-wrap -mx-3 mb-2">
                    <x-table class="">
                        <x-slot name="header">
                            <x-table.heading>
                                Type
                            </x-table.heading>
                            <x-table.heading>Status</x-table.heading>
                            <x-table.heading>Service Start</x-table.heading>
                            <x-table.heading>Service End</x-table.heading>
                            <x-table.heading>Submitted By</x-table.heading>
                            <x-table.heading>Submitted On</x-table.heading>
                            <x-table.heading>Modified By</x-table.heading>
                            <x-table.heading>Modified On</x-table.heading>
                            <x-table.heading>Actions</x-table.heading>
                        </x-slot>
                        <x-slot name="body">
                            @foreach ($paginator as $form)
                                <tr>
                                    <x-table.row>
                                        {{ $form['formtypes']['Description'] }}
                                    </x-table.row>
                                    <x-table.row>
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                         {{ $form['formstatus']['Description'] == 'Pending'? 'bg-orange-100 text-orange-800': ($form['formstatus']['Description'] == 'Rejected'? 'bg-red-100 text-red-800': 'bg-green-100 text-green-800') }}">
                                            {{ $form['formstatus']['Description'] }}</span>
                                    </x-table.row>
                                    <x-table.row>
                                        {{ empty($form['ServiceStart']) ? '' : \Carbon\Carbon::parse($form['ServiceStart'])->format('m/d/Y') }}
                                    </x-table.row>
                                    <x-table.row>
                                        {{ empty($form['ServiceEnd']) ? '' : \Carbon\Carbon::parse($form['ServiceEnd'])->format('m/d/Y') }}
                                    </x-table.row>
                                    <x-table.row>
                                        {{ $form['formusers']['firstname'] }}
                                        {{ $form['formusers']['lastname'] }}
                                    </x-table.row>
                                    <x-table.row>
                                        {{ empty($form['SubmittedOn']) ? '' : \Carbon\Carbon::parse($form['SubmittedOn'])->format('m/d/Y') }}
                                    </x-table.row>
                                    <x-table.row>
                                        @if (!empty($form['modifiedusers']) > 0)
                                            {{ $form['modifiedusers']['firstname'] }}
                                            {{ $form['modifiedusers']['lastname'] }}
                                        @endif
                                    </x-table.row>
                                    <x-table.row>
                                        {{ empty($form['ModifiedOn']) ? '' : \Carbon\Carbon::parse($form['ModifiedOn'])->format('m/d/Y') }}
                                    </x-table.row>
                                    <x-table.row class="td-actions text-right">
                                        @if ($permissions->AllowAll & ($form['formstatus']['Id'] == 1))
                                            <a rel="tooltip"
                                                class="bg-green-700 hover:bg-green-500' text-xs text-white text-center py-1 px-3 rounded mt-2"
                                                href="{{ url($form['formtypes']['URL'] . $form['Id'] . '/edit') }}"
                                                data-original-title="" title="">
                                                Edit
                                            </a>
                                        @endif
                                    </x-table.row>
                                </tr>
                            @endforeach
                        </x-slot>
                    </x-table>
                    {{ $paginator->links() }}
                </div>
            </div>
        </div>
    @endsection
</x-MainLayout>
