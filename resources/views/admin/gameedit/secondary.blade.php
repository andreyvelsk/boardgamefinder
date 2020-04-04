<div class="row">
    <div class="col-md-12 ">
        @foreach ($attributes as $key=>$items)
            {{$items[0]->type->bggname}}
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($items as $k=>$item)
                            <tr>
                                <th scope="row">{{$k+1}}</th>
                                <td>{{$item->idbgg}}</td>
                                <td>{{$item->bggname}}</td>
                                <td>
                                    {!!Form::open(['url'=>route('gameDeleteAttribute', array('game'=>$data['id'])), 'class'=>'form-horizontal', 'method' => 'DELETE', 'enctype'=>'multipart/form-data']) !!}
                                        {{ Form::hidden('attributeid', $item->id) }}
                                        {!! Form::button('X', ['type'=>'submit', 'class'=>'btn btn-danger']) !!}
                                    {!!Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
</div>
