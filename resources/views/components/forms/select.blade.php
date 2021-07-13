@props(['disabled' => false])
<select {!! $attributes->merge(['class' => 'form-control mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm']) !!}>
    {{$slot}}
</select>
