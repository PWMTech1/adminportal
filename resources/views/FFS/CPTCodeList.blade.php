<x-MainLayout>
    <x-slot name="titlePage">
        CPT Code List
    </x-slot>
    <x-slot name="activePage">
        compensation
    </x-slot>
    @section('content')
        <div class="flex justify-center mb-3">
            <x-table class="">
                <x-slot name="header">
                    <x-table.heading>Index</x-table.heading>
                    <x-table.heading>CPT</x-table.heading>
                    <x-table.heading>Description</x-table.heading>
                    <x-table.heading>Type</x-table.heading>
                    <x-table.heading>EM/Procedure</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @foreach ($codes as $c)
                        <tr>
                            <x-table.row>
                                {{ $c->index }}
                            </x-table.row>
                            <x-table.row>
                                {{ $c->CPT }}
                            </x-table.row>
                            <x-table.row>
                                {{ $c['SHORT DESCRIPTION'] }}
                            </x-table.row>
                            <x-table.row>
                                {{ $c->Type }}
                            </x-table.row>
                            <x-table.row>
                                {{ $c['EM/Procedure'] }}
                            </x-table.row>
                        </tr>
                    @endforeach
                </x-slot>
            </x-table>
        </div>
        <div class="flex justify-center">
            <div class="w-full block rounded-lg shadow-lg bg-white">
                <div class="py-3 px-6 border-b border-gray-300 bg-indigo-600 text-white">
                    <h5 class="font-bold">Add New CPT Code</h5>
                </div>
                <form method="POST" action="/ffs/cptcode/store" autocomplete="off" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf
                    {{ csrf_field() }}
                    @method('post')
                    <div class="p-6">
                        <div class="">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="form-group mb-6">
                                    <label class="text-gray-900 text-sm font-medium mb-2">Index</label>
                                    <input name="index" id="index" type="text" placeholder="{{ __('index') }}" value=""
                                        required aria-required="true"
                                        class="form-control block w-full px-3 py-1.5 text-base
                                    font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                    rounded transition ease-in-out m-0 datepicker
                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                </div>
                                <div class="form-group mb-6">
                                    <label class="text-gray-900 text-sm font-medium mb-2">CPT COde</label>
                                    <input name="code" id="code" type="text" placeholder="{{ __('CPTCode') }}" value=""
                                        required aria-required="true"
                                        class="form-control block w-full px-3 py-1.5 text-base
                                    font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                    rounded transition ease-in-out m-0 datepicker
                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="form-group mb-6">
                                    <label class="text-gray-900 text-sm font-medium mb-2">Short Description</label>
                                    <input name="shortdescription" id="shortdescription" type="text"
                                        placeholder="{{ __('Short Description') }}" value="" required aria-required="true"
                                        class="form-control block w-full px-3 py-1.5 text-base
                                    font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                    rounded transition ease-in-out m-0 datepicker
                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                </div>
                                <div class="form-group mb-6">
                                    <label class="text-gray-900 text-sm font-medium mb-2">Type</label>
                                    <input name="type" id="type" type="text" placeholder="{{ __('Type') }}" value=""
                                        required aria-required="true"
                                        class="form-control block w-full px-3 py-1.5 text-base
                                    font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                    rounded transition ease-in-out m-0 datepicker
                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="form-group mb-6">
                                    <label class="text-gray-900 text-sm font-medium mb-2">EM/Procedure</label>
                                    <select name="procedure" id="procedure" required aria-required="true"
                                        class="form-control block w-full px-3 py-1.5 text-base
                                    font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                    rounded transition ease-in-out m-0 datepicker
                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                        <option></option>
                                        <option value="EM">EM</option>
                                        <option value="Procedure">Procedure</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                        <a href="/ffs/compensation"
                            class="inline-block px-6 py-2.5 bg-orange-600 text-white font-medium text-xs leading-tight uppercase
                rounded shadow-md hover:bg-orange-700 hover:shadow-lg focus:bg-orange-500 focus:shadow-lg focus:outline-none
                focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">{{ __('Back to Compensation') }}</a>
                        <button type="submit"
                            class="inline-block px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight
                        uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-500 focus:shadow-lg
                        focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">
                            Save CPT
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
</x-MainLayout>
