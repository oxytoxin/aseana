@props(['text'])
<button {{ $attributes->merge(['class' => 'p-2 text-white rounded hover:bg-opacity-75 hover:text-gray-700 focus:outline-none']) }}>{{ $text }}</button>
