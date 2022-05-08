<table class="table table is-striped table is-fullwidth">
    <thead>
    <tr>
        <th>Номер задачи</th>
        <th>Описание</th>
        <th>Время</th>
        <th>Теги</th>
        <th>Синхронизировать</th>
    </tr>
    </thead>
    <tbody>
    @if ($attributes['data'])
        @foreach($attributes['data'] as $item)
            <tr>
                <form action="{{route('time-tracker.track', ['entrie' => $item['id']])}}" method="POST">
                    @csrf
                    <td>{{$item['id']}}</td>
                    <td>{{$item['description']}}</td>
                    <td>{{$item['value']}}</td>
                    <td>
                        @foreach($item['tags'] as $tag)
                            <span class="tag is-dark">
                                {{$tag['name']}}
                            </span>
                        @endforeach
                    </td>
                    <td>
                        @if($item['is_sync'])
                            <button class="button is-success is-fullwidth" disabled >
                        @else
                            <button class="button is-dark is-fullwidth">
                        @endif
                        <span class="icon">
                            @if($item['is_sync'])
                                <ion-icon name="checkmark-outline"></ion-icon>
                            @else
                                <ion-icon name="sync-outline"></ion-icon>
                            @endif
                        </span>
                        </button>
                    </td>
                </form>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
