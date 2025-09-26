<?php
use App\Http\Controllers\HomeController;
use App\Roles;
$permissions = HomeController::getAllPermissionsPerUser();

?>
<x-MainLayout>
    <x-slot name="titlePage">
        Clinician Compensation
    </x-slot>
    <x-slot name="activePage">
        compensation
    </x-slot>
    @section('content')
    <div class="fixed z-10 overflow-y-auto top-0 w-full left-0 hidden" id="modal">
        <div class="flex items-center justify-center min-height-100vh pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="inline-block align-center bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                role="dialog" aria-modal="true" aria-labelledby="modal-headline" id="divFileUpload">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <table class="min-w-full divide-y divide-gray-200 border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th>Physician</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="tbPhysician" class="bg-white divide-y divide-gray-200">

                        </tbody>
                    </table>
                </div>
                <div class="w-full bg-gray-200 mb-2">
                    <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none progressbar"
                        style="width: 0%;">
                    </div>
                </div>
                <div class="bg-gray-100 px-4 py-3 text-right">
                    <button type="button" class="px-6
                        py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg
                        focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg
                        transition duration-150 ease-in-out" onclick="toggleModal()">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex">
        <div class="mx-auto">
            <form method="POST" action="/ffs/compensation">
                @csrf()
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            Pay Period
                        </label>
                        <select
                            class="text-xs block appearance-none bg-gray-50 border border-gray-300 text-gray-900 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="period">
                            @foreach ($allmonths as $m)
                            @if ($m->FIRSTDAY . '|' . $m->LASTDAY == $period)
                            <option value="{{ $m->FIRSTDAY . '|' . $m->LASTDAY }}" selected="selected">
                                {{ $m->MonthYear }}
                            </option>
                            @else
                            <option value="{{ $m->FIRSTDAY . '|' . $m->LASTDAY }}">{{ $m->MonthYear }}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                        <button type="submit"
                            class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight
                                uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-500 focus:shadow-lg
                                focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out mt-5">Filter
                            Results</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <button class="inline-block px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight
        uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-500 focus:shadow-lg
        focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out mb-2"
        type="button" id="btnEmail" data-Email="true">Email</button>
    <button class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight
        uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg
        focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
        type="button" id="btnLock" data-Email="false">Lock</button>
    @if ($permissions->AllowAll)
    <a href="/entitylist"
        class="inline-block px-6 py-2.5 bg-indigo-600 text-white font-medium text-xs leading-tight
        uppercase rounded shadow-md hover:bg-indigo-700 hover:shadow-lg focus:bg-indigo-500 focus:shadow-lg
        focus:outline-none focus:ring-0 active:bg-indigo-800 active:shadow-lg transition duration-150 ease-in-out">Entities</a>
    <a href="/codelist"
        class="inline-block px-6 py-2.5 bg-indigo-600 text-white font-medium text-xs leading-tight
        uppercase rounded shadow-md hover:bg-indigo-700 hover:shadow-lg focus:bg-indigo-500 focus:shadow-lg
        focus:outline-none focus:ring-0 active:bg-indigo-800 active:shadow-lg transition duration-150 ease-in-out">Codes</a>
    @endif
    <x-table class="">
        <x-slot name="header">
            <x-table.heading>
                <x-checkbox id="chkHeader"></x-checkbox>
            </x-table.heading>
            <x-table.heading>Clinician</x-table.heading>
            <x-table.heading>Encounters</x-table.heading>
            <x-table.heading>RPE</x-table.heading>
            <x-table.heading>Revenue</x-table.heading>
            <x-table.heading>Adjustments</x-table.heading>
            <x-table.heading>Compensation</x-table.heading>
            <x-table.heading>Locked</x-table.heading>
            <x-table.heading>Processed On</x-table.heading>
        </x-slot>
        <x-slot name="body">
            @foreach ($ffs as $f)
            <tr>
                <x-table.row>
                    <input type="checkbox" class="PhysicianId" data-id="{{$f->user_id}}" data-name="{{$f->Physician}}">
                </x-table.row>
                <x-table.row>{{ $f->Physician }}</x-table.row>
                <x-table.row class="text-right">{{ $f->Count }}</x-table.row>
                <x-table.row class="text-right">
                    ${{ number_format($f->Clinician_FFS_Owed / $f->Count, 2) }}
                </x-table.row>
                <x-table.row class="text-right">
                    <a href="javascript:;"
                        onclick="window.open('{{route("RevenueDetails", ['id' => $f->user_id, 'fromdate' => $f->FromDate, 'todate' => $f->ToDate])}}', '', 'width=1200,height=800')"
                        style="color: #0000F0; text-decoration: none;">
                        ${{ number_format($f->Clinician_FFS_Owed, 2) }}
                    </a>
                </x-table.row>
                <x-table.row class="text-right">
                    ${{ number_format($f->Adjustment, 2) }}
                </x-table.row>
                <x-table.row class="text-right">
                    <a href="{{ route('CompensationDocument', ['id' => $f->user_id, 'fromdate' => $f->FromDate, 'todate' => $f->ToDate]) }}"
                        target="_blank" style="color: #0000F0; text-decoration: none;">
                        ${{ number_format($f->Adjustment + $f->Clinician_FFS_Owed, 2) }}
                    </a>
                </x-table.row>
                <x-table.row></x-table.row>
                <x-table.row class="text-right">
                    {{ $f->ProcessedOn }}
                </x-table.row>
            </tr>
            @endforeach
        </x-slot>
    </x-table>
    @endsection
