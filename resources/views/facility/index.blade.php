<x-MainLayout>
    <x-slot name="titlePage">
        Facility Management
    </x-slot>
    <x-slot name="activePage">
        facility-management
    </x-slot>
    @section('content')
        <h3 class="text-lg font-bold mb-3">Facility List</h3>
        <x-forms.anchor class="bg-orange-500 mb-2">Add New</x-forms.anchor>
        <x-table>
            <x-slot name="header">
                <x-table.heading>Name</x-table.heading>
                <x-table.heading>Phone</x-table.heading>
                <x-table.heading>Fax</x-table.heading>
                <x-table.heading>Is PCC?</x-table.heading>
            </x-slot>
            <x-slot name="body">
                @foreach ($paginator as $facility)
                    <tr>
                        <x-table.row>
                            <a href="/facility/edit/{{ $facility->Id }}" class="text-sm font-bold text-blue-500">
                                {{ $facility->Name }}
                            </a>
                            <p>
                                {{ $facility->Address1 }}
                                {{ $facility->City . ', ' . $facility->State . ' ' . $facility->Zipcode5 }}
                            </p>
                        </x-table.row>
                        <x-table.row>
                            {{ $facility->Phone }}
                        </x-table.row>
                        <x-table.row>
                            {{ $facility->Fax }}
                        </x-table.row>
                        <x-table.row>
                            @if ($facility->IsPCC)
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
        {{ $paginator->links() }}
    @endsection
</x-MainLayout>
