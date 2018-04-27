<template>
    <div class="container">

    <div class="accordion" id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          {{ nominations.category}}
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
          <h4>{{ nominations.name }}</h4>
          <p>
              {{ nominations.q1}}
          </p>
    </div>
    </div>
  </div>
 
  
    
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
                    alert("Could not load nominations");
                });
        },
    }
</script>
