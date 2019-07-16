<template>
    <div class="container">

     <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" :data-target="'#' + data.id" >
  <i class="material-icons " style="font-size:24px;">
pageview
</i>
</button>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" :id="data.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <h5  class="modal-title" id="exampleModalLongTitle">
            <!-- <slot name="title">
            I'm the default title!
          </slot> -->
        {{ data.category }}
        
          
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
<div class="col-md-6 pr-1">
    
    <label > Name</label>
    <div v-if="setting.application_on == false">{{nomination.name}} </div>
    <input v-else v-model="nomination.name" type="text" class="form-control" placeholder="Name" >
    
</div>
<div class="col-md-6 pr-1">
    
    <label> Title </label>
    <div v-if="setting.application_on == false">{{nomination.title}} </div>
    <input v-else v-model="nomination.title" type="text" class="form-control" placeholder="Title" required="true">
    
</div>
<!-- Question 1 -->
<div class="col-md-12">

    <label  for="exampleFormControlTextarea1">1.  Describe the employee’s overall job performance and dedication to his/her profession and to your Hotel.  Please be specific and cite at least one example.</label>
    <div v-if="setting.application_on == false" v-html="nomination.q1"> </div>
    <textarea v-else v-model="nomination.q1" class="form-control textarea"  id="exampleFormControlTextarea1" rows="3"></textarea>
    

  </div>
  <br>
<!-- Question 2 -->
<div class="col-md-12">
    <label for="exampleFormControlTextarea1">2.    Describe the interaction of the employee with his/her co-workers. Please cite specific examples.</label>
    <div v-if="setting.application_on == false" v-html="nomination.q2"> </div>
    <textarea v-else v-model="nomination.q2" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
    
  </div>
  <br>
<!-- Question 3 -->
<div class="col-md-12">
    <label for="exampleFormControlTextarea1">3.    Describe the interaction of the employee with guests. Please cite specific examples of the employee’s positive impact on the guest experience at your hotel.</label>
    <div v-if="setting.application_on == false" v-html="nomination.q3"> </div>
        <textarea v-else v-model="nomination.q3" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
     
  </div>
  <br>
<!-- Question 4 -->
<div class="col-md-12">
    <label for="exampleFormControlTextarea1">4.    Please list any awards or recognition that the employee has received from the Hotel, management, guests, award organizations and/or peers.</label>
   <div v-if="setting.application_on == false" v-html="nomination.q4"> </div>
        <textarea v-else v-model="nomination.q4" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
  
  </div>
  <br>
  <!-- Question 5 -->
<div class="col-md-12">
    <label  for="exampleFormControlTextarea1">5.   Please list any other reasons for nominating this employee for the Big Apple Stars Awards.</label>
    
    <div v-if="setting.application_on == false" v-html="nomination.q5"> </div>


    <textarea v-else v-model="nomination.q5" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>

  </div>
<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        <button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="updateNomination" v-if="setting.application_on == true">Save changes</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="deleteNomination" v-if="setting.application_on == true">Delete</button>
      </div>
  
</form>
      </div>
    </div>
  </div>
</div>
 
  


    </div>
    
</template>

<script>
import _ from 'lodash'
    export default {
        data() {
            return {
              nomination:
                {
                  category:'',
                  name:'',
                  title:'',
                  q1:'',
                  q2:'',
                  q3:'',
                  q4:'',
                  q5:''
                  },
                setting:
                {
                    application_on: false
                }
                }
        },

        props: {
                data: {
                        type: Object
                            }
                },
        beforeMount() {
                
        },
        mounted() {

                var app = this;
                var id = this.data.id;
                
                axios.get(`/api/v1/nominations/${id}/edit`)
                    .then(function (resp) {
                        app.nomination = resp.data;

                    })
                    .catch(function (resp) {
                        console.log(resp);
                        // alert("Could not load nominations");
                    });

                axios.get('/api/v1/setting')
                .then(function (resp) {
                    app.setting.application_on = resp.data.application_on
                    

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
                if(confirm('Are you sure?')){
                axios.delete(`/api/v1/nominations/${id}`)
                                .then(function (resp) {
                                    console.log(resp.data);
                                })
                                .catch(function (resp) {
                                    console.log(resp);
                });
                }
                
               
            },

        },
       
    
    }
    
    </script>

<style >
*, ::after, ::before {
    box-sizing: border-box;
}
.row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
}

@media (min-width: 768px){
.col-md-12 {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
}
}
.pr-1, .px-1 {
    padding-right: .25rem!important;
}
.col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
    position: relative;
    width: 100%;
    min-height: 1px;
    padding-right: 15px;
    padding-left: 15px;
}
*, ::after, ::before {
    box-sizing: border-box;
}

.form-group, .input-group {
    margin-bottom: 10px;
    position: relative;
}

label {
    margin-top: 10px;
    font-size: .9571em;
    margin-bottom: 10px;
    color: #020202;
}
label {
    cursor: default;
}
label {
    display: inline-block;
    margin-bottom: .5rem;
}

.form-group .form-control, .input-group .form-control {
    padding: 10px;
}
textarea.form-control {
    max-width: 100%;
    max-height: 80px;
    padding: 10px 10px 0 0;
    resize: none;
    border: none;
    border: 1px solid #e3e3e3;
    border-radius: 4px;
    line-height: 2;
}
.form-control {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    color: #66615b;
    line-height: normal;
    font-size: 14px;
    transition: color .3s ease-in-out,border-color .3s ease-in-out,background-color .3s ease-in-out;
    box-shadow: none;
}
.form-control {
    display: block;
    width: 100%;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
button, input, optgroup, select, textarea {
    font-family: Montserrat,Helvetica Neue,Arial,sans-serif;
}
textarea {
    overflow: auto;
    resize: vertical;
}
button, input, optgroup, select, textarea {
    margin: 0;
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
}
*, ::after, ::before {
    box-sizing: border-box;
}




</style>