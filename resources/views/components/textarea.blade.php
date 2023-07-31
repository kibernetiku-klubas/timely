@props(['disabled' => false])

<textarea rows='4' class = 'block w-full rounded-lg border border-gray-300 focus:border-purple-500 focus:purple-500 text-black' {{ $attributes->merge(['class' => 'form-control']) }}>{{ $slot }}</textarea>
