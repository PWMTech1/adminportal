<x-MainLayout>
    <x-slot name="titlePage">
        Patient List
    </x-slot>
    <x-slot name="activePage">
        PatientList
    </x-slot>
    @section('content')
        <input type="hidden" id="csrf-token" value="{{ csrf_token() }}" />
        <form method="GET" action="/visitsandpatients">
            <div class="d-flex">
                <div class="mx-auto">
                    <div class="flex flex-wrap -mx-3 mb-2">
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-first-name">
                                Facility
                            </label>
                            <select
                                class="text-xs block appearance-none bg-gray-50 border border-gray-300 text-gray-900 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="facility">
                                <option value="">Select Facility</option>
                                @foreach ($facilities as $facility)
                                    @if (empty($facilityname))
                                        <option value="{{ $facility->Name }}">{{ $facility->Name }}</option>
                                    @else
                                        @if ($facilityname == $facility->Name)
                                            <option value="{{ $facility->Name }}" selected="selected">
                                                {{ $facility->Name }}
                                            </option>
                                        @else
                                            <option value="{{ $facility->Name }}">{{ $facility->Name }}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-first-name">
                                Patient Name
                            </label>
                            <input type="text" name='patientname'
                                class="text-xs block appearance-none bg-gray-50 border border-gray-300 text-gray-900 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 w-full"
                                placeholder="Patient Name" value="{{ $patientname }}">
                        </div>
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                for="grid-first-name">
                                Entity
                            </label>
                            <select
                                class="text-xs block appearance-none bg-gray-50 border border-gray-300 text-gray-900 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                name="entities" id="entities">
                                <option value="-1"></option>
                                @foreach ($entity as $e)
                                    @if ($entities == $e->index && Str::length($entities) > 0)
                                        <option value="{{ $e->index }}" selected="selected">
                                            {{ $e->Entity . ' - ' . $e->State }}</option>
                                    @else
                                        <option value="{{ $e->index }}">
                                            {{ $e->Entity . ' - ' . $e->State }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                        <x-forms.button type="submit" class="bg-red-500">Filter Results</x-forms.button>

                    </div>
                </div>
            </div>
        </form>
        <x-table class="">
            <x-slot name="header">
                <x-table.heading>PatientID</x-table.heading>
                <x-table.heading>Name</x-table.heading>
                <x-table.heading>Facility</x-table.heading>
                <x-table.heading>SSN</x-table.heading>
                <x-table.heading>IsPCC</x-table.heading>
            </x-slot>
            <x-slot name="body">
                @foreach ($paginator as $patient)
                    <tr>
                        <x-table.row>
                            <span class="inline-block">
                                {{ $patient['MRNumber'] }}
                            </span>
                        </x-table.row>
                        <x-table.row>
                            {{ $patient['FirstName'] . ' ' . $patient['MiddleName'] . ' ' . $patient['LastName'] }}
                        </x-table.row>
                        <x-table.row>{{ $patient['FacilityName'] }}</x-table.row>
                        <x-table.row>{{ $patient['SSN'] }}</x-table.row>
                        <x-table.row>
                            @if ($patient['IsPCC'])
                                <svg viewBox="0 0 24 24" width="15" height="15" stroke="currentColor" stroke-width="2"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"
                                    style="color: green;">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            @endif
                        </x-table.row>
                    </tr>
                @endforeach
            </x-slot>
        </x-table>
        <span class="pt-2">
            {{ $paginator->links() }}
        </span>
        <div class="d-flex py-3">
            <div class="mx-auto">

            </div>
        </div>
    @endsection
</x-MainLayout>
