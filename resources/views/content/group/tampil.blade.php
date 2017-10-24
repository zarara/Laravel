@extends('layout.master')

@section('title')
    Group
@endsection
@section('subtitle')
    Group Phonebook
@endsection

@section('css')

@endsection

@section('content')
    <section class="panel">
        <div class="panel-primary">
            <form method="get">
                <div class="form-group">
                    <div class="col-sm-3 pull-right">
                        <div class="input-group">
                            <input class="form-control" id="appendbutton" type="text" name="query">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            {{--<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-create-group"><i class="glyphicon glyphicon-pencil"></i>Create</button>--}}
        </div>
        <div class="panel-body">
            <table class="table table-condensed">
                <thead>
                <tr >
                    <th class="text-center">Name Group</th>
                    <th class="text-center">Semester</th>
                    {{--<th class="text-center">Total Member</th>--}}
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($group as $data)
                    <tr>
                        <td>{{$data->name}}</td>
                        <td class="text-center">{{$data->semester}}</td>
                        {{--<td class="text-center">{{$data->count()}}</td>--}}
                        <td class="text-center">
                            <button type="button" class="btn btn-success"
                                    data-toggle="modal" data-target="#modal-group"
                                    data-group ="{{$data->toJson()}}">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </button>
                            {{--<button type="button" class="btn btn-warning"--}}
                                    {{--data-toggle="modal" data-target="#modal-edit-group"--}}
                                    {{--data-group="{{$data->toJson()}}">--}}
                                {{--<i class="glyphicon glyphicon-edit"></i>--}}
                            {{--</button>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="panel-info">
            <div class="panel-info">
                {{ $group->render() }}
                <label class="pull-right">
                    {{ ($group->perPage()*($group->currentPage()-1)+1) }} to {{$group->perPage()*$group->currentPage()}} from {{$group->total()}}
                </label>
            </div>
        </div>
    </section>



    <!-- Modal Create Group -->
    <div class="modal fade" id="modal-create-group" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Create Group</h4>
                </div>
                <div class="modal-body">
                    <form >
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Name Group </label>
                            <input type="text" class="form-control" id="npm">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Semester </label>
                            <input type="text" class="form-control" id="npm">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Period </label>
                            <input type="text" class="form-control" id="npm">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Group -->
    <div class="modal fade" id="modal-group" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Detail Group</h4>
                </div>
                <div class="modal-body">
                    <form >
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Name Group </label>
                            <p class="form-control-static" id="name"></p>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Code</label>
                            <p class="form-control-static" id="code"></p>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Department</label>
                            <p class="form-control-static" id="dname"></p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Group -->
    <div class="modal fade" id="modal-edit-group" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Create Group</h4>
                </div>
                <div class="modal-body">
                    <form >
                        <div class="form-group">
                            <label for="name" class="control-label">Name Group </label>
                            <input type="text" class="form-control" id="name">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $(function () {
            $('#modal-group').on('shown.bs.modal', function (event) {
                var modal = $(this)
                var button = $(event.relatedTarget)
                var group = button.data('group')
                modal.find('#name').html(group.name)
                modal.find('#code').html(group.kode)
                modal.find('#dname').html(group.jurusan.name)
            })
        })
        $(function () {
            $('#modal-create-group').on('shown.bs.modal', function (event) {
                var modal = $(this)
                var button = $(event.relatedTarget)
                var group = button.data('group')
            })
        })
        $(function () {
            $('#modal-edit-group').on('shown.bs.modal', function (event) {
                var modal = $(this)
                var button = $(event.relatedTarget)
                var group = button.data('group')
                modal.find('#name').val(group.name)
            })
        })
    </script>
@endsection
