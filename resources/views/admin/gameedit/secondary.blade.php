<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            Categories
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
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
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <game-edit-modal></game-edit-modal>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>