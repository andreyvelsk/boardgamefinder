@extends ('layouts.admin')

@section('header')
    @include('admin.header')
@endsection

@section('content')
    @if(isset($data))
        {!!Form::open(['url'=>route('gameEdit', array('game'=>$data['id'])), 'class'=>'form-horizontal', 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}
            <div class="row">
                <div class="col-md-6">
                    @include('admin.gameedit.primary')
                </div>
                <div class="col-md-6">
                    @include('admin.gameedit.secondary')
                </div>
            </div>
        {!!Form::close() !!}
    @endif
@endsection