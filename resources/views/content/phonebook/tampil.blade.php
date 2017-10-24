@extends('layout.master')

@section('title')
    Phonebook
@endsection
@section('subtitle')
    Phonebook Registrants
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
        </div>

        <div class="panel-body">
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th class="text-center">NIM</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Phone</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($phone as $data)
                    <tr>
                        <td class="text-center">{{$data->npm}}</td>
                        <td>{{$data->name}}</td>
                        <td class="text-center">{{$data->kontak}}</td>
                        <td>{{$data->email}}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-success"
                                    data-toggle="modal" data-target="#modal-phone"
                                    data-pendaftar="{{$data->toJson()}}">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </button>
                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                    data-target="#modal-edit-phone"
                                    data-pendaftar="{{$data->toJson()}}">
                                <i class="glyphicon glyphicon-edit"></i>
                            </button>
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-send"
                                    data-pendaftar="{{$data->toJson()}}">
                                <i class="glyphicon glyphicon-envelope"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="panel-info">
            {{ $phone->render() }}
            <label class="pull-right">
                {{ ($phone->perPage()*($phone->currentPage()-1)+1) }} to {{$phone->perPage()*$phone->currentPage()}}
                from {{$phone->total()}}
            </label>
        </div>
    </section>



    <!-- Modal Detail Phonebook -->
    <div class="modal fade" id="modal-phone" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Detail Phonebook</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <table class="table table-condensed" id="matakuliah">
                                <caption><label>List Group</label></caption>
                                <thead>
                                <tr>
                                    <td>Course</td>
                                    <td>Semester</td>
                                    <td>Period</td>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Phonebook -->
    <div class="modal fade" id="modal-edit-phone" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Edit Phonebook</h4>
                </div>
                <div class="modal-body">
                    <form method="patch" action="phone_update">
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">NIM</label>
                            <p class="form-control-static" id="npm"></p>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Name</label>
                            <p class="form-control-static" id="name"></p>
                        </div>
                        <div class="form-group">
                            <label class="control-label"> Phone Number </label>
                            <input type="text" class="form-control" id="number">
                        </div>
                        <div class="form-group">
                            <label class="control-label"> Email </label>
                            <input type="text" class="form-control" id="email">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Send Message -->
    <div class="modal fade" id="modal-send" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Message</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">To : </label>
                            <p class="form-control-static" id="name"></p>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Message</label>
                            <textarea class="form-control" placeholder="Textarea" rows="5"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-success">Send</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $('#modal-phone').on('shown.bs.modal', function (event) {
                var modal = $(this)
                var button = $(event.relatedTarget)
                var pendaftar = button.data('pendaftar')

                pendaftar.matakuliah.forEach((makul) => {
                    var item = `
                        <tr>
                            <td>${makul.name}</td>
                            <td>${makul.pivot.period.semester}</td>
                            <td>${makul.pivot.period.year}</td>
                        </tr>
                    `
                    modal.find('#matakuliah>tbody').append(item)
                })
            }),

            $('#modal-edit-phone').on('shown.bs.modal', function (event) {
                var modal = $(this)
                var button = $(event.relatedTarget)
                var pendaftar = button.data('pendaftar')

                modal.find('#npm').html(pendaftar.npm)
                modal.find('#name').html(pendaftar.name)
                modal.find('#number').val(pendaftar.kontak)
                modal.find('#email').val(pendaftar.email)
            }),

            $('#modal-send').on('shown.bs.modal', function (event) {
                var modal = $(this)
                var button = $(event.relatedTarget)
                var pendaftar = button.data('pendaftar')

                modal.find('#name').html(pendaftar.name)

            })
        })
    </script>
@endsection
