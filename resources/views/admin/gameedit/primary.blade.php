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
                <input type="hidden" name="isexpansion" value="0">
                {!! Form::checkbox('isexpansion', 1, $data['isexpansion'], ['class'=>'form-check-input'])!!}
                {!!Form::label('isexpansion', 'Дополнение', ['class'=>'form-check-label'])!!}
            </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!!Form::label('idtesera', 'idtesera', ['class'=>'control-label'])!!}
            <div class="row align-items-center">
                <div class="col-9">
                    {!! Form::number('idtesera', $data['idtesera'], ['class'=>'form-control']) !!}
                </div>
                <div class="col-3">
                    @if(isset($data['idtesera']))
                        <a href="https://tesera.ru/game/{{$data['idtesera']}}" target="_blank" rel="noreferrer noopener">
                            &#127922;
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!!Form::label('idbgg', 'idbgg', ['class'=>'control-label'])!!}
            <div class="row align-items-center">
                <div class="col-9">
                    {!! Form::number('idbgg', $data['idbgg'], ['class'=>'form-control']) !!}
                </div>
                <div class="col-3">
                    @if(isset($data['idbgg']))
                        <a href="https://boardgamegeek.com/boardgame/{{$data['idbgg']}}" target="_blank" rel="noreferrer noopener">
                            &#127922;
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!!Form::label('yearpublished', 'yearpublished', ['class'=>'control-label'])!!}
            <div>
                {!! Form::number('yearpublished', $data['yearpublished'], ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!!Form::label('bgggeekrating', 'bgggeekrating', ['class'=>'control-label'])!!}
            <div>
                {!! Form::number('bgggeekrating', $data['bgggeekrating'], ['class'=>'form-control', 'step' => '0.001']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!!Form::label('bggavgrating', 'bggavgrating', ['class'=>'control-label'])!!}
            <div>
                {!! Form::number('bggavgrating', $data['bggavgrating'], ['class'=>'form-control', 'step' => '0.001']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!!Form::label('bggnumvotes', 'bggnumvotes', ['class'=>'control-label'])!!}
            <div>
                {!! Form::number('bggnumvotes', $data['bggnumvotes'], ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
                {!!Form::label('minplayers', 'minplayers', ['class'=>'control-label'])!!}
                <div>
                    {!! Form::number('minplayers', $data['minplayers'], ['class'=>'form-control']) !!}
                </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
                {!!Form::label('maxplayers', 'maxplayers', ['class'=>'control-label'])!!}
                <div>
                    {!! Form::number('maxplayers', $data['maxplayers'], ['class'=>'form-control']) !!}
                </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
                {!!Form::label('suggestedplayers', 'suggestedplayers', ['class'=>'control-label'])!!}
                <div>
                    {!! Form::number('suggestedplayers', $data['suggestedplayers'], ['class'=>'form-control']) !!}
                </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!!Form::label('minage', 'minage', ['class'=>'control-label'])!!}
            <div>
                {!! Form::number('minage', $data['minage'], ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!!Form::label('suggestedage', 'suggestedage', ['class'=>'control-label'])!!}
            <div>
                {!! Form::number('suggestedage', $data['suggestedage'], ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!!Form::label('gameweight', 'gameweight', ['class'=>'control-label'])!!}
            <div>
                {!! Form::number('gameweight', $data['gameweight'], ['class'=>'form-control', 'step' => '0.01']) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!!Form::label('minplaytime', 'minplaytime', ['class'=>'control-label'])!!}
            <div>
                {!! Form::number('minplaytime', $data['minplaytime'], ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!!Form::label('maxplaytime', 'maxplaytime', ['class'=>'control-label'])!!}
            <div>
                {!! Form::number('maxplaytime', $data['maxplaytime'], ['class'=>'form-control']) !!}
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