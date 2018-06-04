
<template>

<div class="row">
          <div class="col-lg-12 col-md-12">
              <div class="card">
                  <div class="card-header card-header-tabs card-header-success">
                      <div class="nav-tabs-navigation">
                          <div class="nav-tabs-wrapper">
                              <span class="nav-tabs-title">Profile</span>
                              
                          </div>
                      </div>
                  </div>
                  <div class="card-body">
                      <div class="tab-content">
                          <form>
  <div class="form-group"> <!-- left unspecified, .bmd-form-group will be automatically added (inspect the code) -->
    <label for="ProfileCompany" class="bmd-label-floating">Company</label>
    <input type="text" class="form-control" id="ProfileCompany" v-model="profile.company">
  </div>
  <div class="form-group bmd-form-group"> <!-- manually specified --> 
    <label for="ProfileAddress" class="bmd-label-floating">Company Address</label>
    <input type="text" class="form-control" id="ProfileAddress" v-model="profile.address">
  </div>
  <div class="form-group bmd-form-group"> <!-- manually specified --> 
    <label for="ProfileTitle" class="bmd-label-floating">Title</label>
    <input type="text" class="form-control" id="ProfileTitle" v-model="profile.title">
  </div>
  <div class="form-group bmd-form-group"> <!-- manually specified --> 
    <label for="ProfilePhone" class="bmd-label-floating">Phone</label>
    <input type="phone" class="form-control" id="ProfilePhone" v-model="profile.phone">
  </div>
   <button class="btn btn-default">Cancel</button>
  <button type="submit" class="btn btn-success btn-raised" v-on:click="submitprofile">Submit</button>
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
        profile:{}
      }
    },
    mounted(){
      axios.get('../api/v1/profile').then( res => {
        console.log(res.data[0])
          this.profile = res.data[0]
        })
    },
    methods:{
      submitprofile:function(e){
        e.preventDefault()
        axios.post('../api/v1/profile',this.profile).then( res => {
          this.$router.push( '/dashboard' );
        })
      }
    }
    
}
</script>

