<x-MainLayout>
    <x-slot name="titlePage">
        Order Supplies
    </x-slot>
    <x-slot name="activePage">
        ordersupplies
    </x-slot>
    @section('content')
    <style>
    label:after {
        content: '+';
        position: absolute;
        right: 1em;
        color: #fff;
    }

    input:checked+label:after {
        content: '-';
        line-height: .8em;
    }

    .accordion__content {
        max-height: 0em;
        transition: all 0.4s cubic-bezier(0.865, 0.14, 0.095, 0.87);
    }

    input[name='panel']:checked~.accordion__content {
        /* Get this as close to what height you expect */
        max-height: 50em;
    }
    </style>
    <div class="mb-2">
        <button type="button" class="inline-block px-6 py-2.5 text-white font-medium text-xs leading-tight
                uppercase rounded shadow-md hover:shadow-lg focus:shadow-lg
                focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out bg-orange-500">
            Order History
        </button>
    </div>
    <div class="d-flex">
        <div class="mx-auto">
            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-2/4 px-3 mb-6 md:mb-0">
                    @livewire('supplylist')
                </div>
                <div class="w-full md:w-2/4 px-3 mb-6 md:mb-0">
                    <div
                        class="w-full rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">

                        <form method="post" action="/forms/ordersupplies" autocomplete="off">
                            @csrf
                            {{ csrf_field() }}
                            <input type="hidden" id="hdnIds" name="hdnIds">
                            <div class="p-5 bg-blue-100">
                                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Your
                                    Order Summary</h5>
                                <p class="mb-3 font-normal text-sm text-gray-700 dark:text-gray-400">Please select the
                                    items from the table and click "Add to Order" button.</p>
                                <p id="porders">

                                </p>
                            </div>
                            <div class="p-5">
                                <h5 class="mb-2 text-sm font-bold tracking-tight text-gray-900 dark:text-white">Verify
                                    Shipping Address</h5>
                                <div class="d-flex">
                                    <div class="mx-auto">
                                        <div class="flex flex-col">
                                            <div class="-mx-3 md:flex">
                                                <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                                    <label class="block tracking-wide text-grey-darker text-xs mb-2">
                                                        Address1
                                                    </label>
                                                    <input
                                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-1 px-2 mb-3"
                                                        id="address1" type="text" name="address1" required>
                                                </div>
                                                <div class="md:w-1/2 px-3">
                                                    <label class="block tracking-wide text-grey-darker text-xs mb-2">
                                                        Address2
                                                    </label>
                                                    <input
                                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-1 px-2"
                                                        id="address2" type="text" name="address2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="mx-auto">
                                        <div class="flex flex-col">
                                            <div class="-mx-3 md:flex">
                                                <div class="md:w-1/3 px-3 mb-6 md:mb-0">
                                                    <label class="block tracking-wide text-grey-darker text-xs mb-2">
                                                        City
                                                    </label>
                                                    <input
                                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-red rounded py-1 px-2 mb-3"
                                                        id="city" type="text" name="city" required>
                                                </div>
                                                <div class="md:w-1/3 px-3">
                                                    <label class="block tracking-wide text-grey-darker text-xs mb-2">
                                                        State
                                                    </label>
                                                    <input
                                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-1 px-2"
                                                        id="state" type="text" name="state" required>
                                                </div>
                                                <div class="md:w-1/3 px-3">
                                                    <label class="block tracking-wide text-grey-darker text-xs mb-2">
                                                        Zipcode
                                                    </label>
                                                    <input
                                                        class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-1 px-2"
                                                        id="zipcode" type="text" name="zipcode" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="mx-auto">
                                        <div class="flex flex-col">
                                            <div class="-mx-3 md:flex">
                                                <div class="w-full px-3 mb-6 md:mb-0 text-left text-sm text-bold">
                                                    <input type="checkbox">Yes this is correct shipping address
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="mx-auto">
                                        <div class="flex flex-col">
                                            <div class="-mx-3 md:flex">
                                                <div class="w-full px-3 mb-6 md:mb-0 text-right">
                                                    <button type="button" class="inline-block px-6 py-2.5 text-white font-medium text-xs leading-tight
                uppercase rounded shadow-md hover:shadow-lg focus:shadow-lg
                focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out bg-red-500"
                                                        data-toggle="modal" data-target="#exampleModal">
                                                        Cancel
                                                    </button>
                                                    <button type="submit"
                                                        class="inline-block px-6 py-2.5 text-white font-medium text-xs leading-tight
                                                        uppercase rounded shadow-md hover:shadow-lg focus:shadow-lg
                                                        focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out bg-green-500"
                                                        data-toggle="modal" data-target="#exampleModal">
                                                        Submit Order
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).on("click", ".addtoorder", function() {
        $("#hdnIds").val($("#hdnIds").val() + "," + $(this).attr("data-id"));
        $.ajax({
            url: '/createorder',
            data: {
                'data': $("#hdnIds").val()
            },
            method: "POST",
            success: function(data) {
                $("#porders").html(data);
            }
        });
    });

    $(document).on("click", ".deletetype", function() {
        if (confirm("Are you sure to remove from your order?")) {
            $("#hdnIds").val($("#hdnIds").val().replaceAll($(this).attr("data-id"), ""));
            $.ajax({
                url: '/createorder',
                data: {
                    'data': $("#hdnIds").val()
                },
                method: "POST",
                success: function(data) {
                    $("#porders").html(data);
                }
            });
        }
    });
    </script>
    @endsection
</x-MainLayout>