@extends('layout.master')

@section('title')
    Create
@endsection
@section('subtitle')
    Message Group
@endsection

@section('css')
@endsection

@section('content')
    <div id="create-group">
        <section class="panel">
            <div class="panel-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Send to</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control"  :value="names" disabled>
                        </div>
                        <pendaftar-picker v-model="selected_group"></pendaftar-picker>
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
                {{--<button class="btn btn-danger"><i class="glyphicon glyphicon-remove">Discard</i></button>--}}
                <template-picker @input="form.message=arguments[0].message"></template-picker>
                <button class="btn btn-success pull-right" @click="sendMessage"><i class="glyphicon glyphicon-send">Send</i></button>
            </div>
        </section>


</div>
@endsection

@section('js')
    {{--<script>--}}
        {{--$(function () {--}}
            {{--$('#modal-add').on('shown.bs.modal', function (event) {--}}
                {{--var modal = $(this)--}}
                {{--var button = $(event.relatedTarget)--}}
                {{--var add = button.data('add')--}}

                {{--modal.find('#name').html(add.name)--}}
                {{--add.matakuliah.forEach((makul) => {--}}
                    {{--var item = `--}}
                        {{--<tr>--}}
                            {{--<td>${makul.name}</td>--}}
                            {{--<td>${makul.pivot.period.year}</td>--}}
                        {{--</tr>--}}
                    {{--`--}}
                    {{--modal.find('#matakuliah>tbody').append(item)--}}
            {{--})--}}
            {{--})--}}
        {{--})--}}
    {{--</script>--}}
    <script src="{{elixir('js/create-group.js')}}"></script>
@endsection
