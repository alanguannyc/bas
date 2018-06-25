<template>
    <div class="container">
        <H3>Add new nominees</H3>
<form method="post">
  <!-- Select category -->


<div class="form-check">
  <input v-model="nomination.category"  type="radio" name="exampleRadios" id="exampleRadios2" value="Full-Time Hourly With Guest Contact" required>
  <label class="form-check-label" for="exampleRadios2">
    Full-Time Hourly With Guest Contact
  </label>
</div>
<div class="form-check">
  <input v-model="nomination.category"  type="radio" name="exampleRadios" id="exampleRadios2" value="Full-Time Hourly Without Guest Contact" required>
  <label class="form-check-label" for="exampleRadios2">
    Full-Time Hourly Without Guest Contact
  </label>
</div>
<div class="form-check">
  <input v-model="nomination.category"  type="radio" name="exampleRadios" id="exampleRadios2" value="Full-Time Room Attendant" required>
  <label class="form-check-label" for="exampleRadios2">
    Full-Time Room Attendant
  </label>
</div>
<div class="form-check">
  <input v-model="nomination.category"  type="radio" name="exampleRadios" id="exampleRadios2" value="Managerial Below General Manager" required>
  <label class="form-check-label" for="exampleRadios2">
    Managerial Below General Manager
  </label>
</div>

<br>
<div v-if="nomination.category !== ''">
<!-- Enter name -->
<div class="form-group">
    <label for="exampleInputName">Candidate Name</label>
    <input v-model="nomination.name"  name="candidateName" type="text"  id="InputName" aria-describedby="nameHelp" placeholder="Enter Name" required="true">
  </div>
<!-- Enter Title -->
<div class="form-group">
    <label for="candidateTitle">Title</label>
    <input v-model="nomination.title"  name="candidateTitle" type="text"  id="InputTitle" aria-describedby="nameHelp" placeholder="Enter Title" required="true">
  </div>
<!-- Question 1 -->
<div class="col-md-12">
    <label  for="exampleFormControlTextarea1">1.    Describe the employee’s overall job performance and dedication to his/her profession and to your Hotel.  Please be specific and cite at least one example.</label>
    
    <textarea v-model="nomination.q1" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
    
</div>
  <br>
<!-- Question 2 -->
<div class="col-md-12">
    <label for="exampleFormControlTextarea1">2.    Describe the interaction of the employee with his/her co-workers. Please cite specific examples.</label>
    
    <textarea v-model="nomination.q2" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
    
  </div>
  <br>
<!-- Question 3 -->
<div class="col-md-12">
    <label  for="exampleFormControlTextarea1">3.    Describe the interaction of the employee with guests. Please cite specific examples of the employee’s positive impact on the guest experience at your hotel.</label>
    
        <textarea v-model="nomination.q3" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
       
  </div>
  <br>
<!-- Question 4 -->
<div class="col-md-12">
    <label  for="exampleFormControlTextarea1">4.    Please list any awards or recognition that the employee has received from the Hotel, management, guests, award organizations and/or peers.</label>
    
        <textarea v-model="nomination.q4" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
     
  </div>
  <br>
  <!-- Question 5 -->
<div class="col-md-12">
    <label  for="exampleFormControlTextarea1">5.   Please list any other reasons for nominating this employee for the Big Apple Stars Awards.</label>
    
        <textarea v-model="nomination.q5" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
    
  </div>

  <!-- Submit -->
  <button type="submit" @click="create()" class="btn btn-primary">Submit</button>
  </div>
</form>
 
    </div>
</template>

<script>
import { showSucess } from '../../app.js'
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
                  
                  }
           
            }
    },
    // watch:{
    //   'nomination': {
    //         handler: function (newData, oldData){
    //           var app = this;
    //         axios.get('/api/v1/nominations')
    //             .then(function (resp) {
    //                 var array = resp.data

    //                 array.forEach(function(element, index) {
    //                   var category = element.category
    //                   $("input[value='"+category+"']").attr("disabled", true);
                   
    //                 });
    //             })
    //             .catch(function (resp) {
    //                 console.log(resp);
    //                 // alert("Could not load nominations");
    //             });
    //             deep: true
    //                 }
                    
    //   },
    // },
        mounted() {
            
            var app = this;
            axios.get('/api/v1/nominations')
                .then(function (resp) {
                   
                    var array = resp.data

                    array.forEach(function(element, index) {
                      var category = element.category
                      $("input[value='"+category+"']").attr("disabled", true);
                   
                    });
                })
                .catch(function (resp) {
                    console.log(resp);
                })
            
          },

        methods: {
            create() {
              $( "#add-more-area" ).hide( "slow" );
              event.preventDefault();
              
            var app = this;

            var newNomination = app.nomination;
            axios.post('/api/v1/nominations',newNomination)
                .then(function (resp) {
                  showSucess('Your nomination has been added.')
                  $("input[value='"+app.nomination.category+"']").attr("disabled", true);

                  for (var pro in app.nomination) {
                    app.nomination[pro]=""
                  }
                  
                })
                .catch(function (resp) {
                    console.log(resp);
                    // alert("Could not load nominations");
                });
               
            }
        }
    }
</script>
<style>
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