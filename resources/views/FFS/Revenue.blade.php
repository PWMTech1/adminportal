<div class="py-2 px-3">
    <a class="bg-blue-500 hover:bg-blue-700' text-xs text-white text-center py-2 px-3 rounded mb-2"
        onclick="window.open('{{route("RevenueDetailsPDF", ['id' => $id, 'fromdate' => $fromdate, 'todate' => $todate])}}', '', 'width=1200,height=800')"
        href="javascript:;">Export to PDF</a>
</div>
<x-EmptyLayout>
    @section('content')
    <x-table class="">
        <x-slot name="header">
            <x-table.heading>Patient Name</x-table.heading>
            <x-table.heading>MRNumber</x-table.heading>
            <x-table.heading>DOS</x-table.heading>
            <x-table.heading>FacilityName</x-table.heading>
            <x-table.heading>CPT</x-table.heading>
            <x-table.heading>Modifier</x-table.heading>
            <x-table.heading>Amount</x-table.heading>
        </x-slot>
        <x-slot name="body">
            @foreach($ffs as $f)
            <tr>
                <x-table.row>
                    {{$f->Patient_Name}}
                </x-table.row>
                <x-table.row>
                    {{$f->MRnumber}}
                </x-table.row>
                <x-table.row>
                    {{$f->DOS}}
                </x-table.row>
                <x-table.row>
                    {{$f->Facility}}
                </x-table.row>
                <x-table.row>
                    {{$f->CPT}}
                </x-table.row>
                <x-table.row>
                    {{$f->MOD}}
                </x-table.row>
                <x-table.row>
                    ${{number_format($f->Clinician_FFS_Owed, 2)}}
                </x-table.row>
            </tr>
            @endforeach
        </x-slot>
    </x-table>
    @endsection
</x-EmptyLayout>