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
            @change="StatusChange"
            />
        </div>

        <div >
           <label>Start First Round Judging</label>
            <toggle-button 
            :value="false" 
            color="#82C7EB" 
            :sync="true" 
            :labels="true" 
            :font-size=14 
            v-model="setting.judge_on"
            @change="StatusChange"
            />
        </div>
        <div >
           <label>Start Final Judging</label>
            <toggle-button 
            :value="false" 
            color="#82C7EB" 
            :sync="true" 
            :labels="true" 
            :font-size=14 
            v-model="setting.final_judge_on"
            @change="StatusChange"
            />
        </div>
        <div>
          <label>Update scores (give 0 score to empty answers)</label>
          <button v-on:click="updateScores" class="btn btn-primary btn-sm">UPDATE</button>
        </div>
      </div>
    </div>
  </div>
        
    
    </div>
    <notifications group="successinfo" position='bottom right' />
    </div>
    
  </template>

  <script>
import Notifications from 'vue-notification'


  export default {
    data () {
      return {
        setting: {
            application_on:'',
            judge_on:'',
            final_judge_on:''
        }
      }
    },
    mounted() {
        axios.get('/api/v1/setting').then(resp=>{
            this.setting = resp.data
            for (var key in this.setting){
              if (key == 'id' | key =='updated_at' | key =='created_at') continue;
              this.setting[key] = this.setting[key] == 0 ? false : true
            }

        }).catch(err=>{
            console.log(eer)
        })
    },
    methods: {
        StatusChange: function(){
            var app = this
            var newSetting = 
              {
                "application_on" : app.setting.application_on,
                "judge_on": app.setting.judge_on,
                "final_judge_on":app.setting.final_judge_on,
            }
            axios.post('/api/v1/setting/update', newSetting)
            .then(resp =>{
              
            })

        },
        judgeChange: function(){
          
            this.setting.judge_on ? axios.post('/api/v1/setting/judge_on') : axios.post('/api/v1/setting/judge_off')
        },
        updateScores: function(){
          
          axios.post(`/api/v1/setting/scores`)
          .then(resp => {
              this.showSuccessAlert()
          })
          // axios.get(`/api/v1/member/nominations/`)
          //    .then(resp =>  {    
          //      resp.data.map(nomination =>{
          //        for(var i=1; i <=5; i ++){
          //          if(nomination['q'+i].length == 0){
                     
          //            console.log(nomination.id)
          //          } 
          //        }
                 
          //      })
               
          //   })
          //    .catch(function (err) {
          //        console.log(err);
          //   })
        },

        showSuccessAlert: function(){
          this.$notify({

            group: 'successinfo',

            type: 'info',

            title: 'Scores have been updated',

            duration: 1000,

            speed: 500

          })
        }
    }
  }
</script>
<style>
.vue-notification {
  

  font-size: 15px;

  
}
</style>
