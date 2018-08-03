<template>
    

<div class="container">
  
 <div class="row">
  <div class="col-md-9 col-sm-12 col-xs-12">
    <div class="x_panel tile">
      <div class="x_title">
        <h2>Nominations</h2>
        
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
       <div v-if="nominations ==''">
            <!-- <h4>Start submitting your nominations</h4> -->
            <button >No Record</button>
        </div>
    <table class="table table-hover" v-else>
    <thead>
        <tr>
        <th scope="col"><h5><strong></strong></h5></th>
        <th scope="col"><h5><strong>Category</strong></h5></th>
        <th scope="col"><h5><strong>Name</strong></h5></th>
        <th scope="col"><h5><strong>Hotel</strong></h5></th>
        <th scope="col"><h5><strong>Submit Date</strong></h5></th>
        
        </tr>
    </thead>
    <tbody>
        <tr v-for="nomination in nominations" v-bind:key="nomination.id" >
        <td > <nomination-detail :data="nomination">  
</nomination-detail></td>
        <td ><h5>{{ nomination.category }}</h5></td>
        <td><h5>{{ nomination.name}}</h5></td>
        <td><h5>{{ nomination.company}}</h5></td>
        <td>{{ nomination.created_at}}</td>
        </tr>
    </tbody>
    </table>
      </div>
    </div>
  </div>
        
    <div class="col-md-3 col-sm-12 col-xs-12 profilePanel" >
      <div class="x_panel tile ">
        <div class="x_title">
          <h2>{{ profile.name }}</h2>
          
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <!-- <ul class="list-group">             
            <li class="list-group-item">{{ member.email }}</li>
            <li v-if="member.profile" class="list-group-item">{{ member.profile.company }}</li>
            <li v-if="member.profile" class="list-group-item">{{ member.profile.address }}</li>
            <li v-if="member.profile" class="list-group-item">{{ member.profile.title }}</li>
            <li v-if="member.profile" class="list-group-item">{{ member.profile.phone }}</li>
          </ul> -->

        
        </div>
      </div>

      
    </div> 






</div>
  </div> 
    
    
</template>

<script>
var _ = require('lodash');
    export default {
     data(){
            return{
                nominations: '',
                member:{
                    name:'',
                    company:'',
                },
                profile:{

                    },
                detail:'',
                role:''

            }
        },
    //  watch: {
    //     nominations: function (){
    //                     this.debouncedGetAnswer()
                        
    //                     }
                        

    //                 },
    created: function () {
    
    this.debouncedGetAnswer = _.debounce(this.getUpdate, 1500)
    },

    mounted() {
            var app = this;
            var url = purl(window.location.href)
            var uid=url.segment(-1)
            
            

            axios.get(`/api/v1/judge/`+uid)
                .then(function (resp) {
                    app.nominations = resp.data;
                    
                })
                .catch(function (resp) {
                    console.log(resp);
                    // alert("Could not load nominations");
                });

            axios.get(`/api/v1/judge/`)
                .then(function (resp) {
                    // console.log(resp.data[key])
                    app.profile = resp.data[uid]
                    
                })
                .catch(function (resp) {
                    console.log(resp);
                });
            
        },
    methods: {
            viewdetail(){
                this.detail =! this.detail
                // var id = event.currentTarget.value
                
            },
            getUpdate(){
                var app = this;
                var url = purl(window.location.href)
                var uid=url.segment(-1)
                axios.get(`/api/v1/member/`+uid)
                    .then(function (resp) {
                        app.nominations = resp.data.nomination;
                    })
            },
            
            

        }
    }
</script>
<style>
.fade-enter-active, .fade-leave-active {
  transition: opacity 1s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
