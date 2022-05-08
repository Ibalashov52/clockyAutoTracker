<x-body>
    <div class="container is-max-desktop mt-4">
        <a class="button is-dark is-fullwidth" href="{{route('time-tracker.sync')}}">Синхронизировать шиты</a>
        @if(!empty($data))
            <x-base.table :data="$data">
            </x-base.table>
        @endif
    </div>
</x-body>
