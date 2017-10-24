@extends('layout.master')

@section('title')
    Outbox
@endsection
@section('subtitle')
    Outbox Message
@endsection

@section('css')

@endsection

@section('content')
    <div id="data-outbox">
        <section class="panel">
            {{--<div class="panel-collapse">--}}
                {{--<button class="btn btn-primary"><i class="glyphicon glyphicon-refresh">Refresh</i></button>--}}
            {{--</div>--}}
            <div class="panel-body">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center">Receiver</th>
                        <th class="text-center">Message</th>
                        <th class="text-center">Date Time</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="outbox in outboxs.data">
                            <td> @{{ outbox.pendaftar.name}} </td>
                            <td> @{{ outbox.message }} </td>
                            <td class="text-center"> @{{ outbox.send_at }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-success"
                                        data-toggle="modal" @click.prevent="detail(outbox)">
                                    <i class="glyphicon glyphicon-eye-open"></i>
                                </button>
                                {{--<button class="btn btn-primary" data-toggle="modal" data-target="#modal-teruskan"><i--}}
                                            {{--class="glyphicon glyphicon-share-alt"></i></button>--}}
                                <button class="btn btn-danger" data-toggle="modal" @click.prevent="destroy(outbox)"><i
                                            class="glyphicon glyphicon-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <nav>
                <ul class="pagination">
                    <li v-if="outboxs.current_page > 1">
                        <a href="#" aria-label="Previous"
                           @click.prevent="prev">
                            <span aria-hidden="true">Previous</span>
                        </a>
                    </li>
                    <li v-if="outboxs.current_page < outboxs.last_page">
                        <a href="#" aria-label="Next"
                           @click.prevent="next">
                            <span aria-hidden="true">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
            {{--<v-paginator :resource_url="resource_url" @update="loadOutbox"></v-paginator>--}}
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
                            {{--<div class="form-group">--}}
                                {{--<label class="control-label">Sender </label>--}}
                                {{--<p class="form-control-static" id="reciver_id" v-html="forms.show.reciver_id"></p>--}}
                            {{--</div>--}}
                            <div class="form-group">
                                <label class="control-label">Date </label>
                                <p class="form-control-static" id="date" v-html="forms.show.send_at"></p>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Mesaage </label>
                                <textarea type="text" class="form-control" id="message" v-html="forms.show.message"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{elixir('js/outbox.js')}}"></script>

@endsection