</x-MainLayout>
<script type="text/javascript">
$(document).on("change", "#chkHeader", function() {
    $("input:checkbox").not(this).prop('checked', this
        .checked);
});

$(document).on("click", "#btnEmail, #btnLock", function() {
    var cnt = $(".PhysicianId:checked").length;
    var isEmail = $(this).attr("data-Email") == "true";

    if (cnt == 0) {
        alert("Please select atleast one physician to " + (isEmail ? "send email" : " Lock"));
        return false;
    }
    toggleModal();
    $("#tbPhysician").html("");

    $(".PhysicianId:checked").each(function(item, val) {
        var html = "<tr><td>" + $(val).attr("data-name") + "</td>";
        html += "<td data-id='" + $(val).attr("data-id") + "'>";
        html +=
            "<svg class=\"animate-spin -ml-1 mr-3 h-5 w-5 text-blue\" xmlns=\"http://www.w3.org/2000/svg\"";
        html +=
            "fill=\"none\" viewBox=\"0 0 24 24\"><circle class=\"opacity-25\" cx=\"12\" cy=\"12\" r=\"10\" stroke=\"currentColor\"";
        html += "stroke-width=\"4\"></circle><path class=\"opacity-75\" fill=\"currentColor\"";
        html +=
            "d=\"M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z\"></path></svg></td></tr>";
        $("#tbPhysician").append(html);
    });
    var sel = 0;
    $(".progressbar").html("");
    $(".progressbar").css("width", "0%");
    $(".PhysicianId").each(function(item, val) {
        if ($(val).is(":checked")) {
            $.ajax({
                url: '/sendemails',
                type: "POST",
                data: {
                    'data': $(val).attr("data-id"),
                    'fromdate': $("select[name='period']").val().split("|")[0],
                    'todate': $("select[name='period']").val().split("|")[1],
                    "IsEmail": isEmail
                },
                success: function(response) {
                    sel++;
                    $("#tbPhysician").find("td[data-id=" + response.Id + "]").html((
                        isEmail ? "Sent" : "Locked"));

                    $(".progressbar").html(parseInt((sel / cnt), 2) * 100 + "%");
                    $(".progressbar").css("width", (sel / cnt) * 100 + "%");
                }
            });
        }
    });
});

function toggleModal() {
    document.getElementById('modal').classList.toggle('hidden');
}
</script>