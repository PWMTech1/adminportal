<x-MainLayout>
    <x-slot name="titlePage">
        Edit Facility
    </x-slot>
    <x-slot name="activePage">
        facility-management
    </x-slot>
    @section('content')
        <div class="flex justify-center">
            <div class="w-full block rounded-lg shadow-lg bg-white">
                <div class="py-3 px-6 border-b border-gray-300 bg-indigo-600 text-white">
                    <h5>Edit Facility</h5>
                    <input type="hidden" value="{{ $facility[0]->Id }}" id="hdnFacilityId">
                </div>
                <form method="POST" action="/forms/mileage" autocomplete="off" class="form-horizontal"
                    enctype="multipart/form-data">
                    @csrf
                    {{ csrf_field() }}
                    @method('post')
                    <div class="p-6">
                        <div class="">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="form-group mb-6">
                                    <x-forms.label>Name</x-forms.label>
                                    <x-forms.input name="name" id="name" placeholder="{{ __('Facility Name') }}"
                                        value="{{ !empty($facility) ? $facility[0]->Name : '' }}" required
                                        aria-required="true"></x-forms.input>
                                </div>
                                <div class="form-group mb-6">
                                    <x-forms.label>Address1</x-forms.label>
                                    <x-forms.input name="address1" id="address1" type="text"
                                        placeholder="{{ __('Address1') }}"
                                        value="{{ !empty($facility) ? $facility[0]->Address1 : '' }}" required
                                        aria-required="true">
                                    </x-forms.input>
                                </div>
                            </div>
                            <div class="grid grid-cols-4 gap-4">
                                <div class="form-group mb-6">
                                    <x-forms.label>Address2</x-forms.label>
                                    <x-forms.input name="address2" id="address2" type="text"
                                        placeholder="{{ __('Address2') }}"
                                        value="{{ !empty($facility) ? $facility[0]->Address2 : '' }}">
                                    </x-forms.input>
                                </div>
                                <div class="form-group mb-6">
                                    <x-forms.label>City</x-forms.label>
                                    <x-forms.input name="city" id="city" type="text" placeholder="{{ __('City') }}"
                                        value="{{ !empty($facility) ? $facility[0]->City : '' }}" required
                                        aria-required="true">
                                    </x-forms.input>
                                </div>
                                <div class="form-group mb-6">
                                    <x-forms.label>State</x-forms.label>
                                    <x-forms.select name="state" id="state" required>
                                        <x-forms.selectoption></x-forms.selectoption>
                                        @foreach ($State as $s)
                                            @if (!empty($facility) && $facility[0]->State == $s->Abbreviation)
                                                <x-forms.selectoption value="{{ $s->Abbreviation }}" selected="true">
                                                    {{ $s->Description }}
                                                </x-forms.selectoption>
                                            @else
                                                <x-forms.selectoption value="{{ $s->Abbreviation }}">
                                                    {{ $s->Description }}
                                                </x-forms.selectoption>
                                            @endif
                                        @endforeach
                                    </x-forms.select>
                                </div>
                                <div class="form-group mb-6">
                                    <x-forms.label>Zipcode</x-forms.label>
                                    <x-forms.input name="zipcode" id="zipcode" type="text"
                                        placeholder="{{ __('Zipcode') }}"
                                        value="{{ !empty($facility) ? $facility[0]->Zipcode5 : '' }}" required
                                        aria-required="true">
                                    </x-forms.input>
                                </div>
                            </div>
                            <div class="grid grid-cols-4 gap-4">
                                <div class="form-group mb-6">
                                    <x-forms.label>Phone</x-forms.label>
                                    <x-forms.input name="phone" id="phone" type="text" placeholder="{{ __('Phone') }}"
                                        value="{{ !empty($facility) ? $facility[0]->Phone : '' }}">
                                    </x-forms.input>
                                </div>
                                <div class="form-group mb-6">
                                    <x-forms.label>Fax</x-forms.label>
                                    <x-forms.input name="fax" id="fax" type="text" placeholder="{{ __('Fax') }}"
                                        value="{{ !empty($facility) ? $facility[0]->Fax : '' }}">
                                    </x-forms.input>
                                </div>
                                <div class="form-group mb-6">
                                    <x-forms.label>Facility Type</x-forms.label>
                                    <x-forms.select name="type" id="type" required>
                                        <x-forms.selectoption></x-forms.selectoption>
                                        @if (!empty($facility) && $facility[0]->FacilityType == 'SNF')
                                            <x-forms.selectoption value="SNF" selected="true">SNF</x-forms.selectoption>
                                        @else
                                            <x-forms.selectoption value="SNF">SNF</x-forms.selectoption>
                                        @endif
                                        @if (!empty($facility) && $facility[0]->FacilityType == 'ALF')
                                            <x-forms.selectoption value="ALF" selected="true">ALF</x-forms.selectoption>
                                        @else
                                            <x-forms.selectoption value="ALF">ALF</x-forms.selectoption>
                                        @endif
                                    </x-forms.select>
                                </div>
                                <div class="form-group mb-6 mt-5">
                                    @if (!empty($facility) && $facility[0]->IsPCC)
                                        <x-forms.checkbox name="ispcc" id="ispcc" checked="checked" disabled="disabled">
                                            IsPCC
                                        </x-forms.checkbox>
                                    @else
                                        <x-forms.checkbox name="ispcc" id="ispcc" disabled="disabled">
                                            IsPCC
                                        </x-forms.checkbox>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="py-3 px-6 border-t border-gray-300 text-gray-600">
                        <a href="/facility/list"
                            class="inline-block px-6 py-2.5 bg-orange-600 text-white font-medium text-xs leading-tight uppercase
                    rounded shadow-md hover:bg-orange-700 hover:shadow-lg focus:bg-orange-500 focus:shadow-lg focus:outline-none
                    focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">{{ __('Back to list') }}</a>
                        <button type="submit"
                            class="inline-block px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase
                            rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-500 focus:shadow-lg focus:outline-none
                            focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">Save
                            Facility</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-2">
            <div class="flex justify-between">
                <span class="text-lg font-bold">Contact List</span>
                <x-forms.anchor href="" class="bg-indigo-500 mb-3">Add New Contact</x-forms.anchor>
            </div>
            <x-table>
                <x-slot name="header">
                    <x-table.heading>Name</x-table.heading>
                    <x-table.heading>Title</x-table.heading>
                    <x-table.heading>Email</x-table.heading>
                    <x-table.heading>Phone</x-table.heading>
                    <x-table.heading>Fax</x-table.heading>
                    <x-table.heading>Actions</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @foreach ($facility as $f)
                        @foreach ($f->contacts as $c)
                            <tr>
                                <x-table.row>
                                    {{ $c->firstname . ' ' . $c->middlename . ' ' . $c->lastname }}
                                </x-table.row>
                                <x-table.row>
                                    {{ $c->Title }}
                                </x-table.row>
                                <x-table.row>
                                    {{ $c->email }}
                                </x-table.row>
                                <x-table.row>
                                    {{ $c->Phone }}
                                </x-table.row>
                                <x-table.row>
                                    {{ $c->Fax }}
                                </x-table.row>
                                <x-table.row>
                                    <div x-data="{}" class="inline">
                                        <button type="button" class="inline-block"
                                            @click="$dispatch('modal', {clinicianid: {{ $c->id }}, open: true, Type: 'user', Title: 'Edit Contact'})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"
                                                style="color: green;">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <button type="button" class="inline-block">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-trash-2" style="color: red;">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path
                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                            </path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </button>
                                </x-table.row>
                            </tr>
                        @endforeach
                    @endforeach
                </x-slot>
            </x-table>
        </div>
        <div class="mt-2">
            @include('PartialView.Modal')
            <div class="flex justify-between">
                <span class="text-lg font-bold">Clinician List</span>
                <x-forms.anchor href="" class="bg-indigo-500 mb-3">Attach Clinician</x-forms.anchor>
            </div>
            <x-table>
                <x-slot name="header">
                    <x-table.heading>Name</x-table.heading>
                    <x-table.heading>Email</x-table.heading>
                    <x-table.heading>Phone</x-table.heading>
                    <x-table.heading>Fax</x-table.heading>
                    <x-table.heading>NPI</x-table.heading>
                    <x-table.heading>Clinician Type</x-table.heading>
                    <x-table.heading>Edit</x-table.heading>
                </x-slot>
                <x-slot name="body">
                    @foreach ($facility as $f)
                        @foreach ($f->clinicians as $c)
                            <tr>
                                <x-table.row>
                                    {{ $c->firstname . ' ' . $c->middlename . ' ' . $c->lastname }}
                                </x-table.row>
                                <x-table.row>
                                    {{ $c->Title }}
                                </x-table.row>
                                <x-table.row>
                                    {{ $c->Phone }}
                                </x-table.row>
                                <x-table.row>
                                    {{ $c->Fax }}
                                </x-table.row>
                                <x-table.row>
                                    {{ $c->NPI }}
                                    <a href="https://npiregistry.cms.hhs.gov/" class="inline-block" title="Search NPI"
                                        target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="feather feather-search" style="color: green;">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                        </svg>
                                    </a>
                                </x-table.row>
                                <x-table.row>
                                    {{ $c->pivot->ClinicianType }}
                                </x-table.row>
                                <x-table.row>
                                    <div x-data="{}">
                                        <button
                                            @click="$dispatch('modal',{clinicianid: {{ $c->id }}, open: true,
                                                                                                                                                                                                                                            Type: 'clinician', Title: 'Edit Clinician'})"
                                            type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"
                                                style="color: green;">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </x-table.row>
                            </tr>
                        @endforeach
                    @endforeach
                </x-slot>
            </x-table>
        </div>
        <script type="text/javascript">
            function clinicianSearch() {
                return {
                    IsLoading: false,
                    open: false,
                    clinicianid: 0,
                    url: "",
                    clinician: null,
                    Type: "",
                    Title: "",
                    fetchClinician() {
                        this.IsLoading = true;
                        switch (this.Type) {
                            case "clinician":
                                url = `/getcliniciandetails/${this.clinicianid}`;
                                break;
                            case "user":
                                url = `/getcontactdetails/${this.clinicianid}`;
                                break;
                        }
                        fetch(url)
                            .then((response) => response.json())
                            .then((html) => {
                                this.IsLoading = false;
                                this.clinician = html;
                            })
                            .catch((err) => console.log("ERROR", err));
                    },
                    closeClinician() {
                        this.open = false;
                        this.clinicianid = 0;
                        this.url = "";
                        this.clinician = null;
                        this.Type = "";
                        this.Title = "";
                    }
                };
            }
        </script>
    @endsection
</x-MainLayout>
