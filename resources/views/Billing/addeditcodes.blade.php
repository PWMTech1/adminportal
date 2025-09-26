<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
    <input type="hidden" id="hdnMRNumber" name="hdnMRNumber">
    <input type="hidden" id="hdnVisitId" name="hdnVisitId">
    <label class="text-sm font-bold">Patient Name</label>
    <div id="spPatientName" class="w-full bg-gray-100 p-2 mt-2 mb-3 text-sm">
        {{$patient[0]->FirstName . ' ' . $patient[0]->LastName}}
    </div>
    <label class="text-sm font-bold">Facility Name</label>
    <div id="spFacilityName" class="w-full bg-gray-100 p-2 mt-2 mb-3 text-sm">
        {{$patient[0]->FacilityName}}
    </div>
    <label class="text-sm font-bold">DOS</label>
    <div id="spFacilityName" class="w-full bg-gray-100 p-2 mt-2 mb-3 text-sm">
        {{$visit[0]->DOS}}
    </div>
    <div>
        <form method="POST" onsubmit="return false;" enctype="multipart/form-data">
            <input type="hidden" id="hdnCPTCodes" value="">
            <div class="grid grid-cols-10 gap-4">
                <div class="form-group mb-1">
                    <label class="text-gray-900 text-sm font-medium mb-2">CPT</label>
                    <input name="cptcode1" id="cptcode1" type="text" placeholder="CPT Code" value="" required
                        aria-required="true" class="form-control block w-full px-3 py-1.5 text-base
                                        font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                        rounded transition ease-in-out m-0 datepicker
                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                </div>
                <div class="form-group mb-1">
                    <label class="text-gray-900 text-sm font-medium mb-2">Units</label>
                    <input name="units" id="units" type="text" placeholder="Units" value="" required
                        aria-required="true" class="form-control block w-full px-3 py-1.5 text-base
                                        font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                        rounded transition ease-in-out m-0 datepicker
                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                </div>
                <div class="form-group mb-1">
                    <label class="text-gray-900 text-sm font-medium mb-2">Diag. Code1</label>
                    <input name="diagnosiscode1" id="diagnosiscode1" type="text" placeholder="Diagnosis code" value=""
                        aria-required="true" class="form-control block w-full px-3 py-1.5 text-base
                                        font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                        rounded transition ease-in-out m-0 datepicker
                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                </div>
                <div class="form-group mb-1">
                    <label class="text-gray-900 text-sm font-medium mb-2">Diag. Code2</label>
                    <input name="diagnosiscode2" id="diagnosiscode2" type="text" placeholder="Diagnosis code" value=""
                        aria-required="true" class="form-control block w-full px-3 py-1.5 text-base
                                        font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                        rounded transition ease-in-out m-0 datepicker
                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                </div>
                <div class="form-group mb-1">
                    <label class="text-gray-900 text-sm font-medium mb-2">Diag. Code3</label>
                    <input name="diagnosiscode3" id="diagnosiscode3" type="text" placeholder="Diagnosis code" value=""
                        aria-required="true" class="form-control block w-full px-3 py-1.5 text-base
                                        font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                        rounded transition ease-in-out m-0 datepicker
                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                </div>
                <div class="form-group mb-1">
                    <label class="text-gray-900 text-sm font-medium mb-2">Diag. Code4</label>
                    <input name="diagnosiscode4" id="diagnosiscode4" type="text" placeholder="Diagnosis code" value=""
                        aria-required="true" class="form-control block w-full px-3 py-1.5 text-base
                                        font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                        rounded transition ease-in-out m-0 datepicker
                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                </div>
                <div class="form-group mb-1">
                    <label class="text-gray-900 text-sm font-medium mb-2">Diag. Code5</label>
                    <input name="diagnosiscode5" id="diagnosiscode5" type="text" placeholder="Diagnosis code" value=""
                        aria-required="true" class="form-control block w-full px-3 py-1.5 text-base
                                        font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                        rounded transition ease-in-out m-0 datepicker
                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                </div>
                <div class="form-group mb-1">
                    <label class="text-gray-900 text-sm font-medium mb-2">Diag. Code6</label>
                    <input name="diagnosiscode6" id="diagnosiscode6" type="text" placeholder="Diagnosis code" value=""
                        aria-required="true" class="form-control block w-full px-3 py-1.5 text-base
                                        font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                        rounded transition ease-in-out m-0 datepicker
                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                </div>
                <div class="form-group mb-1">
                    <label class="text-gray-900 text-sm font-medium mb-2">Diag. Code7</label>
                    <input name="diagnosiscode7" id="diagnosiscode7" type="text" placeholder="Diagnosis code" value=""
                        aria-required="true" class="form-control block w-full px-3 py-1.5 text-base
                                        font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                        rounded transition ease-in-out m-0 datepicker
                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                </div>
                <div class="form-group mb-1">
                    <label class="text-gray-900 text-sm font-medium mb-2">Diag. Code8</label>
                    <input name="diagnosiscode8" id="diagnosiscode8" type="text" placeholder="Diagnosis code" value=""
                        aria-required="true" class="form-control block w-full px-3 py-1.5 text-base
                                        font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                        rounded transition ease-in-out m-0 datepicker
                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                </div>
            </div>
            <div class="grid grid-cols-5 gap-4 mb-2">
                <div class="form-group mb-1">
                    <label class="text-gray-900 text-sm font-medium mb-2">Modifier1</label>
                    <input name="modifier1" id="modifier1" type="text" placeholder="modifier" value=""
                        aria-required="true" class="form-control block w-full px-3 py-1.5 text-base
                                        font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                        rounded transition ease-in-out m-0 datepicker
                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                </div>
                <div class="form-group mb-1">
                    <label class="text-gray-900 text-sm font-medium mb-2">Modifier2</label>
                    <input name="modifier2" id="modifier2" type="text" placeholder="modifier" value=""
                        aria-required="true" class="form-control block w-full px-3 py-1.5 text-base
                                        font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                        rounded transition ease-in-out m-0 datepicker
                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                </div>
                <div class="form-group mb-1">
                    <label class="text-gray-900 text-sm font-medium mb-2">Modifier3</label>
                    <input name="modifier3" id="modifier3" type="text" placeholder="modifier" value=""
                        aria-required="true" class="form-control block w-full px-3 py-1.5 text-base
                                        font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                        rounded transition ease-in-out m-0 datepicker
                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                </div>
                <div class="form-group mb-1">
                    <label class="text-gray-900 text-sm font-medium mb-2">Modifier4</label>
                    <input name="modifier4" id="modifier4" type="text" placeholder="modifier" value=""
                        aria-required="true" class="form-control block w-full px-3 py-1.5 text-base
                                        font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300
                                        rounded transition ease-in-out m-0 datepicker
                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                </div>
                <div class="form-group mb-1">
                    <button type="submit" onclick="addcptcodes();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-plus-circle mt-6">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="16"></line>
                            <line x1="8" y1="12" x2="16" y2="12"></line>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div id="cptdata">
        <x-table>
            <x-slot name="header">
                <x-table.heading>
                    CPT Code
                </x-table.heading>
                <x-table.heading>Units</x-table.heading>
                <x-table.heading>Diagnosis Codes</x-table.heading>
                <x-table.heading>Modifiers</x-table.heading>
                <x-table.heading></x-table.heading>
            </x-slot>
            <x-slot name="body">

            </x-slot>
        </x-table>
    </div>
