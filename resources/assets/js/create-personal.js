/**
 * Created by ZARRA on 06/01/2017.
 */
require('./bootstrap');
import TemplatePicker from './components/TemplatePicker.vue'


new Vue({
    el: '#create-personal',
    data: {
        pendaftar:{},
        query:'',
        pilih:[],
        selected:{},
        form:{
            pendaftar:[],
            message:''
        }
    },

    mounted(){
        this.loadPendaftar()
    },
    
    watch:{
      pilih:function (newval,oldval) {
          this.form.pendaftar=newval.map(val=>val.id)
      }
    },
    
    computed: {
        names(){
            return this.pilih.map(user=>{
                return user.name
            })
        }
    },
    
    components:{
       TemplatePicker
    },
    
    methods:{
        loadPendaftar(){
            let param = {
                limit:7
            }

            if (this.query.trim()){
                param.query=this.query
            }
            this.$http.get('/api/pendaftar',{
                params:param

            }).then(response=>{
                this.pendaftar=response.data
            })
        },
        next(){
            this.$http.get(this.pendaftar.next_page_url)
                .then(response=>{
                    this.pendaftar=response.data
                })
        },
        prev(){
            this.$http.get(this.pendaftar.prev_page_url)
                .then(response=>{
                    this.pendaftar=response.data
                })
        },
        ischecked(user){
            return this.pilih.indexOf(user)>-1
        },

        select(template){
            this.selected=template
        },
        sendMessage(){
            this.$http.post('send',this.form)
                .then (response => {
                    console.log(response.data)
                })
        }
    }
})