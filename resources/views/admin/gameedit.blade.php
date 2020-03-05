@extends ('layouts.admin')

@section('header')
    @include('admin.header')
@endsection

@section('content')
    @if(isset($data))
        {!!Form::open(['url'=>route('gameEdit', array('game'=>$data['id'])), 'class'=>'form-horizontal', 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}
            <div class="row">
                <div class="col-md-6">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="form-group">
                                {!!Form::label('title', 'Название', ['class'=>'control-label'])!!}
                                <div>
                                    {!! Form::text('title', $data['title'], ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                                <div class="form-check">
                                    {!! Form::checkbox('isexpansion', $data['isexpansion'], $data['isexpansion'], ['class'=>'form-check-input'])!!}
                                    {!!Form::label('isexpansion', 'Дополнение', ['class'=>'form-check-label'])!!}
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!!Form::label('idtesera', 'idtesera', ['class'=>'control-label'])!!}
                                <div>
                                    {!! Form::text('idtesera', $data['idtesera'], ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!!Form::label('idbgg', 'idbgg', ['class'=>'control-label'])!!}
                                <div>
                                    {!! Form::text('idbgg', $data['idbgg'], ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!!Form::label('yearpublished', 'yearpublished', ['class'=>'control-label'])!!}
                                <div>
                                    {!! Form::text('yearpublished', $data['yearpublished'], ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!!Form::label('bgggeekrating', 'bgggeekrating', ['class'=>'control-label'])!!}
                                <div>
                                    {!! Form::text('bgggeekrating', $data['bgggeekrating'], ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!!Form::label('bggavgrating', 'bggavgrating', ['class'=>'control-label'])!!}
                                <div>
                                    {!! Form::text('bggavgrating', $data['bggavgrating'], ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!!Form::label('bggnumvotes', 'bggnumvotes', ['class'=>'control-label'])!!}
                                <div>
                                    {!! Form::text('bggnumvotes', $data['bggnumvotes'], ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                    {!!Form::label('minplayers', 'minplayers', ['class'=>'control-label'])!!}
                                    <div>
                                        {!! Form::text('minplayers', $data['minplayers'], ['class'=>'form-control']) !!}
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                    {!!Form::label('maxplayers', 'maxplayers', ['class'=>'control-label'])!!}
                                    <div>
                                        {!! Form::text('maxplayers', $data['maxplayers'], ['class'=>'form-control']) !!}
                                    </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                    {!!Form::label('suggestedplayers', 'suggestedplayers', ['class'=>'control-label'])!!}
                                    <div>
                                        {!! Form::text('suggestedplayers', $data['maxplayers'], ['class'=>'form-control']) !!}
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!!Form::label('minage', 'minage', ['class'=>'control-label'])!!}
                                <div>
                                    {!! Form::text('minage', $data['minage'], ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!!Form::label('suggestedage', 'suggestedage', ['class'=>'control-label'])!!}
                                <div>
                                    {!! Form::text('suggestedage', $data['suggestedage'], ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!!Form::label('gameweight', 'gameweight', ['class'=>'control-label'])!!}
                                <div>
                                    {!! Form::text('gameweight', $data['gameweight'], ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!!Form::label('minplaytime', 'minplaytime', ['class'=>'control-label'])!!}
                                <div>
                                    {!! Form::text('minplaytime', $data['minplaytime'], ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!!Form::label('maxplaytime', 'maxplaytime', ['class'=>'control-label'])!!}
                                <div>
                                    {!! Form::text('maxplaytime', $data['maxplaytime'], ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!!Form::label('description', 'description', ['class'=>'control-label'])!!}
                                <div>
                                    {!! Form::textarea('description', $data['description'], ['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            {!! Form::button('save', ['type'=>'submit', 'class'=>'btn btn-primary']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    additional info
                </div>
            </div>
        {!!Form::close() !!}
    @endif
@endsection