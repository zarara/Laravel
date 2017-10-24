<template>
    <div class="Pendaftar">
        <button class="btn btn-primary" data-toggle="modal" data-target="#add-pendaftar"><i
                class="glyphicon glyphicon-phone-alt"> Add</i></button>


        <!-- Modal Add Group  -->
        <div class="modal fade" id="add-pendaftar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Add Group</h4>
                    </div>
                    <div class="modal-body">
                        <div class="panel-options">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <p>Matakuliah</p>
                                        <select class="form-control" style="width: 100%;" v-model="selected.matakuliah" >
                                            <option v-for="data in matakuliah" :value="data">{{data.name}} </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Periode</p>
                                        <select class="form-control" style="width: 100%;" id="jurusan" v-model="selected.period">
                                            <option v-for="(data,i) in period" :value="data" :selected="i==1" >{{data.year}} / {{data.semester}} </option>
                                        </select>
                                    </div><!-- /.col -->
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" @click="pilih" data-dismiss="modal">OK</button>
                        </div>
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
                default:{
                    matakuliah:{},
                    period:{}
                }
            }
        },
        data(){
            return{
                 matakuliah:[],
                 period:[],
                 selected:{
                        matakuliah:{},
                        period:{}
                 }
            }
        },

         mounted(){
            this.loadMatakuliah(),
            this.loadPeriod()
        },

        methods:{
             loadMatakuliah(){
                this.$http.get('/api/matakuliah')
                .then(response=> {
                    this.matakuliah = response.data
                })
            },

            loadPeriod(){
                this.$http.get('/api/period')
                .then(response=> {
                    this.period = response.data
                })
            },

            pilih(){
                this.$emit('input',this.selected)
                 $("#add-pendaftar").modal('hide');
            },
            show_group(){
                 $("#add-pendaftar").modal('show');
            }
        }
    }
</script>
