<template>
    <div class="container">

    <table class="table table-hover">
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
            updateNomination() {
            var app = this;
            var id = app.data.id;
            var newNomination = app.nomination;
            axios.post(`/api/v1/nominations/${id}`, newNomination)
                .then(function (resp) {
                })
                .catch(function (resp) {
                    console.log(resp);
                });
            }
        }
    }
</script>
