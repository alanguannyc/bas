<template>
    <div class="container">





<div class="row">
  <div class="col-md-9 col-sm-12 col-xs-12">
    <div class="x_panel tile ">
      <div class="x_title">
          <p>#{{nomination.id}}</p>
        <h2>Nomination</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li>        <h5 >Total Score: {{ Number(score.q5) + Number(score.q4) + Number(score.q3) + Number(score.q2) + Number(score.q1) }}</h5>
          </li>

        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
       
    <form >
    <div class="form-group">
    <label for="exampleFormControlSelect1">Category</label>
    <select class="form-control" id="exampleFormControlSelect1" v-model="nomination.category">
      <option>Full-Time Hourly With Guest Contact</option>
      <option>Full-Time Hourly Without Guest Contact</option>
      <option>Full-Time Room Attendant</option>
      <option>Managerial Below General Manager</option>
    </select>
  </div>

    <div class="form-group ">
              
    <label> Name</label>
    <input v-model="nomination.name" type="text" class="form-control" placeholder="Name" >
        
    </div>
<div class="form-group ">
              
    <label> Title</label>
    <input v-model="nomination.title" type="text" class="form-control" placeholder="title" >
        
    </div>
    <!-- Question 1 -->
        <div class="form-group ">


            <label  for="exampleFormControlTextarea1">1.  Describe the employee’s overall job performance and dedication to his/her profession and to your Hotel.  Please be specific and cite at least one example.</label>
            
            <textarea v-model="nomination.q1" class="form-control textarea"  id="exampleFormControlTextarea1" rows="3"></textarea>
            

        </div>
        <div >
            <span style="display: inline-block;"><h5>Score:</h5></span>
            <span style="display: inline-block;" v-if="score.q1"><h5 >{{ score.q1 }}</h5></span>
        </div>
        <br>
        <!-- Question 2 -->
        <div class="form-group ">

            <label for="exampleFormControlTextarea1">2.    Describe the interaction of the employee with his/her co-workers. Please cite specific examples.</label>
            
            <textarea v-model="nomination.q2" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
            
        
        </div>
      <div >
            <span style="display: inline-block;"><h5>Score:</h5></span>
            <span style="display: inline-block;" v-if="score.q2"><h5 >{{ score.q2 }}</h5></span>
        </div>
        <br>
        <!-- Question 3 -->
        <div class="form-group ">

            <label for="exampleFormControlTextarea1">3.    Describe the interaction of the employee with guests. Please cite specific examples of the employee’s positive impact on the guest experience at your hotel.</label>
            
                <textarea v-model="nomination.q3" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
            
        
        </div>
      <div >
            <span style="display: inline-block;"><h5>Score:</h5></span>
            <span style="display: inline-block;" v-if="score.q3"><h5 >{{ score.q3 }}</h5></span>
        </div>
        <br>
        <!-- Question 4 -->
        <div class="form-group ">

            <label for="exampleFormControlTextarea1">4.    Please list any awards or recognition that the employee has received from the Hotel, management, guests, award organizations and/or peers.</label>
        
                <textarea v-model="nomination.q4" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
        
        </div>
   <div >
            <span style="display: inline-block;"><h5>Score:</h5></span>
            <span style="display: inline-block;" v-if="score.q4"><h5 >{{ score.q4 }}</h5></span>
        </div>
        <br>
        <!-- Question 5 -->
        <div class="form-group ">
        
                <label  for="exampleFormControlTextarea1">5.   Please list any other reasons for nominating this employee for the Big Apple Stars Awards.</label>
            
                    <textarea v-model="nomination.q5" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
                
        
        </div>
        <div >
            <span style="display: inline-block;"><h5>Score:</h5></span>
            <span style="display: inline-block;" v-if="score.q5"><h5 >{{ score.q5 }}</h5></span>
        </div>
        <br>
        <br/>
        <div >
                <button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="updateNomination">Save changes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="deleteNomination">Delete</button>
            </div>
  
</form>
    <div >
  <button class="btn btn-default pull-left" :disabled="firstPage == true" v-on:click.prevent="previousPage()">Previous</button>
  <button class="btn btn-default pull-right" :disabled="lastPage == true" v-on:click.prevent="nextPage()">Next</button>
</div>
      </div>
    </div>
  </div>
        
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="x_panel tile">
        <div class="x_title">
          <h2>Nominated By</h2>
          
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            
            <a :href="'/admin/member/'+nomination.user.id"><h4>{{ nomination.user.name }}</h4></a>
          <ul class="list-group" >
                      
            <li class="list-group-item">{{ nomination.user.email }}</li>
            <li v-if="nomination.user.profile" class="list-group-item">{{ nomination.user.profile.company }}</li>
            <li v-if="nomination.user.profile" class="list-group-item">{{ nomination.user.profile.address }}</li>
            <li v-if="nomination.user.profile" class="list-group-item">{{ nomination.user.profile.title }}</li>
            <li v-if="nomination.user.profile" class="list-group-item">{{ nomination.user.profile.phone }}</li>

          </ul>
  
        </div>
      </div>

      <div class="x_panel tile fixed_height_320">
        <div class="x_title">
          <h2>Judged By</h2>
          
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            
            <!-- <a :href="'/admin/member/'+nomination.user.id"><h4>{{ nomination.user.name }}</h4></a> -->
          <ul class="list-group" v-if="judge">
             <li class="list-group-item">{{ judge.name }}</li>      
             <li class="list-group-item">{{ judge.profile.company }}</li>      
            <li class="list-group-item">{{ judge.email }}</li>
            

          </ul>
          <div >
            
            <select-judge  :data="nomination" @updateJudge="updateJudge"></select-judge>
            <button v-if="judge" type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="deleteFromJudge">Remove From This Judge</button>
          </div>
  
        </div>
      </div>
    </div>     
 </div>
