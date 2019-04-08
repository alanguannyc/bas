<template>
    <div class="container">
        <div class="col-lg-12 col-md-12" v-if="nominations ==''">
              <div class="card">
                  <div class="card-header card-header-tabs card-header-primary">
                      <div class="nav-tabs-navigation">
                          <div class="nav-tabs-wrapper">
                              <h3 class="nav-tabs-title"><i class="material-icons">content_paste</i>Nominations</h3>
                          </div>
                      </div>
                  </div>
                  <div class="card-body">
                      <div class="tab-content">
                          <h4>No Previous Records</h4>
                      </div>
                  </div>
              </div>
          </div>
        

         <div class="col-lg-12 col-md-12" v-else v-for="data in nominations" v-bind:key="data.id">
              <div class="card">
                  <div class="card-header card-header-tabs card-header-primary">
                      <div class="nav-tabs-navigation">
                          <div class="nav-tabs-wrapper">
                              <h3 class="nav-tabs-title"><i class="material-icons">history</i>{{data.date}}</h3>
                          </div>
                      </div>
                  </div>
                  <div class="card-body">
                      <div class="tab-content">
                          <table class="table table-hover" >
                            <thead>
                                <tr>
                                <th scope="col"><h5><strong>Category</strong></h5></th>
                                <th scope="col"><h5><strong>Name</strong></h5></th>
                                <th scope="col"><h5><strong>Submit Date</strong></h5></th>
                                <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="nomination in data.nominations" v-bind:key="nomination.id" >
                                <th scope="row"><h5>{{ nomination.category }}</h5></th>
                                <td><h5>{{ nomination.name}}</h5></td>
                                <td>{{ nomination.created_at}}</td>
                                <td>
                                    <vue-modal :data="nomination" ></vue-modal>
                                </td>
                                </tr>
                            </tbody>
                            </table>
                      </div>
                  </div>
              </div>
          </div> 
        
    
    </div>
    
</template>

<script>
import VueModal from './VueModal.vue'
    export default {
        data(){
            return{
                nominations: [
                    
                ]
            }
        },

        // props: ['nominations'],
        // watch: {
        //         'nominations': {
        //             handler: function (newData, oldData){
        //              var app = this;
        //     axios.get('/api/v1/nominations')
        //         .then(function (resp) {
        //             app.data = resp.data;

        //         })
                
        //         .catch(function (resp) {
        //             console.log(resp);
        //             // alert("Could not load nominations");
        //         });
        //         deep: true
        //             }
                    
        //             }
                    
        //             },
        components:{
            'vue-modal':VueModal
        },
        mounted() {
            var app = this;
            axios.get('/api/v1/history')
                .then(function (resp) {
                    app.nominations = resp.data;
                    
                    const arrayReverseObj = (obj) => {
                        let newArray = []

                        Object.keys(obj)
                            .sort()
                            .reverse()
                            .forEach(key => {
                            newArray.push( {
                            'date':key, 
                            'nominations':obj[key]
                            })
                            })
                        return newArray  
                        }
                    app.nominations = arrayReverseObj(resp.data)


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
