@extends('layout.master')

@section('title')
    Dashboard
@endsection
@section('subtitle')
    Dashboard
@endsection

@section('css')

@endsection

@section('content')
    <div class="panel">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <div class="caption bg-success">
                            <h1><b>Phonebook</b></h1>
                            <h3>{{$pendaftar}}</h3>
                            <p>
                                <a href="phone" class="btn btn-primary" role="button">Go to</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <div class="caption bg-info">
                            <h1><b>Group</b></h1>
                            <h3>{{$matakuliah}}</h3>
                            <p>
                                <a href="group" class="btn btn-primary" role="button">Go to</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <div class="caption bg-danger">
                            <h1><b>Outbox</b></h1>
                            <h3>{{$outbox}}</h3>
                            <p>
                                <a href="outbox" class="btn btn-primary" role="button">Go to</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Notification</div>
                <div class="panel-body">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
