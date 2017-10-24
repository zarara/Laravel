@extends('layout.master')

@section('title')
    Create
@endsection
@section('subtitle')
    Scheduled Message
@endsection

@section('css')

@endsection

@section('content')
    <div id="scheduled">
        <section class="panel">
            <div class="panel-collapse">
                <a href="schedule_create">
                    <button class="btn btn-warning"><i class="glyphicon glyphicon-pencil">Create</i></button>
                </a>
            </div>
            <div class="panel-body">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center">To</th>
                        <th class="text-center">Message</th>
                        <th class="text-center">Date Time</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{--<tr v-for="schedule in schedules.data">--}}
                    {{--<td class="text-center"> @{{schedule.datetime}}</td>--}}
                    {{--<td class="text-center"> @{{schedule.message}}</td>--}}
                    {{--<td class="text-center"> @{{schedule.reciver_id}}</td>--}}
                    {{--<td class="text-green text-center "> @{{schedule.status}}</td>--}}
                    {{--<td class="text-center">--}}
                    {{--<button type="button" class="btn btn-success" data-toggle="modal" @click.prevent="detail(schedule)">--}}
                    {{--<i class="glyphicon glyphicon-eye-open"></i>--}}
                    {{--</button>--}}
                    {{--<button class="btn btn-danger" data-toggle="modal"  @click.prevent="destroy(schedule)"><i class="glyphicon glyphicon-trash"></i> </button>--}}
                    {{--</td>--}}
                    {{--</tr>--}}

                    <tr>
                        @foreach($scheduled as $data)
                            <td>{{$data->reciver_name}}</td>
                            <td class="text-center"> {{substr($data->message, 0, 70)}}</td>
                            <td class="text-center"> {{$data->datetime}}</td>
                            <td class="text-center"><span class="label label-info">{{$data->status}}</span></td>
                            <td class="text-center">
                                <form  method="POST"
                                      action="{{ route('cschedule.destroy', $data->id) }}">
                                    <button type="button" class="btn btn-success"
                                            data-toggle="modal" data-target="#modal-read"
                                            data-scheduled="{{$data->toJson()}}">
                                        <i class="glyphicon glyphicon-eye-open"></i>
                                    </button>
                                    <button type="submit" class="btn btn-danger">
                                        <i class="glyphicon glyphicon-trash"></i>
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                    </button>
                                </form>
                            </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <nav>
                <div class="panel-info">
                    {{ $scheduled->render() }}
                    <label class="pull-right">
                        {{ ($scheduled->perPage()*($scheduled->currentPage()-1)+1) }}
                        to {{$scheduled->perPage()*$scheduled->currentPage()}} from {{$scheduled->total()}}
                    </label>
                </div>
            </nav>
        </section>

        <!-- Modal Edit Scheduled -->
        <div class="modal fade" id="modal-read" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Detail Message</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            {{--<div class="form-group">--}}
                            {{--<label class="control-label">To </label>--}}
                            {{--<p class="form-control-static" id="reciver_id" v-html="forms.show.reciver_id"></p>--}}
                            {{--</div>--}}
                            <div class="form-group">
                                <label class="control-label">Date Time</label>
                                <p class="form-control-static" id="datetime" v-html="forms.show.datetime"></p>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Message </label>
                                <textarea type="text" class="form-control" rows="7" id="message"
                                          v-html="forms.show.message" disabled></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        {{--.<button type="button" class="btn btn-success" data-dismiss="modal">Save</button>--}}
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Delete Scheduled -->
        <div class="modal fade bs-example-modal-sm" id="modal-delete" tabindex="-1" role="dialog"
             aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body bg-danger">
                        <label> Are you sure for delete this ? </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            $('#modal-read').on('shown.bs.modal', function (event) {
                var modal = $(this)
                var button = $(event.relatedTarget)
                var scheduled = button.data('scheduled')

//                modal.find('#reciver_id').html(scheduled.matakuliah.name)
                modal.find('#datetime').html(scheduled.datetime)
                modal.find('#message').html(scheduled.message)
            })
        })
    </script>
    {{--<script src="{{elixir('js/scheduled.js')}}"></script>--}}
@endsection
