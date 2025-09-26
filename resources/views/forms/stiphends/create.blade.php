<x-MainLayout>
    <x-slot name="titlePage">
        Clinician Stipends
    </x-slot>
    <x-slot name="activePage">
        adjustments
    </x-slot>
    @section('content')
        <div class="flex justify-center">
            <div class="w-full block rounded-lg shadow-lg bg-white">
                <div class="py-3 px-6 border-b border-gray-300 bg-indigo-600 text-white">
                    <h5 class="font-bold">Add Stiphends</h5>
                </div>
                <form method="POST" action="/forms/stiphends/store" autocomplete="off" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf
                    {{ csrf_field() }}
                    @method('post')
                    <div class="p-6">
                        <div class="">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="form-group mb-6">
                                    <label class="text-gray-900 text-sm font-medium mb-2">Service
                                        From
                                        Date</label>
                                    <input name="fromdate" id="fromdate" type="text" placeholder="{{ __('From Date') }}"
                                        value="" required aria-required="true"
                                        class="form-control block w-full px-3 py-1.5 text-base
                                        font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                        rounded transition ease-in-out m-0 datepicker
                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                </div>
                                <div class="form-group mb-6">
                                    <label class="text-gray-900 text-sm font-medium mb-2">Service
                                        To Date</label>
                                    <input name="todate" id="todate" type="text" placeholder="{{ __('To Date') }}"
                                        value="" required aria-required="true"
                                        class="form-control block w-full px-3 py-1.5 text-base
                                        font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                        rounded transition ease-in-out m-0 datepicker
                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="form-group mb-6">
                                    <label class="text-gray-900 text-sm font-medium mb-2">Clinician</label>
                                    <select name="clinician" id="clinician" required aria-required="true"
                                        class="form-control block w-full px-3 py-1.5 text-base
                                    font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                    rounded transition ease-in-out m-0
                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                        <option></option>
                                        @foreach ($user as $u)
                                            <option value="{{ $u->id }}">
                                                {{ $u->firstname . ' ' . $u->lastname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-6">
                                    <label class="text-gray-900 text-sm font-medium mb-2">Stipend Type</label>
                                    <select name="stiphend" id="stiphend" required aria-required="true"
                                        class="form-control block w-full px-3 py-1.5 text-base
                                    font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                    rounded transition ease-in-out m-0
                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                        <option></option>
                                        <option value="5">Ramp-up Stipend</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mb-6">
                                <label class="text-gray-900 text-sm font-medium mb-2">Amount</label>
                                <input name="amount" id="amount" type="text" placeholder="{{ __('Amount') }}" value=""
                                    required aria-required="true"
                                    class="form-control block w-full px-3 py-1.5 text-base
                                    font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                    rounded transition ease-in-out m-0
                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                            </div>
                        </div>
                    </div>

                    <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                        <a href="/formexplorer"
                            class="inline-block px-6 py-2.5 bg-orange-600 text-white font-medium text-xs leading-tight uppercase
                    rounded shadow-md hover:bg-orange-700 hover:shadow-lg focus:bg-orange-500 focus:shadow-lg focus:outline-none
                    focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">{{ __('Back to list') }}</a>
                        <button type="submit"
                            class="inline-block px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight
                            uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-500 focus:shadow-lg
                            focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">
                            Submit Stiphend
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            $('.datepicker').datepicker();
        </script>
    @endsection
</x-MainLayout>
