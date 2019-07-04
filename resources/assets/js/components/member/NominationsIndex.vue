<template>
    <div class="container">
        <div v-if="nominations =='' & setting.application_on ">
            <h4>Start submitting your nominations</h4>
            <button class="btn btn-primary add" :disabled="!setting.application_on">Start</button>


        </div>
    <table class="table table-hover" v-else>
    <thead>
        <tr>
        <th scope="col"><h5><strong>Category</strong></h5></th>
        <th scope="col"><h5><strong>Name</strong></h5></th>
        <th scope="col"><h5><strong>Submit Date</strong></h5></th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="nomination in nominations" v-bind:key="nomination.id" >
        <th scope="row"><h5>{{ nomination.category }}</h5></th>
        <td><h5>{{ nomination.name}}</h5></td>
        <td>{{ nomination.created_at}}</td>
        <td>
                <vue-modal :data="nomination" >  
                </vue-modal>
                <!-- <component :is="modal" :data="nomination"></component> -->
        </td>
        </tr>
    </tbody>
    </table>
    </div>
    
</template>

<script>
import VueModal from './VueModal.vue'

    export default {
        data(){
            return{
                nominations: '',
                setting:{
                    application_on:''
                },
            }
        },

        // props: ['nominations'],
        watch: {
                'setting': {
                    handler: function (newData, oldData){
                    var app = this;
                    axios.get('/api/v1/setting')
                    .then(function (resp) {
                        app.setting = resp.data;

                    })
                    .catch(function (resp) {
                        console.log(resp);
                        // alert("Could not load nominations");
                    });
                        deep: true
                    }
                },
                'nominations': {
                    handler: function (newData, oldData){
                    var app = this;
                    axios.get('/api/v1/nominations')
                    .then(function (resp) {
                        app.nominations = resp.data;
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        // alert("Could not load nominations");
                    });
                        deep: true
                    }
                    
                    }
                    
                    },
        components:{
            'vue-modal':VueModal
        },
        mounted() {

            
            var app = this;
            axios.get('/api/v1/nominations')
                .then(function (resp) {
                    app.nominations = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    // alert("Could not load nominations");
                });
            
            axios.get('/api/v1/setting')
                .then(function (resp) {
                    app.setting = resp.data;

                })
                .catch(function (resp) {
                    console.log(resp);
                    // alert("Could not load nominations");
                });
        },
        methods: {
            
        }
    }
</script>
