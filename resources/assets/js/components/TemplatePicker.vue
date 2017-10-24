<template>
    <div class="Template">
        <button class="btn btn-warning" data-toggle="modal" @click="show"><i
                class="glyphicon glyphicon-paperclip">Template</i></button>

        <!-- Modal Add Template -->
        <div class="modal fade" id="modal-template" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Template Message</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel-body">
                            <table class="table table-condensed">
                                <thead>
                                <tr>
                                    <td class="text-center">Title</td>
                                    <td class="text-center">Template</td>
                                    <td class="text-center">Check</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="data in template.data">
                                    <td>{{data.title}}</td>
                                    <td>{{data.message}}</td>
                                    <td class="text-center">
                                        <div class="checkbox">
                                            <label>
                                                <input type="radio" v-model="selected" :value="data">
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" @click="pilih">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        props:{
            value:{
                default:null
            }
        },

        data(){
            return{
                template:{},
                query:'',
                selected:null
            }
        },

        mounted(){
            this.loadTemplate()
        },

        methods:{
            loadTemplate(){
                let param = {
                    limit: 5
                }
                if (this.query.trim()){
                    param.query = this.query
                }
                this.$http.get('/api/template',{
                    params: param

                }).then(response=> {
                    this.template = response.data
                })
            },
            next(){
                this.$http.get(this.template.next_page_url)
                    .then(response=> {
                        this.template = response.data
                    })
             },
            prev(){
                this.$http.get(this.template.prev_page_url)
                    .then(response=> {
                        this.template = response.data
                    })
            },
            select(template){
                this.selected=template>=1
            },
            pilih(){
                this.$emit('input',this.selected)

                 $("#modal-template").modal('hide');
            },
            show(){
                 $("#modal-template").modal('show');
            }
        }
    }
</script>
