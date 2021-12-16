@if (session()->has('error'))
    <x-alert-error>
        {{ session()->get('error') }}
    </x-alert-error>
@endif

@if (session()->has('success'))
    <x-alert-success>
        {{ session()->get('success') }}
    </x-alert-success>
@endif

@if ($errors->any())
<x-alert-error>
    <p>Validation error:</p>
    <ul class="list-decimal ml-4">
        @foreach ($errors->all() as $error)
        <li class="mt-1">{{ $error }}</li>
        @endforeach
    </ul>
</x-alert-error>
@endif