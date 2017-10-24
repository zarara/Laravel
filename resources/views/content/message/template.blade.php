@extends('layout.master')

@section('title')
    Create
@endsection
@section('subtitle')
    Template Message
@endsection

@section('css')
@endsection

@section('content')
    <div id="data-template">
        <section class="panel">
            <div class="panel-collapse">
                <button class="btn btn-warning" data-toggle="modal" @click="create"><i
                        class="glyphicon glyphicon-pencil">Create</i></button>
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th class="text-center">Title</th>
                        <th class="text-center">Template</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="template in templates.data">
                        <td>@{{ template.title }}</td>
                        <td>@{{ template.message }}</td>
                        <td class="text-center">
                            <button class="edit-modal btn btn-primary" @click.prevent="edit(template)">
                                <span class="glyphicon glyphicon-edit"></span>
                            </button>
                            <button class="delete-modal btn btn-danger" @click.prevent="destroy(template)">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <nav>
                <ul class="pagination">
                    <li v-if="templates.current_page > 1">
                        <a href="#" aria-label="Previous"
                           @click.prevent="prev">
                            <span aria-hidden="true">Previous</span>
                        </a>
                    </li>

                    <li>
                    <li v-if="templates.current_page < templates.last_page">
                        <a href="#" aria-label="Next"
                           @click.prevent="next">
                            <span aria-hidden="true">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </section>

        <!-- Modal Create Template -->
        <div class="modal fade" id="create-template" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Create Template</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" v-model="forms.create.title"/>
                                <span v-if="formErrors['title']"
                                      class="error text-danger">@{{ formErrors['title'] }}</span>
                        </div>
                        <div class="form-group">
                            <label for="title">Message</label>
                                <textarea class="form-control" name="message"
                                          v-model="forms.create.message"></textarea>
                                <span v-if="formErrors['message']"
                                      class="error text-danger">@{{ formErrors['message'] }}</span>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" @click="store">OK</button>
                        </div>
                    </div>
                </div>
                nn
            </div>
        </div>

        <!-- Modal Edit Template -->
        <div class="modal fade" id="edit-template" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Edit Template</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data"
                              v-on:submit.prevent="update">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Title</label>
                                <input type="text" name="title" class="form-control" v-model="forms.update.title"/>
                                <span v-if="formErrorsUpdate['title']"
                                      class="error text-danger">@{{ formErrorsUpdate['title'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Message</label>
                                <textarea type="text" name="message" class="form-control"
                                          v-model="forms.update.message"></textarea>
                                <span v-if="formErrorsUpdate['message']"
                                      class="error text-danger">@{{ formErrorsUpdate['message'] }}</span>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')
    <script src="{{elixir('js/template.js')}}"></script>
    {{--<script>--}}
        {{--$(function () {--}}
            {{--$('#modal-edit').on('shown.bs.modal', function (event) {--}}
                {{--var modal = $(this)--}}
                {{--var button = $(event.relatedTarget)--}}
                {{--var template = button.data('template')--}}
                {{--modal.find('#title').val(template.title)--}}
                {{--modal.find('#message').html(template.message)--}}
            {{--})--}}
        {{--})--}}
    {{--</script>--}}
@endsection
