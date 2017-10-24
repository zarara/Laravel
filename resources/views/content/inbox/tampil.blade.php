@extends('layout.master')

@section('title')
    Inbox
@endsection
@section('subtitle')
    Message Inbox
@endsection

@section('css')

@endsection

@section('content')
    <div id="data-inbox">
        <section class="panel">
            <div class="panel-collapse">
                <button class="btn btn-primary"><i class="glyphicon glyphicon-refresh">Refresh</i></button>
            </div>
            <div class="panel-body">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center">Sender</th>
                        <th class="text-center">Message</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Time</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="inbox in inboxs.data">
                            <td class="text-center"> @{{ inbox.sender_id }} </td>
                            <td class="text-center"> @{{ inbox.message }} </td>
                            <td class="text-center"> @{{ inbox.date_recive }}</td>
                            <td class="text-center"> @{{ inbox.time_recive }}</td>
                            <td class="text-center"><label class="text-success"> @{{ inbox.status }}</label></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success"
                                        data-toggle="modal" @click.prevent="detail(inbox)">
                                    <i class="glyphicon glyphicon-eye-open"></i>
                                </button>
                                <button class="btn btn-warning" data-toggle="modal" data-target="#modal-balas"><i
                                            class="glyphicon glyphicon-share-alt"></i></button>
                                <button class="btn btn-danger" data-toggle="modal" @click.prevent="destroy(inbox)"><i
                                            class="glyphicon glyphicon-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>


        <!-- Modal Read Message -->
        <div class="modal fade" id="modal-read" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Detail Message</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label class="control-label">Sender </label>
                                <p class="form-control-static" id="sender_id" v-html="forms.show.sender_id"></p>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Date </label>
                                <p class="form-control-static" id="date" v-html="forms.show.date_recive"></p>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Time </label>
                                <p class="form-control-static" id="time" v-html="forms.show.time_recive"></p>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Mesaage </label>
                                <textarea type="text" class="form-control" id="message" v-model="forms.show.message"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Send Message -->
        <div class="modal fade" id="modal-balas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
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
                                <p class="form-control-static" id="number"></p>
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
    </div>

@endsection

@section('js')
    <script src="{{elixir('js/inbox.js')}}"></script>
@endsection
