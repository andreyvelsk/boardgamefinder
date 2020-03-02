<div class="row">
    <div class="col-md-2">
        <a class="btn btn-primary" href="{{route('gamesList')}}" role="button">Добавить</a>
    </div>
    <div class="col-md-10">
        {!!Form::open(['url'=>route('gamesList'), 'class'=>'form-horizontal', 'method' => 'GET', 'enctype'=>'multipart/form-data']) !!}
            <div class="input-group mb-3">
                {!! Form::text('q', $q ?? '', ['class'=>'form-control']) !!}
                <div class="input-group-append">
                    {!! Form::button('search', ['type'=>'submit', 'class'=>'btn btn-success']) !!}
                </div>
            </div>
        {!!Form::close() !!}
    </div>
</div>
<div>
Результатов: <span>{{$games->total()}}</span>
</div>