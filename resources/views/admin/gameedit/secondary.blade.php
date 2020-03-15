<div class="row">
    <div class="col-md-12 ">
        <section id="types">
            <div class="d-flex justify-content-between align-items-center">
                Types
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
                    @foreach ($data->types as $key=>$item)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                                {!!Form::open(['url'=>route('gameDeleteType', array('game'=>$data['id'])), 'class'=>'form-horizontal', 'method' => 'DELETE', 'enctype'=>'multipart/form-data']) !!}
                                {{ Form::hidden('typeid', $item->id) }}
                                {!! Form::button('X', ['type'=>'submit', 'class'=>'btn btn-danger']) !!}
                                
                                {!!Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        
        <section id="categories">
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
        </section>

        <section id="mechanics">
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
        </section>

        <section id="families">
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
        </section>

        <section id="expansionfor">
            <div class="d-flex justify-content-between align-items-center">
                Expansions
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
                    @foreach ($data->expansions as $key=>$item)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$item->id}}</td>
                            <td>
                                <a href="{{route('gameEdit', ['game'=>$item->id])}}" role="button" target="_blank" rel="noreferrer noopener">
                                    {{$item->title}}
                                </a>
                            </td>
                            <td>
                                {!!Form::open(['url'=>route('gameDeleteExpansion', array('game'=>$data['id'])), 'class'=>'form-horizontal', 'method' => 'DELETE', 'enctype'=>'multipart/form-data']) !!}
                                {{ Form::hidden('expansionid', $item->id) }}
                                {!! Form::button('X', ['type'=>'submit', 'class'=>'btn btn-danger']) !!}
                                
                                {!!Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section id="expansions">
            <div class="d-flex justify-content-between align-items-center">
                Expansion For
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
                    @foreach ($data->expansionFor as $key=>$item)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$item->id}}</td>
                            <td>
                                <a href="{{route('gameEdit', ['game'=>$item->id])}}" role="button" target="_blank" rel="noreferrer noopener">
                                    {{$item->title}}
                                </a>
                            </td>
                            <td>
                                {!!Form::open(['url'=>route('gameDeleteExpansion', array('game'=>$data['id'])), 'class'=>'form-horizontal', 'method' => 'DELETE', 'enctype'=>'multipart/form-data']) !!}
                                {{ Form::hidden('expansionid', $item->id) }}
                                {!! Form::button('X', ['type'=>'submit', 'class'=>'btn btn-danger']) !!}
                                
                                {!!Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section id="publishers">
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
        </section>

        <section id="artists">
            <div class="d-flex justify-content-between align-items-center">
                Artists
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
                    @foreach ($data->artists as $key=>$item)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                                {!!Form::open(['url'=>route('gameDeleteArtist', array('game'=>$data['id'])), 'class'=>'form-horizontal', 'method' => 'DELETE', 'enctype'=>'multipart/form-data']) !!}
                                {{ Form::hidden('artistid', $item->id) }}
                                {!! Form::button('X', ['type'=>'submit', 'class'=>'btn btn-danger']) !!}
                                
                                {!!Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section id="designers">
            <div class="d-flex justify-content-between align-items-center">
                Designers
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
                    @foreach ($data->designers as $key=>$item)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                                {!!Form::open(['url'=>route('gameDeleteDesigner', array('game'=>$data['id'])), 'class'=>'form-horizontal', 'method' => 'DELETE', 'enctype'=>'multipart/form-data']) !!}
                                {{ Form::hidden('designer', $item->id) }}
                                {!! Form::button('X', ['type'=>'submit', 'class'=>'btn btn-danger']) !!}
                                
                                {!!Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
</div>
