<template>
    <div class="container">





<div class="row">
  <div class="col-md-9 col-sm-12 col-xs-12">
    <div class="x_panel tile ">
      <div class="x_title">
        <h2>Nomination</h2>
        
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
        
        <!-- Question 2 -->
        <div class="form-group ">

            <label for="exampleFormControlTextarea1">2.    Describe the interaction of the employee with his/her co-workers. Please cite specific examples.</label>
            
            <textarea v-model="nomination.q2" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
            
        
        </div>
      
        <!-- Question 3 -->
        <div class="form-group ">

            <label for="exampleFormControlTextarea1">3.    Describe the interaction of the employee with guests. Please cite specific examples of the employee’s positive impact on the guest experience at your hotel.</label>
            
                <textarea v-model="nomination.q3" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
            
        
        </div>
      
        <!-- Question 4 -->
        <div class="form-group ">

            <label for="exampleFormControlTextarea1">4.    Please list any awards or recognition that the employee has received from the Hotel, management, guests, award organizations and/or peers.</label>
        
                <textarea v-model="nomination.q4" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
        
        </div>
   
        <!-- Question 5 -->
        <div class="form-group ">
        
                <label  for="exampleFormControlTextarea1">5.   Please list any other reasons for nominating this employee for the Big Apple Stars Awards.</label>
            
                    <textarea v-model="nomination.q5" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
                
        
        </div>
        <br/>
        <div >
                <button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="updateNomination">Save changes</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="deleteNomination">Delete</button>
            </div>
  
</form>
    
      </div>
    </div>
  </div>
        
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="x_panel tile fixed_height_320">
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
    </div>     
 </div>
</div>
    
</template>

<script>
    export default {
        data() {
            return {
              nomination:
                {
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
              
                }
        },
        

        // props: {
        //         data: {
        //                 type: Object
        //                     }
        //         },
        mounted() {
                var app = this;
                var url = purl(window.location.href)
                var uid=url.segment(-1)
                axios.get(`/api/v1/nominations/`+uid+`/edit`)
                    .then(function (resp) {
                        app.nomination = resp.data;
                    })
                    .catch(function (resp) {
                        console.log(resp);
                    });
            },
        methods: {
            updateNomination() {
                var app = this;
                var url = purl(window.location.href)
                var id = url.segment(-1)
                var newNomination = app.nomination;
                axios.post(`/api/v1/nominations/${id}`, newNomination)
                    .then(function (resp) {
                    })
                    .catch(function (resp) {
                        console.log(resp);
                    });
                 
            },
            deleteNomination() {
                var app = this;
                var url = purl(window.location.href)
                var id = url.segment(-1)
                axios.delete(`/api/v1/nominations/${id}`)
                .then(function (resp) {
                    console.log(resp.data);
                })
                .catch(function (resp) {
                    console.log(resp);
                });
               
            }
        }
    }
    </script>


