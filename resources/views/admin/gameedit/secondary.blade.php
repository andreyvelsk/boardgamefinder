<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            Categories
            <button type="button" class="btn btn-success">
                Добавить
            </button>
        </div>
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
                @foreach ($data->categories as $key=>$item)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            {!!Form::open(['url'=>route('gameDeleteCategory', array('game'=>$data['id'])), 'class'=>'form-horizontal', 'method' => 'DELETE', 'enctype'=>'multipart/form-data']) !!}
                            {{ Form::hidden('categoryid', $item->id) }}
                            {!! Form::button('X', ['type'=>'submit', 'class'=>'btn btn-danger']) !!}
                            
                            {!!Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center">
            Mechanics
            <button type="button" class="btn btn-success">
                Добавить
            </button>
        </div>
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
                @foreach ($data->mechanics as $key=>$item)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            {!!Form::open(['url'=>route('gameDeleteMechanic', array('game'=>$data['id'])), 'class'=>'form-horizontal', 'method' => 'DELETE', 'enctype'=>'multipart/form-data']) !!}
                            {{ Form::hidden('mechanicid', $item->id) }}
                            {!! Form::button('X', ['type'=>'submit', 'class'=>'btn btn-danger']) !!}
                            
                            {!!Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center">
            Families
            <button type="button" class="btn btn-success">
                Добавить
            </button>
        </div>
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
                @foreach ($data->families as $key=>$item)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            {!!Form::open(['url'=>route('gameDeleteFamily', array('game'=>$data['id'])), 'class'=>'form-horizontal', 'method' => 'DELETE', 'enctype'=>'multipart/form-data']) !!}
                            {{ Form::hidden('familyid', $item->id) }}
                            {!! Form::button('X', ['type'=>'submit', 'class'=>'btn btn-danger']) !!}
                            
                            {!!Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center">
            Publishers
            <button type="button" class="btn btn-success">
                Добавить
            </button>
        </div>
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
                @foreach ($data->publishers as $key=>$item)
                    <tr>
                        <th scope="row">{{$key+1}}</th>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            {!!Form::open(['url'=>route('gameDeletePublisher', array('game'=>$data['id'])), 'class'=>'form-horizontal', 'method' => 'DELETE', 'enctype'=>'multipart/form-data']) !!}
                            {{ Form::hidden('publisherid', $item->id) }}
                            {!! Form::button('X', ['type'=>'submit', 'class'=>'btn btn-danger']) !!}
                            
                            {!!Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
