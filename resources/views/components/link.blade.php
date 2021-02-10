@props(['text'])
<a {{ $attributes->merge(['class' => 'p-2 whitespace-nowrap text-white rounded hover:bg-opacity-75 hover:text-gray-700 focus:outline-none']) }}>{{ $text }}</a>
