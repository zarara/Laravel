@extends('layout.master')

@section('title')
    Create
@endsection
@section('subtitle')
    Message Personal
@endsection

@section('css')
@endsection

@section('content')
    <div id="create-personal">
        <section class="panel">
            <div class="panel-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Send to</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" :value="names" disabled>
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal-add"><i
                                        class="glyphicon glyphicon-phone-alt"> Add</i></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" placeholder="Textarea" rows="5" v-model="form.message"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-info">
               {{-- <button class="btn btn-danger"><i class="glyphicon glyphicon-remove">Discard</i></button>--}}
                <template-picker @input="form.message=arguments[0].message"></template-picker>
                <button class="btn btn-success pull-right" @click="sendMessage"><i class="glyphicon glyphicon-send">Send</i></button>
            </div>
        </section>



        <!-- Modal Add Phone Number -->
        <div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Add Number</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel-title">
                            <div class="form-group">
                                <div class="pull-right">
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="query" @keyup.enter="loadPendaftar"
                                        v-model="query">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default" type="submit">
                                                <i class="glyphicon glyphicon-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="panel-body">
                            <table class="table table-condensed">
                                <thead>
                                <tr>
                                    <td class="text-center">Name</td>
                                    <td class="text-center">Email</td>
                                    <td class="text-center">Number</td>
                                    <td class="text-center">Check</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="user in pendaftar.data">
                                    <td>@{{user.name}}</td>
                                    <td>@{{user.email}}</td>
                                    <td class="text-center">@{{user.kontak}}</td>
                                    <td class="text-center">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" v-model="pilih" :value="user" :checked="ischecked(user)">
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="panel-info">
                                <nav aria-label="...">
                                    <ul class="pager">
                                        <li><a class="btn" @click="prev">Previous</a></li>
                                        <li><a class="btn" @click="next">Next</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="panel-info">
                            <form>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">Selected</label>
                                    <input type="text" class="form-control"  :value="names">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Clear</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{elixir('js/create-personal.js')}}"></script>
@endsection