</div>
    
</template>

<script>
    import { showSucess } from '../../admin.js'

    // import SelectJudge from './SelectJudge.vue'

    export default {
        data() {
            return {
              nomination:
                {
                  id:'',
                  category:'',
                  title:'',
                  name:'',
                  q1:'',
                  q2:'',
                  q3:'',
                  q4:'',
                  q5:'',
                  user:''
                  },

                  score:'',
                  judge:'',
                  pageIndex:'',
                  totalRecord:'',
                  
              
                }
        },
        
        computed: {
            lastPage: function () {
                
                if (this.pageIndex == 0) {
                        return true
                    } 
                return false
                    
            },
            firstPage: function () {
                if (this.pageIndex == this.totalRecord - 1) {
                        return true
                    } 
                return false
            }
        },

        // props: {
        //         data: {
        //                 type: Object
        //                     }
        //         },
        components: {

        // "select-judge" : SelectJudge
    },  
    watch:{
      judge: function(val){

        _.debounce(this.updateJudge, 500)
      }, 
      deep: true
    },
        mounted() {
            
                var app = this;
                var url = purl(window.location.href)
                var uid = url.segment(-1)
              
                var key = Math.floor(uid/10)
                
                var id = parseInt(url.segment(-1))
                
                axios.get(`/api/v1/member/nominations/`)
                .then(function (resp) {
                app.totalRecord = resp.data.length
                // app.judge = resp.data.judge

                app.pageIndex = resp.data.findIndex(function(e) {
                                return e.id == id;
                                })
                                
                })

                axios.get(`/api/v1/nominations/`+uid+`/edit`)
                    .then(function (resp) {
                        app.nomination = resp.data;

                        app.judge = resp.data.judge

                        if (resp.data.score) {
                            app.score = resp.data.score
                        }

                        
                    })
                    .catch(function (resp) {
                        console.log(resp);
                    });
                
                axios.get(`/api/v1/nominations/`+uid+`/edit`)
                    .then(function (resp) {
                        app.nomination = resp.data;
                        app.judge = resp.data.judge
                        if (resp.data.score) {
                            app.score = resp.data.score
                        }

                        
                    })
                    .catch(function (resp) {
                        console.log(resp);
                    });

                // axios.get(`/api/v1/judge/`)
                //     .then(function (resp) {
                //         // console.log(resp.data[key])
                //         if( resp.data[key]) {
                //             app.judge = resp.data[key]
                //         }
                        
                        
                //     })
                //     .catch(function (resp) {
                //         console.log(resp);
                //     })
        
        },
        methods: {
            updateNomination() {
                var app = this;
                var url = purl(window.location.href)
                var id = url.segment(-1)
                var newNomination = app.nomination;
                axios.post(`/api/v1/nominations/${id}`, newNomination)
                    .then(function (resp) {
                        showSucess('The nomination has been udpated.')
                    })
                    .catch(function (resp) {
                        console.log(resp);
                    });
            },
            deleteNomination() {
                var app = this;
                var url = purl(window.location.href)
                var id = url.segment(-1)
                if (confirm("Are you sure?")) {
                axios.delete(`/api/v1/nominations/${id}`)
                                .then(function (resp) {
                                    console.log(resp.data);
                                })
                                .catch(function (resp) {
                                    console.log(resp);
                                });
                }
                
               
            },
            nextPage() {
                
                var url = purl(window.location.href)
                var id = parseInt(url.segment(-1))
                var uid= parseInt(url.segment(-1)) + 1
                axios.get(`/api/v1/member/nominations/`)
                .then(function (resp) {
                   var index = resp.data.findIndex(function(e) {
                                return e.id == id;
                                })
                    if (index == resp.data.length) {
                        this.lastPage = true
                    }
                   
                    var index = index - 1
                    var uid = resp.data[index].id
                    
                    window.location.href = uid
                })
                
                
            },
            previousPage() {
                var url = purl(window.location.href)
                var id = parseInt(url.segment(-1))
                axios.get(`/api/v1/member/nominations/`)
                .then(function (resp) {
                   var index = resp.data.findIndex(function(e) {
                                return e.id == id;
                                })
                    if (index == resp.data.length) {
                        this.lastPage = true
                    }
                   
                    var index = index + 1
                    var uid = resp.data[index].id
                    
                    window.location.href = uid
                })
            },
          deleteFromJudge() {
            var app = this
            var url = purl(window.location.href)
                var id = parseInt(url.segment(-1))
              if (confirm("Are you sure?")) {
                axios.post(`/api/v1/nominations/${id}/judge`)
                                .then(function (resp) {
                                  app.judge = null
                                    
                    
                                })
                                .catch(function (resp) {
                                    console.log(resp);
                                });
                }
          }, 
          updateJudge(variable) {

              var app = this
              axios.get(`/api/v1/nominations/`+variable.id+`/edit`)
                    .then(function (resp) {

                        app.judge = resp.data.judge
 

                        
                    })
          },
          
        }
    }
    </script>


