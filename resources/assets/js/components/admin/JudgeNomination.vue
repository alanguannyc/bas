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
        <th scope="col"><h5><strong>Change</strong></h5></th>
        <th scope="col"><h5><strong>Status</strong></h5></th>
        
        </tr>
    </thead>
    <tbody>
        <tr v-for="nomination in nominations" v-bind:key="nomination.id" >
        <td > <nomination-detail :data="nomination">  
</nomination-detail></td>
        <td ><h5>{{ nomination.category }}</h5></td>
        <td><h5>{{ nomination.name}}</h5></td>
        <td><h5>{{ nomination.user.profile.company}}</h5></td>
        <td><select-judge  :data="nomination" @updateJudge="updateJudge"></select-judge></td>
        <td v-if="nomination.completed" class="p-1">
            <div class="alert alert-success p-1" role="alert">
            COMPLETED
            </div>
        </td>
            <td v-else ><div class="alert alert-danger" role="alert">
                <p >NOT</p>
            
            </div>
        </td>
        </tr>
    </tbody>
    </table>
      </div>
    </div>
  </div>
     <div >
  <button class="btn btn-default pull-left" :disabled="firstPage == true" v-on:click.prevent="previousPage()">Previous</button>
  <button class="btn btn-default pull-right" :disabled="lastPage == true" v-on:click.prevent="nextPage()">Next</button>
</div>      
    <div class="col-md-3 col-sm-12 col-xs-12 profilePanel" >
      <div class="x_panel tile ">
        <div class="x_title">
          <h2>{{ judge.name }}</h2>
          
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <ul class="list-group">             
            <li class="list-group-item">{{ judge.email }}</li>
            <li v-if="profile" class="list-group-item">{{ profile.company }}</li>
            <li v-if="profile" class="list-group-item">{{ profile.title }}</li>
          </ul>

        
        </div>
      </div>

      
    </div> 






</div>
  </div> 
    
    
</template>

<script>
var _ = require('lodash');
import NominationDetail from './NominationDetail.vue'
    export default {
     data(){
            return{
                pageIndex:'',
                totalRecord:'',
                nominations: '',
                profile:'',
                detail:'',
                role:'',
                totalJudges:[],
                judge:'',


            }
        },
        computed: {
            firstPage: function () {
                if (this.pageIndex == 0) {
                        return true
                    } 
                return false
                    
            },
            lastPage: function () {
                if (this.pageIndex == this.totalRecord - 1) {
                        return true
                    } 
                return false
                

                
            }
        },
    //  watch: {
    //     nominations: function (){
    //                     this.debouncedGetAnswer()
                        
    //                     }
                        

    //                 },
    components: {
        "nomination-detail":NominationDetail
    },
    created: function () {
    
    this.debouncedGetAnswer = _.debounce(this.getUpdate, 1500)
    },
    beforeMount() {
        var app = this;
            var url = purl(window.location.href)
            var uid=url.segment(-1)
        
    },
    mounted() {
            var app = this;
            var url = purl(window.location.href)
            var uid=url.segment(-1)
            
            

            axios.get(`/api/v1/judge/`+uid)
                .then(function (resp) {
                    app.nominations = resp.data.nominations;
                    app.judge = resp.data
                    app.profile = resp.data.profile


                    app.nominations.map(nomination=>{
                        var completed = true
                        for (var i=1;i<6;i++){
                            
                            if (!nomination.score || nomination.score['q'+i] == null) {
                                completed = false
                            }
                        }
                        nomination['completed'] = completed
                    })
                    
                })
                .catch(function (resp) {
                    console.log(resp);
                    // alert("Could not load nominations");
                });
            axios.get(`/api/v1/judge/`)
                .then(function (resp) {
                  
                    var id = parseInt(url.segment(-1))
                    app.totalRecord = resp.data.length
                    app.totalJudges = resp.data
                    app.pageIndex = app.totalJudges.map(function(x) {return x.id; }).indexOf(id);
                    


                    if (uid == resp.data.length) {
                        app.pageIndex = 0;
                    }
                    
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
                var uid = url.segment(-1)
                axios.get(`/api/v1/member/`+uid)
                    .then(function (resp) {
                        app.nominations = resp.data.nomination;
                    })
            },
            nextPage() {
                var app = this
                var url = purl(window.location.href)
                var id = parseInt(url.segment(-1))
                var elementPos = app.totalJudges.map(function(x) {return x.id; }).indexOf(id);
                var objectFound = app.totalJudges[app.pageIndex];
                var uid= app.totalJudges[app.pageIndex + 1].id 

                window.location.href = uid

                
                
            },
            previousPage() {
                var app = this
                var url = purl(window.location.href)
                var id = parseInt(url.segment(-1))
                
                var elementPos = app.totalJudges.map(function(x) {return x.id; }).indexOf(id);
                var objectFound = app.totalJudges[app.pageIndex];
                var uid= app.totalJudges[app.pageIndex - 1].id 
                window.location.href = uid

                
            },
        
            updateJudge(variable) {

                var app = this;
                var url = purl(window.location.href)
                var uid=url.segment(-1)

                axios.get(`/api/v1/judge/`+uid)
                .then(function (resp) {
                    app.nominations = resp.data.nominations;
                    
                })
          },

        }
    }
</script>
<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 1s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

.alert {
    font-size: 90%;
  margin:auto;
  height: 30px;
  line-height:30px;
  padding:0px 5px;
  text-align: center;
}
</style>
