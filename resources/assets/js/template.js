
require('./bootstrap');


new Vue({

    el: '#data-template',

    data: {
        templates: [],
        pagination: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1
        },
        query:'',
        offset: 4,
        formErrors:{},
        formErrorsUpdate:{},
        newTemplate : {'title':'','message':''},
        fillTemplate : {'title':'','message':'','id':''},
        forms: {
            default: {
                title: '',
                message: '',
            },
            create: {
                title: '',
                message: '',
            },
            update: {
                title: '',
                message: '',
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
        this.loadTemplate()
    },

    methods : {

        loadTemplate(){
            let param = {
                limit:7
            }

            if (this.query.trim()){
                param.query=this.query
            }
            this.$http.get('/api/template',{
                params:param

            }).then(response=>{
                this.templates=response.data
            })
        },
                
        next(){
            this.$http.get(this.templates.next_page_url)
                .then(response=>{
                    this.templates=response.data
                })
        },
        prev(){
            this.$http.get(this.templates.prev_page_url)
                .then(response=>{
                    this.templates=response.data
                })
        },

        create(){
            $("#create-template").modal('show');
        },
        
        store() {
            this.$http.post('/api/template', this.forms.create)
                .then(response => {
                    this.loadTemplate();

                    this.forms.create  = { ...this.forms.default }

                    $("#create-template").modal('hide');
                })
        },
        
        edit(template) {
            this.forms.update = { ...template }
            $("#edit-template").modal('show');
        },

        update() {
            this.$http.patch('/api/template/' + this.forms.update.id, this.forms.update)
                .then(response => {
                    let templateIndex = _.findIndex(this.templates.data, template => template.id === response.id)
                    
                    this.templates.data.splice(templateIndex, 1, response.data)

                    $("#edit-template").modal('hide');
                    
                    this.resetForm(this.forms.update)
                })
        },

        destroy(template) {
            this.$http.delete('api/template/' + template.id)
                .then(response => {
                    if (response.data === true){
                        let templateIndex = _.findIndex(this.templates.data, t => template.id === t.id)
                        this.templates.data.splice(templateIndex, 1)
                    }
                })
        },
        resetForm(form) {
           form = { ...this.forms.default }
        }
    }
});

