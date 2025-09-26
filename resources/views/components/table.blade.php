<table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-gray-200 border border-gray-300 '.$attributes->get('class')]) }}>
  <thead class="bg-gray-100">
    <tr>
        {{$header}}
    </tr>    
  </thead>
  <tbody class="bg-white divide-y divide-gray-200">
    {{$body}}
  </tbody>
</table>