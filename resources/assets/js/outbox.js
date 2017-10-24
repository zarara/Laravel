/**
 * Created by ZARRA on 26/01/2017.
 */

require('./bootstrap');
import Vue from 'vue'
import VueResource from 'vue-resource'
import VuePaginator from 'vuejs-paginator'

Vue.use(VueResource)


new Vue({

    el: '#data-outbox',

    data: {
        outboxs: [],
        pagination: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1
        },
        query:'',
        offset: 4,
        forms: {
            default: {
                reciver_id: '',
                message: '',
                date_recive: '',
                time_recive: '',
                status: ''
            },
            show: {
                reciver_id: '',
                message: '',
                date_recive: '',
                time_recive: '',
                status: ''
            }
        },
        
        resource_url: '/api/outbox',
        options: {
            remote_data: 'nested.data',
            remote_current_page: 'nested.current_page',
            remote_last_page: 'nested.last_page',
            remote_next_page_url: 'nested.next_page_url',
            remote_prev_page_url: 'nested.prev_page_url',
            next_button_text: 'Go Next',
            previous_button_text: 'Go Back'
        }
        
    },

    computed: {
        isActived: function () {
            return this.pagination.current_page;
        },
        pagesNumber: function () {
            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },

    mounted(){
        this.loadOutbox()
    },

    components: {
        VPaginator: VuePaginator
    },

    methods : {
        updateResource(data){
            this.outboxs = data
        },

        loadOutbox(){
            let param = {
                limit:10
            }

            if (this.query.trim()){
                param.query=this.query
            }
            this.$http.get('/api/outbox',{
                params:param

            }).then(response=>{
                this.outboxs=response.data
            })
        },

        next(){
            this.$http.get(this.outboxs.next_page_url)
                .then(response=>{
                    this.outboxs=response.data
                })
        },
        prev(){
            this.$http.get(this.outboxs.prev_page_url)
                .then(response=>{
                    this.outboxs=response.data
                })
        },
        detail(outbox) {
            this.forms.show = { ...outbox }
            $("#modal-read").modal('show');
        },

        tampil(){
            this.$http.get('api/outbox/'+outbox.id)
                .then(response=>{
                    if (response.data === true){
                        let outboxIndex = _.findIndex(this.outboxs.data, t => outbox.id === t.id)
                        this.outboxs.data.splice(outboxIndex, 1)
                    }
                })
        },
        destroy(outbox) {
            this.$http.delete('api/outbox/' + outbox.id)
                .then(response => {
                    if (response.data === true){
                        let outboxIndex = _.findIndex(this.outboxs.data, t => outbox.id === t.id)
                        this.outboxs.data.splice(outboxIndex, 1)
                    }
                })
        },
        resetForm(form) {
            form = { ...this.forms.default }
        }
    }
});

