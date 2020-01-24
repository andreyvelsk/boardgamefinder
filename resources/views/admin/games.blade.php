@extends ('layouts.admin')

@section('header')
    @include('admin.header')
@endsection

@section('aditional')
    @include('admin.aditional')
@endsection

@section('content')
    @if(isset($games) && is_object($games))
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($games as $k=>$game)
                    <tr>
                        <td>
                            {!! $game->id !!}
                        </td>
                        <td>
                            {!! $game->title !!}
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{route('gameEdit', ['game'=>$game->id])}}" role="button">edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$games->links()}}
    @else
        <div>
            no games
        </div>
    @endif
@endsection