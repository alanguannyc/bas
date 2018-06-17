<template>
    

<div class="container">
  
 <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel tile">
      <div class="x_title">
        <h2>Nominations</h2>
        
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
       
    <table class="table table-hover">
    <thead>
        <tr>
        <th scope="col"><h5><strong></strong></h5></th>
        <th scope="col"><h5><strong>Name</strong></h5></th>
        <th scope="col"><h5><strong>Email</strong></h5></th>
        <th scope="col"><h5><strong>Company</strong></h5></th>
        <th scope="col"><h5><strong>Role</strong></h5></th>
        <th scope="col"><h5><strong>Submit Date</strong></h5></th>
        <th></th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="user in users" v-bind:key="user.id" >
        <td > </td>
        <td ><h5>{{ user.name }}</h5></td>
        <td><h5>{{ user.email}}</h5></td>
        <td><h5>{{ user.profile.company }}</h5></td> 
        <td id="profilePanel" ><h5>{{ user.roles[0].name }}</h5></td> 
        <td id="updatePanel" style="display:none" >
             <form>
                 <div class="form-group"> 
                <input  type="phone" class="form-control"  v-model="role" >
                </div>
                <button class="btn " v-on:click="cancelUpdate()">Cancel</button>
                <button class="btn btn-primary" v-on:click="saveProfile()">SAVE</button>
            </form>
        </td> 
        <td>{{ user.created_at}}</td>
        <td><button v-on:click="updateProfile()" class="btn btn-primary">Edit</button></td>
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



var _ = require('lodash');
    export default {
     data(){
            return{
                
                users:'',
                profile:'not set',
                role:{
                    name:"admin"
                    },
                
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
            
            

            axios.get(`/api/v1/user/`)
                .then(function (resp) {
                                   
                    app.users = resp.data;
                    // app.profile = resp.data.profile;
                    app.role = resp.data.roles;
                   
                })
                .catch(function (resp) {
                    console.log(resp);
                    // alert("Could not load nominations");
                });
            
        },
    methods: {
            getUpdate(){
                var app = this;
                var url = purl(window.location.href)
                var uid=url.segment(-1)
                axios.get(`/api/v1/member/`)
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
                    email: app.member.email
                    }
                var newProfile = app.profile
                
                axios.post(`/api/v1/member/`+uid, newMember)
                    .then(function (resp) {
                        //alert success
                        axios.post(`/api/v1/profile/`+uid, newProfile)
                        .then(function (resp) {
                            //alert success
                            $('.profilePanel').show();
                            $('.updatePanel').hide();
                        })
                    })
            }

        }
    }
</script>
