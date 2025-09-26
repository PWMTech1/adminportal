<div class="px-1 pt-1 mb-4 flex flex-col my-2">
    <div class="-mx-3 md:flex mb-3">
        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
            <x-forms.label>First Name</x-forms.label>
            <x-forms.input readonly value="{{ $user[0]->firstname }}"></x-forms.input>
        </div>
        <div class="md:w-1/2 px-3">
            <x-forms.label>Last Name</x-forms.label>
            <x-forms.input readonly value="{{ $user[0]->lastname }}"></x-forms.input>
        </div>
    </div>
    <div class="-mx-3 md:flex mb-3">
        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
            <x-forms.label>NPI</x-forms.label>
            <x-forms.input value="{{ $user[0]->NPI }}"></x-forms.input>
        </div>
        <div class="md:w-1/2 px-3">
            <x-forms.label>Email</x-forms.label>
            <x-forms.input readonly value="{{ $user[0]->email }}"></x-forms.input>
        </div>
    </div>
    <div class="-mx-3 md:flex mb-3">
        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
            <x-forms.label>Phone</x-forms.label>
            <x-forms.input value="{{ $user[0]->Phone }}"></x-forms.input>
        </div>
        <div class="md:w-1/2 px-3">
            <x-forms.label>Fax</x-forms.label>
            <x-forms.input readonly value="{{ $user[0]->Fax }}"></x-forms.input>
        </div>
    </div>
    <div class="-mx-3 md:flex mb-3">
        <div class="md:w-1/2 px-3 mb-6 md:mb-0">
            <x-forms.label>Type</x-forms.label>
            <x-forms.select>
                <x-forms.selectoption></x-forms.selectoption>
                <x-forms.selectoption value="Primary">Primary</x-forms.selectoption>
                <x-forms.selectoption value="Secondary">Secondary</x-forms.selectoption>
            </x-forms.select>
        </div>
    </div>
</div>
