/**
 * Created by ZARRA on 06/01/2017.
 */
require('./bootstrap');

import TemplatePicker from './components/TemplatePicker.vue'
import PendaftarPicker from './components/MatakuliahPendaftarPicker.vue'
import VuePaginator from 'vuejs-paginator'

new Vue({
    el: '#scheduled',
    data: {
        schedules: [],
        group: {},
        query: '',
        pilih: [],
        selected: [],
        form: {
            pendaftar: [],
            message: '',
            datetime: window.datetime
        },
        selected_group: null,
        forms: {
            default: {
                reciver_id: '',
                message: '',
                datetime: '',
                status: ''
            },
            show: {
                reciver_id: '',
                message: '',
                datetime: '',
                status: ''
            }
        }
    },

    mounted(){
        this.loadScheduled()
        window.renderDateTimePicker()
    },

    computed: {
        names(){
            if (!this.selected_group) {
                return ""
            }
            return ` ${this.selected_group.matakuliah.name}  ${this.selected_group.period.year} - ${this.selected_group.period.semester}`
        },
        form_group(){
            if (!this.selected_group) {
                return {}
            }
            return {
                'matakuliah': this.selected_group.matakuliah.id,
                'period': this.selected_group.period.id,
                'message': this.form.message,
                'datetime': this.form.datetime.value
            }
        }
    },

    watch: {
        pilih: function (newval, oldval) {
            this.form.pendaftar = newval.map(val=>val.id)
        }
    },

    components: {
        TemplatePicker,
        PendaftarPicker
    },

    methods: {
        loadScheduled(){
            let param = {
                limit:10
            }
            if (this.query.trim()) {
                param.query = this.query
            }
            this.$http.get('/api/scheduled', {
                params: param
                
            }).then(response=> {
                this.schedules = response.data
            })
        },

        next(){
            this.$http.get(this.schedules.next_page_url)
                .then(response=> {
                    this.schedules = response.data
                })
        },
        prev(){
            this.$http.get(this.schedules.prev_page_url)
                .then(response=> {
                    this.schedules = response.data
                })
        },
        ischecked(user){
            return this.pilih.indexOf(user) == 1
        },

        select(template){
            this.selected = template
        },

        detail(schedule) {
            this.forms.show = { ...schedule }
            $("#modal-read").modal('show');
        },

        store() {
            this.$http.post('/api/scheduled', this.forms.create)
                .then(response => {
                    this.loadScheduled();
                    this.forms.create = {...this.forms.default}
                })
        },
        destroy(schedule) {
            this.$http.delete('api/scheduled/' + schedule.id)
                .then(response => {
                    if (response.data === true){
                        let scheduleIndex = _.findIndex(this.schedules.data, t => schedule.id === t.id)
                        this.schedules.data.splice(scheduleIndex, 1)
                    }
                })
        },
        
        sendMessage(){
            if (!this.selected_group) {
                return
            }
            this.$http.post('sendSchedule', this.form_group)
                .then(response => {
                    console.log(response.data)
                })
        }
    }
})