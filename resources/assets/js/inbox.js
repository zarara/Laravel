/**
 * Created by ZARRA on 26/01/2017.
 */

require('./bootstrap');


new Vue({

    el: '#data-inbox',

    data: {
        inboxs: [],
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
                sender_id: '',
                message: '',
                date_recive: '',
                time_recive: '',
                status: ''
            },
            show: {
                sender_id: '',
                message: '',
                date_recive: '',
                time_recive: '',
                status: ''
            }
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
        this.loadInbox()
    },

    methods : {

        loadInbox(){
            let param = {
                limit:7
            }

            if (this.query.trim()){
                param.query=this.query
            }
            this.$http.get('/api/inbox',{
                params:param

            }).then(response=>{
                this.inboxs=response.data
            })
        },

        next(){
            this.$http.get(this.inboxs.next_page_url)
                .then(response=>{
                    this.inboxs=response.data
                })
        },
        prev(){
            this.$http.get(this.inboxs.prev_page_url)
                .then(response=>{
                    this.inboxs=response.data
                })
        },
        detail(inbox) {
            this.forms.show = { ...inbox }
            $("#modal-read").modal('show');
        },

        tampil(){
            this.$http.get('api/inbox/'+inbox.id)
                .then(response=>{
                    if (response.data === true){
                        let inboxIndex = _.findIndex(this.inboxs.data, t => inbox.id === t.id)
                        this.inboxs.data.splice(inboxIndex, 1)
                    }
                })
        },
        
        destroy(inbox) {
            this.$http.delete('api/inbox/' + inbox.id)
                .then(response => {
                    if (response.data === true){
                        let inboxIndex = _.findIndex(this.inboxs.data, t => inbox.id === t.id)
                        this.inboxs.data.splice(inboxIndex, 1)
                    }
                })
        },
        resetForm(form) {
            form = { ...this.forms.default }
        }
    }
});

