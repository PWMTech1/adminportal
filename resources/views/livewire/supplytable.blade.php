<table class="min-w-full divide-y divide-gray-200 border border-gray-300 ">
    <tbody class="bg-white divide-y divide-gray-200">
        @if (!empty($supplies))
            @foreach ($supplies as $s => $details)
                <tr>
                    <td class="whitespace-nowrap text-xs">
                        {{ $details['Description'] }}
                    </td>
                    <td class="whitespace-nowrap text-xs">
                        {{ $details['Unit'] }}
                    </td>
                    <td class="items-center">
                        <input
                            class="appearance-none block bg-grey-lighter text-xs text-grey-darker border border-red rounded py-1 px-2 mb-1"
                            type="text" name="address1" value="{{ $details['Qty'] }}">
                    </td>
                    <td>
                        <button type="button"
                            class="bg-red-500 hover:bg-red-700' text-xs text-white text-center py-1 px-2 rounded mt-1">Delete</button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
