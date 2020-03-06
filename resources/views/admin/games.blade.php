@extends ('layouts.admin')

@section('header')
    @include('admin.header')
@endsection

@section('aditional')
    @include('admin.aditional')
@endsection

@section('content')
    @if(isset($games) && is_object($games))
        {{$games->links()}}
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">№</th>
                    <th scope="col">id</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($games as $k=>$game)
                    <tr>
                        <td>
                            {!! $k + 1 !!}
                        </td>
                        <td>
                            {!! $game->id !!}
                        </td>
                        <td>
                            {!! $game->title !!}
                        </td>
                        <td>
                            <div class="row justify-content-around">
                                <a class="btn btn-primary" href="{{route('gameEdit', ['game'=>$game->id])}}" role="button">edit</a>
                                {!!Form::open(['url'=>route('gameDelete', array('game'=>$game)), 'class'=>'form-horizontal', 'method' => 'DELETE', 'enctype'=>'multipart/form-data']) !!}
                                {!! Form::button('X', ['type'=>'submit', 'class'=>'btn btn-danger']) !!}
                                
                                {!!Form::close() !!}
                            </div>
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