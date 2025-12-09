@props(['nomError'])
@error($nomError)
<p class="mt-1 text-red-500 text-sm italic">*** {{$message}}</p>
@enderror