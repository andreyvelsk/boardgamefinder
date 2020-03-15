@extends ('layouts.admin')

@section('header')
    @include('admin.header')
@endsection

@if(isset($data))
@section('aditional')
        <div class="d-flex justify-content-between">
            <div>
                {!!Form::open(['url'=>route('parseGameBgg', array('game'=>$data['id'])), 'class'=>'form-horizontal', 'method' => 'GET', 'enctype'=>'multipart/form-data']) !!}
                    <input type="hidden" name="refresh" value="1">
                    @if(isset($data['idbgg']))
                        {!! Form::button('get BGG info', ['type'=>'submit', 'class'=>'btn btn-primary']) !!}
                    @else
                    @endif
                {!!Form::close() !!}
            </div>
            <div>
                {{$data['updated_at']}}
            </div>
        </div>
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