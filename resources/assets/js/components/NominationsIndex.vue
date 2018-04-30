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
        <th scope="row">{{ nomination.category}}</th>
        <td>{{ nomination.name}}</td>
        <td>{{ nomination.created_at}}</td>
        <td><i class="fas fa-eye"></i>     <i class="fas fa-edit"></i>   <i class="fas fa-trash-alt"></i></td>
        </tr>
    </tbody>
    </table>
 
  
    
    </div>
    
</template>

<script>
    export default {
        data(){
            return{
                nominations: ''
            }
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
            
        }
    }
</script>
