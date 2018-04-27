<template>
    <div class="container">
        <H1>Add new nominees</H1>
<form>
  <!-- Select category -->

 <div class="form-check" >
  <input v-model="category" class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="Full-Time Concierge" required>
  <label class="form-check-label" for="exampleRadios1">
    Full-Time Concierge
  </label>
</div>
<div class="form-check">
  <input v-model="category" class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="Full-Time Door Person" required>
  <label class="form-check-label" for="exampleRadios2">
    Full-Time Door Person
  </label>
</div>
<div class="form-check">
  <input v-model="category" class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="Full-Time Hourly With Guest Contact" required>
  <label class="form-check-label" for="exampleRadios2">
    Full-Time Hourly With Guest Contact
  </label>
</div>
<div class="form-check">
  <input v-model="category" class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="Full-Time Hourly Without Guest Contact" required>
  <label class="form-check-label" for="exampleRadios2">
    Full-Time Hourly Without Guest Contact
  </label>
</div>
<div class="form-check">
  <input v-model="category" class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="Full-Time Room Attendant" required>
  <label class="form-check-label" for="exampleRadios2">
    Full-Time Room Attendant
  </label>
</div>
<div class="form-check">
  <input v-model="category" class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="Managerial Below General Manager" required>
  <label class="form-check-label" for="exampleRadios2">
    Managerial Below General Manager
  </label>
</div>
<div class="form-check disabled">
  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" disabled>
  <label class="form-check-label" for="exampleRadios3">
    Disabled 
  </label>
</div>
<br>
<div v-if="category !== ''">
<!-- Enter name -->
<div class="form-group">
    <label for="exampleInputName">Enter Name</label>
    <input name="candidateName" type="text" class="form-control" id="InputName" aria-describedby="nameHelp" placeholder="Enter Name" required="true">
  </div>

<!-- Question 1 -->
<div class="form-group row">
    <label class="col-sm-4 col-form-label" for="exampleFormControlTextarea1">1.    Describe the employee’s overall job performance and dedication to his/her profession and to your Hotel.  Please be specific and cite at least one example.</label>
    <div class="col-sm-8">
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
  </div>
  <br>
<!-- Question 2 -->
<div class="form-group row">
    <label class="col-sm-4 col-form-label" for="exampleFormControlTextarea1">2.    Describe the interaction of the employee with his/her co-workers. Please cite specific examples.</label>
    <div class="col-sm-8">
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
  </div>
  <br>
<!-- Question 3 -->
<div class="form-group row">
    <label class="col-sm-4 col-form-label" for="exampleFormControlTextarea1">3.    Describe the interaction of the employee with guests. Please cite specific examples of the employee’s positive impact on the guest experience at your hotel.</label>
    <div class="col-sm-8">
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
  </div>
  <br>
<!-- Question 4 -->
<div class="form-group row">
    <label class="col-sm-4 col-form-label" for="exampleFormControlTextarea1">4.    Please list any awards or recognition that the employee has received from the Hotel, management, guests, award organizations and/or peers.</label>
    <div class="col-sm-8">
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
  </div>
  <br>
  <!-- Question 5 -->
<div class="form-group row">
    <label class="col-sm-4 col-form-label" for="exampleFormControlTextarea1">5.   Please list any other reasons for nominating this employee for the Big Apple Stars Awards.</label>
    <div class="col-sm-8">
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
  </div>

  <!-- Submit -->
  <button type="submit" @click="create()" class="btn btn-primary">Submit</button>
  </div>
</form>
 
    </div>
</template>

<script>
    export default {
        data() {
            return {
                category:''
            }
    },

        mounted() {
            console.log('Component mounted.')
        },

        methods () {
            create: {

            }
        }
    }
</script>
