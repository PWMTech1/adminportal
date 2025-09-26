<x-MainLayout>
    <x-slot name="titlePage">
        User Management
    </x-slot>
    <x-slot name="activePage">
        user-management
    </x-slot>
    @section('content')
    <div class="d-flex">
        <div class="mx-auto">
            <form method="POST" action="/user">
                @csrf()
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            for="grid-first-name">
                            Roles
                        </label>
                        <select
                            class="text-xs block appearance-none bg-gray-50 border border-gray-300 text-gray-900 py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            name="role">
                            <option></option>
                            @foreach ($roles as $r)
                            <option value="{{ $r->Id }}">{{ $r->Description }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full md:w-1/6 px-3 mb-6 md:mb-0">
                        <x-forms.button type="submit" class="bg-red-500 mt-5">
                            Filter Results</x-forms.button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <x-forms.anchor href="/user/create"
        class="bg-indigo-600 hover:bg-indigo-700 focus:bg-indigo-500 active:bg-indigo-800">Add User</x-forms.anchor>
    <x-table class="mt-4">
        <x-slot name="header">
            <x-table.heading>First Name</x-table.heading>
            <x-table.heading>Last Name</x-table.heading>
            <x-table.heading>Email</x-table.heading>
            <x-table.heading>Creation Date</x-table.heading>
            <x-table.heading>Role</x-table.heading>
            <x-table.heading>Last Origin</x-table.heading>
            <x-table.heading>Actions</x-table.heading>
        </x-slot>
        <x-slot name="body">
            @foreach ($users as $user)
            <tr>
                <x-table.row>{{ $user->firstname }}</x-table.row>
                <x-table.row>{{ $user->lastname }}</x-table.row>
                <x-table.row>{{ $user->email }}</x-table.row>
                <x-table.row>{{ $user->created_at->format('Y-m-d') }}</x-table.row>
                <x-table.row>{{ $user->roles->Description }}</x-table.row>
                <x-table.row>{{ $user->lastlogindate == null ? '' : $user->lastlogindate }}</x-table.row>
                <x-table.row>
                    @if ($user->id != auth()->id())
                    <x-form action="{{ route('user.destroy', $user) }}" method="post">
                        <x-slot name="elements">
                            @csrf
                            @method('delete')
                            <x-forms.anchor href="{{ route('user.edit', $user) }}" class="bg-green-500">
                                Edit
                            </x-forms.anchor>
                            <x-forms.button type="button" class="bg-red-500"
                                onclick="confirm('Are you sure you want to delete this user?') ? this.parentElement.submit() : ''">
                                Delete</x-forms.button>
                        </x-slot>
                    </x-form>
                    @else
                    <x-forms.anchor href="{{ route('profile.edit') }}" class="bg-green-500">Edit
                    </x-forms.anchor>
                    @endif
                </x-table.row>
            </tr>
            @endforeach
        </x-slot>
    </x-table>
    <div class="d-flex py-3">
        <div class="mx-auto">
            {{ $users->links() }}
        </div>
    </div>
    @endsection
</x-MainLayout>