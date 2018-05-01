<template>
    <div class="container">
        <div v-if="nominations ==''">
            <h4>Start submitting your nominations</h4>
            <router-link to="/nominations/add"><button class="btn btn-primary">Start</button></router-link>
        </div>
    <table class="table table-hover" v-else>
    <thead>
        <tr>
        <th scope="col">Category</th>
        <th scope="col">Name</th>
        <th scope="col">Submit Date</th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="nomination in nominations" v-bind:key="nomination.id" >
        <th scope="row">{{ nomination.category }}</th>
        <td>{{ nomination.name}}</td>
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
                nominations: ''
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
            
        },
        methods: {
            
        }
    }
</script>
