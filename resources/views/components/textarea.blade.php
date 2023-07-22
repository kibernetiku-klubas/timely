@props(['disabled' => false])

<textarea rows='4' class = 'block w-full rounded-md border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm' {{ $attributes->merge(['class' => 'form-control']) }}>{{ $slot }}</textarea>
