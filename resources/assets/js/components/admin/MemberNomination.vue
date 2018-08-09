<template>
    

<div class="container">
  
 <div class="row">
  <div class="col-md-9 col-sm-12 col-xs-12">
    <div class="x_panel tile ">
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
        <th scope="col"><h5><strong>Submit Date</strong></h5></th>
        
        </tr>
    </thead>
    <tbody>
        <tr v-for="nomination in nominations" v-bind:key="nomination.id" >
        <td > <nomination-detail :data="nomination">  
</nomination-detail></td>
        <td ><h5>{{ nomination.category }}</h5></td>
        <td><h5>{{ nomination.name}}</h5></td>
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
          <h2>{{ member.name }}</h2>
          
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <ul class="list-group">             
            <li v-if="member" class="list-group-item">{{ member.email }}</li>
            <li v-if="member.profile" class="list-group-item">{{ member.profile.company }}</li>
            <li v-if="member.profile" class="list-group-item">{{ member.profile.address }}</li>
            <li v-if="member.profile" class="list-group-item">{{ member.profile.title }}</li>
            <li v-if="member.profile" class="list-group-item">{{ member.profile.phone }}</li>
          </ul>

        <button class="btn btn-primary" v-on:click="updateProfile()">Update</button>
        
        </div>
      </div>

      
    </div> 

<div class="col-md-3 col-sm-12 col-xs-12 updatePanel " style="display:none" >
      <div class="x_panel tile ">
        <div class="x_title">
          
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
        
        <form autocomplete="off">
            <div class="form-group"> 
            <input type="text" class="form-control"   v-model="member.name" placeholder="name" autocomplete="nope">
            </div>
            <div class="form-group"> 
            <input type="text" class="form-control"  v-model="member.email" placeholder="email">
            </div>
            <div class="form-group"> 
            <input type="text" class="form-control"  v-model="member.password" placeholder="password">
            </div>
            <div class="form-group"> 
            <input  type="text" class="form-control"  v-model="profile.company" placeholder="company">
            </div>
            <div class="form-group"> 
            <input  type="text" class="form-control" v-model="profile.address" placeholder="address">
            </div>
            <div class="form-group"> 
            <input  type="text" class="form-control"  v-model="profile.title" placeholder="title">
            </div>
            <div class="form-group"> 
            <input  type="phone" class="form-control"  v-model="profile.phone" placeholder="phone">
            </div>
            <div class="form-group"> 
            <select class="form-control"  v-model="role.name">
                <option>member</option>
                <option>judge</option>
                <option>admin</option>
                </select>
                </div>
            <button class="btn " v-on:click="cancelUpdate()">Cancel</button>
            <button class="btn btn-primary" v-on:click="saveProfile()">SAVE</button>
        </form>
          
        </div>
      </div>
    </div> 

<transition name="fade">
      <div class="row" v-show="detail">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel tile ">
      <div class="x_title">
        <h2>Notification and instruction</h2>
        
        <div class="clearfix"></div>
      </div>
      <div class="x_content" >
        
            
            </div>
        </div>
        </div>
    </div>
</transition>


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
                    email:'',
                    company:'',
                    password:'',
                },
                profile:{

                    },
                detail:'',
                role:''

            }
        },
     watch: {
        nominations: function (){
                        this.debouncedGetAnswer()
                        
                        }
                        

                    },
    created: function () {
    
    this.debouncedGetAnswer = _.debounce(this.getUpdate, 1500)
    },

    mounted() {
            var app = this;
            var url = purl(window.location.href)
            var $uid=url.segment(-1)
            
            

            axios.get(`/api/v1/member/`+$uid)
                .then(function (resp) {
                   
                    
                    if (resp.data.nomination){
                        app.nominations = resp.data.nomination;

                    }
                    
                    if(resp.data.member) {
                        app.member = resp.data.member

                    }
                    
                    if (resp.data.member.profile) {
                        app.profile = resp.data.member.profile;
                    }
                    
                    if (resp.data.member.roles[0]) {
                        app.role = resp.data.member.roles[0];
                    }
                    
                    
                    
                })
                .catch(function (resp) {
                    console.log(resp);
                    // alert("Could not load nominations");
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
            updateProfile(){
                $('.profilePanel').hide();
                $('.updatePanel').show();
            },
            cancelUpdate(){
                 event.preventDefault();
                $('.profilePanel').show();
                $('.updatePanel').hide();
            },
            saveProfile(){
                 event.preventDefault();
                var app = this;
                var url = purl(window.location.href)
                var uid=url.segment(-1)
                
                var newMember = {
                    name : app.member.name,
                    email: app.member.email,
                    password: app.member.password,
                    role: app.role.name
                    }
                var newProfile = app.profile
                
                axios.post(`/api/v1/member/`+uid, newMember)
                    .then(function (resp) {
                        //alert success
                        axios.post(`/api/v1/profile/`+uid, newProfile)
                        .then(function (resp) {
                            //alert success
                            axios.patch(`/api/v1/role/`+uid, newMember )
                            .then(function (resp) {
                            //alert success
                            $('.profilePanel').show();
                            $('.updatePanel').hide();
                        })
                        })
                    })
            }

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