</div>
<div class="bg-gray-100 px-4 py-3 text-right">
    <button type="button" class="px-6
                        py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg
                        focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg
                        transition duration-150 ease-in-out"
        onclick="document.getElementById('genmodal').classList.toggle('hidden');">Cancel</button>
    <button type="submit" class="px-6
                        py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded
                        shadow-md hover:bg-blue-700 hover:shadow-lg
                        focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
                        active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out ml-1">Save</button>
</div>
<script type="text/javascript">
function savecptcodes() {

}

function addcptcodes() {
    if ($("#cptcode1").val() != "" && $("#units").val() != "") {
        $("#hdnCPTCodes").val($("#hdnCPTCodes").val() + ";" + $("#cptcode1").val() + "," + $("#units").val() + "|" +
            $("#diagnosiscode1").val() + "," + $("#diagnosiscode2").val() + "," + $("#diagnosiscode3").val() + "," +
            $(
                "#diagnosiscode4").val() +
            "," + $("#diagnosiscode5").val() + "," + $("#diagnosiscode6").val() + "," + $("#diagnosiscode7").val() +
            "," + $("#diagnosiscode8").val() +
            "|" + $("#modifier1").val() + "," + $("#modifier2").val() + "," + $("#modifier3").val() + "," + $(
                "#modifier4").val());

        $.ajax({
            url: '/addcptcodes',
            data: {
                'data': $("#hdnCPTCodes").val()
            },
            method: "POST",
            success: function(data) {
                $("#cptdata table tbody").html(data);
                $("#cptcode1").val("");
                $("#units").val("");
                $("#diagnosiscode1").val("");
                $("#diagnosiscode2").val("");
                $("#diagnosiscode3").val("");
                $("#diagnosiscode4").val("");
                $("#diagnosiscode5").val("");
                $("#diagnosiscode6").val("");
                $("#diagnosiscode7").val("");
                $("#diagnosiscode8").val("");
                $("#modifier1").val("");
                $("#modifier2").val("");
                $("#modifier3").val("");
                $("#modifier4").val("");
            }
        });
    }
}
</script>