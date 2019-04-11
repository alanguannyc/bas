<template>
    <div class="container" >

     <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" :data-target="'#' + data.id" >
  view
</button>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" :id="data.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">
            <!-- <slot name="title">
            I'm the default title!
          </slot> -->
        {{ data.category }}
         <h5 >Total Score: {{ score.q5 + score.q4 + score.q3 + score.q2 + score.q1 }}</h5>
        
          
          </h5>
          
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <slot name="body">
            I'm the default body!
          </slot> -->

<form >
    <div class="form-group ">
        <div class="col-md-6 ">
        
        <label> Name</label>
        <input v-model="nomination.name" type="text" class="form-control" placeholder="Name" required>
        
        </div>
        <div class="col-md-6 ">
            
            <label> Title</label>
            <input v-model="nomination.title" type="text" class="form-control" placeholder="title" required>
            
        </div>
    </div>
<!-- Question 1 -->
<div class="form-group">

    <label  for="exampleFormControlTextarea1">1.  Describe the employee’s overall job performance and dedication to his/her profession and to your Hotel.  Please be specific and cite at least one example.</label>
    
    <textarea  v-model="nomination.q1" class="form-control textarea"  id="exampleFormControlTextarea1" rows="3"></textarea>
    

  </div>
        <div >
            <span style="display: inline-block;"><h5>Score:</h5></span>
            <span style="display: inline-block;" v-if="score.q1"><h5 >Score: {{ score.q1 }}</h5></span>
        </div>
  <br>
<!-- Question 2 -->
<div class="form-group">
    <label for="exampleFormControlTextarea1">2.    Describe the interaction of the employee with his/her co-workers. Please cite specific examples.</label>
    
    <textarea v-model="nomination.q2" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
    
  </div>
  <div >
            <span style="display: inline-block;"><h5>Score:</h5></span>
            <span style="display: inline-block;" v-if="score.q2"><h5 >Score: {{ score.q2 }}</h5></span>
        </div>
  <br>
<!-- Question 3 -->
<div class="form-group">
    <label for="exampleFormControlTextarea1">3.    Describe the interaction of the employee with guests. Please cite specific examples of the employee’s positive impact on the guest experience at your hotel.</label>
    
        <textarea v-model="nomination.q3" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
     
  </div>
  <div >
            <span style="display: inline-block;"><h5>Score:</h5></span>
            <span style="display: inline-block;" v-if="score.q3"><h5 >Score: {{ score.q3 }}</h5></span>
        </div>
  <br>
<!-- Question 4 -->
<div class="form-group">
    <label for="exampleFormControlTextarea1">4.    Please list any awards or recognition that the employee has received from the Hotel, management, guests, award organizations and/or peers.</label>
   
        <textarea v-model="nomination.q4" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
  
  </div>
  <div >
            <span style="display: inline-block;"><h5>Score:</h5></span>
            <span style="display: inline-block;" v-if="score.q4"><h5 >Score: {{ score.q4 }}</h5></span>
        </div>
  <br>
  <!-- Question 5 -->
<div class="form-group">
    <label  for="exampleFormControlTextarea1">5.   Please list any other reasons for nominating this employee for the Big Apple Stars Awards.</label>
   
        <textarea v-model="nomination.q5" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
    
  </div>
  <div >
            <span style="display: inline-block;"><h5>Score:</h5></span>
            <span style="display: inline-block;" v-if="score.q5"><h5 >Score: {{ score.q5 }}</h5></span>
        </div>
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="updateNomination">Save changes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="deleteNomination">Delete</button>
</div>
  
  
</form>

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
                  name:'',
                  q1:'',
                  q2:'',
                  q3:'',
                  q4:'',
                  q5:''
                  },
            score:''
                }
        },
        

        props: {
                data: {
                        type: Object
                            }
                },
        mounted() {
                        

                var app = this;
                var id = this.data.id;
                
                axios.get(`/api/v1/nominations/${id}/edit`)
                    .then(function (resp) {
                        app.nomination = resp.data;
                        if (resp.data.score) {
                            app.score = resp.data.score
                        }
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
                 
            },
            deleteNomination() {
                var app = this;
                var id = app.data.id;
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

