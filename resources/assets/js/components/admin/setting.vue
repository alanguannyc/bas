<template>
    <div class="container">
      <div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel tile ">
      <div class="x_title">
        <h2>Settings</h2>
        
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
       <div >
           <label>Start Application</label>
            <toggle-button 
            :value="true" 
            color="#82C7EB" 
            :sync="true" 
            :labels="true" 
            :font-size=14 
            v-model="setting.application_on"
            @change="settingChange"
            />
        </div>
   
    
      </div>
    </div>
  </div>
        
    
    </div>
    </div>
  </template>

  <script>



  export default {
    data () {
      return {
        setting: {
            application_on:''
        }
      }
    },
    mounted() {
        axios.get('/api/v1/setting').then(resp=>{
            this.setting = resp.data
            console.log(this.setting)
        }).catch(err=>{
            console.log(eer)
        })
    },
    methods: {
        settingChange: function(){
            console.log(this.setting.application_on)
            this.setting.application_on ? axios.post('/api/v1/setting/application_on') : axios.post('/api/v1/setting/application_off')
        }
    }
  }
</script>