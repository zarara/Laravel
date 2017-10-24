/**
 * Created by ZARRA on 06/01/2017.
 */
require('./bootstrap');

import TemplatePicker from './components/TemplatePicker.vue'
import PendaftarPicker from './components/MatakuliahPendaftarPicker.vue'


new Vue({
    el: '#create-group',
    data: {
        group: {},
        query: '',
        pilih: [],
        selected: [],
        selected_group:null,
        form: {
            pendaftar:[],
            message: ''
        }
    },

    mounted(){
        // this.loadGroup(),
            this.loadPendaftar()
    },

    watch: {
        pilih: function (newval, oldval) {
            this.form.pendaftar = newval.map(val=>val.id)
        }
    },

    computed: {
        names(){
            if(!this.selected_group) {
                return ""
            }
            return ` ${this.selected_group.matakuliah.name}  ${this.selected_group.period.year} - ${this.selected_group.period.semester}`
        },
        form_group(){
            if(!this.selected_group) {
                return {}
            }
            return {
                'matakuliah':this.selected_group.matakuliah.id,
                'period':this.selected_group.period.id,
                'message':this.form.message
            }
        }
    },

    components: {
        TemplatePicker,
        PendaftarPicker
    },

    methods: {
        loadPendaftar(){
            let param = {
                limit: 7
            }

            if (this.query.trim()) {
                param.query = this.query
            }
            this.$http.get('/api/group', {
                params: param

            }).then(response=> {
                this.group = response.data
            })
        },
        
        next(){
            this.$http.get(this.group.next_page_url)
                .then(response=> {
                    this.group = response.data
                })
        },
        prev(){
            this.$http.get(this.group.prev_page_url)
                .then(response=> {
                    this.group = response.data
                })
        },
        
        ischecked(user){
            return this.pilih.indexOf(user) == 1
        },

        select(template){
            this.selected = template
        },
        sendMessage(){
            if(!this.selected_group) {
                return
            }
            this.$http.post('sendGroup', this.form_group)
                .then(response => {
                    console.log(response.data)
                })
        }
    }
})