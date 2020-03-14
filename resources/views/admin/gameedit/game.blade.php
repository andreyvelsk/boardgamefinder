@extends ('layouts.admin')

@section('header')
    @include('admin.header')
@endsection

@if(isset($data))
@section('aditional')
    @if(isset($data['idbgg']))
        <div>
            {!!Form::open(['url'=>route('parseBgg', array('game'=>$data['id'])), 'class'=>'form-horizontal', 'method' => 'GET', 'enctype'=>'multipart/form-data']) !!}
                <input type="hidden" name="refresh" value="1">
                {!! Form::button('get BGG info', ['type'=>'submit', 'class'=>'btn btn-primary']) !!}
            {!!Form::close() !!}
        </div>
    @endif
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
        {!!Form::open(['url'=>route('gameEdit', array('game'=>$data['id'])), 'class'=>'form-horizontal', 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}
            @include('admin.gameedit.primary')
        {!!Form::close() !!}
        </div>
        <div class="col-md-6">
            @include('admin.gameedit.secondary')
        </div>
    </div>
@endsection
@endif