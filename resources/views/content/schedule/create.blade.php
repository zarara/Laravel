@extends('layout.master')

@section('title')
    Create
@endsection
@section('subtitle')
    Message Scheduled
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.45/css/bootstrap-datetimepicker.min.css" />
@endsection

@section('content')
    <div id="scheduled">
        <section class="panel">
            <div class="panel-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Send to</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" :value="names">
                        </div>
                        <div class="col-sm-3">
                            <pendaftar-picker v-model="selected_group"
                                              v-model="forms.create.reciver_id"></pendaftar-picker>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Date Time</label>
                        <div class="col-sm-10">
                            <div class='input-group date' id='datetimepicker1'>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                <input type='text' id="datetime" class="form-control" v-model="form.date"/>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" rows="5"
                                      v-model="form.message"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="panel-info">
                {{--<button class="btn btn-danger" ><i class="glyphicon glyphicon-remove">Discard</i></button>--}}
                <template-picker @input="form.message=arguments[0].message"></template-picker>
                <button class="btn btn-success pull-right"><i class="glyphicon glyphicon-save" @click="sendMessage">
                    Save</i></button>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <!--Forms-->
    <link href="{{asset('vendor/form-helpers/css/bootstrap-formhelpers.min.css')}}" rel="stylesheet">
    <script src="{{asset('vendor/form-helpers/js/bootstrap-formhelpers.min.js')}}"></script>

    <link href="{{asset('vendor/css/forms.css')}}" rel="stylesheet">
    {{--    <script src="{{asset('vendor/js/forms.js')}}"></script>--}}

    <script src="{{asset('vendor/mask/jquery.maskedinput.min.js')}}"></script>

    <!-- jQuery UI -->
    {{--<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>--}}
    <!-- jQuery UI -->
    <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">

    <!-- bootstrap-datetimepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.45/js/bootstrap-datetimepicker.min.js"></script>

    <script>
        window.datetime = {
            value:null
        }

        window.renderDateTimePicker = function () {
            $('#datetimepicker1').datetimepicker({
                format:'DD-MM-YYYY HH:mm'
            });
            $("#datetimepicker1").on("dp.change", function (e) {
                window.datetime.value=$('#datetime').val()
            });
        }
    </script>
    <script src="{{elixir('js/scheduled.js')}}"></script>
@endsection