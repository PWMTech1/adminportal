<x-MainLayout>
    <x-slot name="titlePage">
        List of Reports
    </x-slot>
    <x-slot name="activePage">
        reports
    </x-slot>
    @section('content')
    <div class="flex flex-wrap" id="tabs-id">
        <div class="w-full">
            <ul class="flex mb-0 list-none flex-wrap pt-3 pb-0 flex-row">
                <li class="-mb-px mr-0 last:mr-0 flex-auto text-center">
                    <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-white bg-indigo-600"
                        onclick="changeAtiveTab(event,'tab-profile')">
                        Weekly
                    </a>
                </li>
                <li class="-mb-px mr-0 last:mr-0 flex-auto text-center">
                    <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-indigo-600 bg-white"
                        onclick="changeAtiveTab(event,'tab-settings')">
                        Monthly
                    </a>
                </li>
                <li class="-mb-px mr-0 last:mr-0 flex-auto text-center">
                    <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-indigo-600 bg-white"
                        onclick="changeAtiveTab(event,'tab-patient')">
                        Patient Report
                    </a>
                </li>
                <li class="-mb-px mr-0 last:mr-0 flex-auto text-center">
                    <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-indigo-600 bg-white"
                        onclick="changeAtiveTab(event, 'tab-patientmanage')">Patient Management</a>
                </li>
                <li class="-mb-px mr-0 last:mr-0 flex-auto text-center">
                    <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-indigo-600 bg-white"
                        onclick="changeAtiveTab(event, 'tab-latesync')">Late Sync</a>
                </li>
            </ul>
            <div
                class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg border-2 border-indigo-60">
                <div class="px-0 py-0 flex-auto">
                    <div class="tab-content tab-space">
                        <div class="block" id="tab-profile">
                            <iframe
                                src="https://reports.innovativemedsolution.com/public/dashboard/ee5f183d-c3d6-48ec-b11d-0145d8ea3e57"
                                frameborder="0" width="800" height="600" allowtransparency
                                style="width: 100%;height:800px;">
                            </iframe>
                        </div>
                        <div class="hidden" id="tab-settings">
                            <iframe
                                src="https://reports.innovativemedsolution.com/public/dashboard/701e690a-08d3-4e1f-bfda-26008a345fab"
                                frameborder="0" width="800" height="600" allowtransparency
                                style="width: 100%;height:800px;"></iframe>
                        </div>
                        <div class="hidden" id="tab-patient">
                            <a href="/downloadcsv"
                                class="inline-block px-6 py-2.5 bg-orange-600 text-white font-medium text-xs leading-tight uppercase
                                rounded shadow-md hover:bg-orange-700 hover:shadow-lg focus:bg-orange-500 focus:shadow-lg focus:outline-none
                                focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">Export</a>
                            <iframe
                                src="https://reports.innovativemedsolution.com/public/dashboard/2ffecad2-197d-476a-8549-617988328668"
                                frameborder="0" width="800" height="600" allowtransparency
                                style="width: 100%;height:800px;"></iframe>
                        </div>
                        <div class="hidden" id="tab-patientmanage">
                            <iframe
                                src="https://reports.innovativemedsolution.com/public/dashboard/85252a9b-e782-4149-8a4f-b16e5664e5d1"
                                frameborder="0" width="800" height="600" allowtransparency
                                style="width: 100%;height:800px;"></iframe>
                        </div>
                        <div class="hidden" id="tab-latesync">
                            <iframe
                                src="https://reports.innovativemedsolution.com/public/question/f0c40ad5-cb9e-402e-bd4e-3766e02b67f5"
                                frameborder="0" width="800" height="600" allowtransparency
                                style="width: 100%;height:800px;"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    function changeAtiveTab(event, tabID) {
        let element = event.target;
        while (element.nodeName !== "A") {
            element = element.parentNode;
        }
        ulElement = element.parentNode.parentNode;
        aElements = ulElement.querySelectorAll("li > a");
        tabContents = document.getElementById("tabs-id").querySelectorAll(".tab-content > div");
        for (let i = 0; i < aElements.length; i++) {
            aElements[i].classList.remove("text-white");
            aElements[i].classList.remove("bg-indigo-600");
            aElements[i].classList.add("text-indigo-600");
            aElements[i].classList.add("bg-white");
            tabContents[i].classList.add("hidden");
            tabContents[i].classList.remove("block");
        }
        element.classList.remove("text-indigo-600");
        element.classList.remove("bg-white");
        element.classList.add("text-white");
        element.classList.add("bg-indigo-600");
        document.getElementById(tabID).classList.remove("hidden");
        document.getElementById(tabID).classList.add("block");
    }
    </script>
    @endsection
</x-MainLayout>