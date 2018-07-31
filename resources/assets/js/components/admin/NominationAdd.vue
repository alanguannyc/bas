<template>
    <div class="container">





<div class="row">
  <div class="col-md-9 col-sm-12 col-xs-12">
    <div class="x_panel tile ">
      <div class="x_title">
        <h2>Nomination</h2>
        <ul class="nav navbar-right panel_toolbox">
        

        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
       
    <form autocomplete="off">
    <div class="form-group">
    <label for="exampleFormControlSelect1">Category</label>
    <select class="form-control" id="exampleFormControlSelect1" v-model="nomination.category">
      <option>Full-Time Hourly With Guest Contact</option>
      <option>Full-Time Hourly Without Guest Contact</option>
      <option>Full-Time Room Attendant</option>
      <option>Managerial Below General Manager</option>
    </select>
  </div>

    <div class="form-group autocomplete " >
              
        <label> Nominated By </label>
        <input v-model="nomination.user" id="nominee" type="text" class="form-control" placeholder="Name" >
            
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
        
        <br>
        <!-- Question 2 -->
        <div class="form-group ">

            <label for="exampleFormControlTextarea1">2.    Describe the interaction of the employee with his/her co-workers. Please cite specific examples.</label>
            
            <textarea v-model="nomination.q2" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
            
        
        </div>
    
        <br>
        <!-- Question 3 -->
        <div class="form-group ">

            <label for="exampleFormControlTextarea1">3.    Describe the interaction of the employee with guests. Please cite specific examples of the employee’s positive impact on the guest experience at your hotel.</label>
            
                <textarea v-model="nomination.q3" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
            
        
        </div>
      
        <br>
        <!-- Question 4 -->
        <div class="form-group ">

            <label for="exampleFormControlTextarea1">4.    Please list any awards or recognition that the employee has received from the Hotel, management, guests, award organizations and/or peers.</label>
        
                <textarea v-model="nomination.q4" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
        
        </div>
  
        <br>
        <!-- Question 5 -->
        <div class="form-group ">
        
                <label  for="exampleFormControlTextarea1">5.   Please list any other reasons for nominating this employee for the Big Apple Stars Awards.</label>
            
                    <textarea v-model="nomination.q5" class="form-control textarea" id="exampleFormControlTextarea1" rows="3"></textarea>
                
        
        </div>
        
        <br>
        <br/>
        <div >
                <button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="updateNomination">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" v-on:click="clearNomination">Clear</button>
            </div>
  
</form>
    
      </div>
    </div>
  </div>
        

 </div>
</div>
    
</template>

<script>
    import { showSucess } from '../../admin.js'
    import { autocomplete } from '../../admin.js'
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
                  }
                  
              
                }
        },
        mounted() {
            
            axios.get('/api/v1/member/')
            .then(res=>{
                var newdata = res.data;
                console.log(typeof(newdata))
                var hotels = newdata.map(a => a.name);
                autocomplete(document.getElementById("nominee"), hotels)
                
            })
            
        },
        
        methods: {
            updateNomination() {
                var app = this;
                var url = purl(window.location.href)
                var id = url.segment(-1)
                var newNomination = app.nomination;
                newNomination.user = $('#nominee').val()
                
                axios.post('/api/v1/admin-nominations',newNomination)
                .then(function (resp) {
                  showSucess('Your nomination has been added.')
                  

                  for (var pro in app.nomination) {
                    app.nomination[pro]=""
                  }
                  
                })
                .catch(function (resp) {
                    console.log(resp);
                    // alert("Could not load nominations");
                });
            },
            clearNomination() {
                var app = this;
                for (var pro in app.nomination) {
                    app.nomination[pro]=""
                  }
            }
        }
    }
    </script>


<style >
.autocomplete {
  /*the container must be positioned relative:*/
  position: relative;
  display: inline-block;
}
.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}
.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}
.autocomplete-items div:hover {
  /*when hovering an item:*/
  background-color: #e9e9e9; 
}
.autocomplete-active {
  /*when navigating through the items using the arrow keys:*/
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>
