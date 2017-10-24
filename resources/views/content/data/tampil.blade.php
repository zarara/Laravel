@extends('layout.master')

@section('title')
    Data
@endsection
@section('subtitle')
    Data Pendaftar
@endsection


@section('css')
@endsection

@section('content')
    <section class="panel">
        <div class="panel-options">
            <div class="row">
                <!--Selection-->
                <form method="get">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <p>Jurusan</p>
                                        <select class="form-control" style="width: 100%;" id="jurusan"
                                                name="jurusan">
                                            @foreach($jurusan as $data)
                                                <option value={{$data->id}} {{$data->id==Request::get('jurusan')?'selected':''}}>{{$data->name}} </option>
                                            @endforeach
                                        </select>
                                    </div><!-- /.col -->

                                    <div class="col-md-4">
                                        <p>Periode</p>
                                        <select class="form-control" style="width: 100%;" id="cmbmatakuliah"
                                                name="period">
                                            @foreach($period as $data)
                                                <option value= {{$data->id}} {{$data->id==Request::get('period')?'selected':''}}> {{$data->year}}
                                                    - {{$data->semester}} </option>
                                            @endforeach
                                        </select>
                                    </div><!-- /.col -->

                                    <div class="col-md-4">
                                        <p>TFT</p>
                                        <select class="form-control" style="width: 100%;" id="cmbtft"
                                                name="tft">
                                            <option value="0" {{Request::get('tft')==0?'selected':''}}>0</option>
                                            <option value="1" {{Request::get('tft')==1?'selected':''}}>1</option>
                                        </select>
                                    </div>

                                </div><!-- End Colum Selection-->
                            </div>
                        </div>
                        <div class="panel-footer ">
                            <div class="col-md-2 col-md-offset-3">
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-ok-sign">
                                    Filter</i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

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
                    <th class="text-center">TFT</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pendaftar as $data)
                    <tr>
                        <td class="text-center">{{$data->npm}}</td>
                        <td>{{$data->name}}</td>
                        <td class="text-center">{{$data->tft}}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-success"
                                    data-toggle="modal" data-target="#modal-pendaftar"
                                    data-pendaftar="{{$data->toJson()}}">
                                <i class="glyphicon glyphicon-eye-open"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <nav>
            <div class="panel-info">
                {{ $pendaftar->render() }}
                <label class="pull-right">
                    {{ ($pendaftar->perPage()*($pendaftar->currentPage()-1)+1) }}
                    to {{$pendaftar->perPage()*$pendaftar->currentPage()}} from {{$pendaftar->total()}}
                </label>
            </div>
        </nav>
    </section>


    <!-- Modal Pendaftar -->
    <div class="modal fade" id="modal-pendaftar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary ">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Detail Data</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">NIM </label>
                            <p class="form-control-static" id="npm"></p>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Name </label>
                            <p class="form-control-static" id="name"></p>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Department </label>
                            <p class="form-control-static" id="jurusan"></p>
                        </div>
                        <div class="form-group">
                            <table class="table table-condensed" id="matakuliah">
                                <caption><label>Assistant Courses</label></caption>
                                <thead>
                                <tr>
                                    <td>Course</td>
                                    <td>Department</td>
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

@endsection

@section('js')
    <script>
        $(function () {
            $('#modal-pendaftar').on('shown.bs.modal', function (event) {
                var modal = $(this)
                var button = $(event.relatedTarget)
                var pendaftar = button.data('pendaftar')

                modal.find('#npm').html(pendaftar.npm)
                modal.find('#name').html(pendaftar.name)
                modal.find('#jurusan').html(pendaftar.jurusan.name)
                pendaftar.matakuliah.forEach((makul) = > {
                    var item = `
                        <tr>
                            <td>${makul.name}</td>
                            <td>${makul.jurusan.name}</td>
                            <td>${makul.pivot.period.semester}</td>
                            <td>${makul.pivot.period.year}</td>
                        </tr>
                    `
                    modal.find('#matakuliah>tbody').append(item)
            })
            })
        })
    </script>
@endsection
