@props(['contacts', 'label'])

<div class="flex items-center">
    <span class="text-black mr-2">{{ __(':label:', ['label' => $label]) }}</span>
    <div class="inline-flex">
        @foreach($contacts as $email => $name)
            <div class="inline-flex items-center mr-2 h-5 text-sm px-1 rounded bg-gray-200 hover:bg-blue-500 hover:text-blue-50">
                @if($name)
                    <span class="font-semibold mr-1">{{ __(':name', ['name' => $name]) }}</span>
                @endif

                <span class="text-xs">{{ __('<:email>', ['email' => $email]) }}</span>
            </div>
        @endforeach
    </div>
</div>