<template>
    <div class="container" >
        <div v-if="!lastPage && setting.judge_on">
        <b-card no-body >
        <b-tabs pills card vertical >
            <div v-for="nomination in nominations" v-bind:key="nomination.id">
            <b-tab  >

                <template slot="title">
                     {{nomination.category}} 
                     <span v-if="nomination.completed" style="color:green;">
                         <i><strong>Completed</strong></i>
                     </span>
                </template>
                <final-show :data="nomination" @finalScoreUpdated="finalScoreUpdated">
                </final-show>
            </b-tab>
            </div>
        </b-tabs>
        </b-card>
        
        <div >
        <b-btn class="left" variant="secondary" v-on:click="previousTab()">
            <i class="material-icons">
        navigate_before
        </i>
        </b-btn>
        <b-btn class="right" variant="secondary" v-on:click="nextTab()"><i class="material-icons">
        navigate_next
        </i>
        </b-btn>
        </div>
        </div>
        <div class="thankyou" v-else >
            <h3>Thanks for your participation!</h3>
        </div>
    </div>
</template>
<script>
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import _ from 'lodash'

Vue.use(BootstrapVue);
export default {
    data(){
        return {
            nominations:'',
            
            score:'',
            lastPage:false,
            setting:{
                    judge_on: ''
                },
        }
    },
    mounted() {
            var app = this;

            axios.get(`/api/v1/finalListForJudge`)
                .then(function (resp) {
                    
                    app.nominations = resp.data;
                    app.nominations = app.nominations.map(nomination=>{
                        var completed = true
                        for (var i=1;i<6;i++){
                            
                            if (nomination.final_scores[0]['q'+i] == null) {
                                completed = false
                            }
                        }
                        nomination['completed'] = completed
                        return nomination
                    })
                    
                })
                .catch(function (resp) {
                    
                    // alert("Could not load nominations");
                });

            axios.get('/api/v1/setting')
                .then(function (resp) {
                    app.setting = resp.data;
                    for (var key in app.setting){
                    if (key == 'id' | key =='updated_at' | key =='created_at') continue;
                    app.setting[key] = app.setting[key] == 0 ? false : true
                    }

                })
                .catch(function (resp) {
                    console.log(resp);
                    // alert("Could not load nominations");
                });
        },
    computed:{
        
    },
    methods:{
            nextTab(){
                
                var lastLi = $('body').find('li').last()[0]
                var nextLi = $('body').find('li a.active').closest('li').next('li')[0]
                
                
                if (!Boolean(nextLi)) {
                    this.lastPage = true;
                    
                } else {
                    $('body').find('li a.active').closest('li').next('li').find('a')[0].click();
                    
                    $('html,body').scrollTop(0);
                }

                // $('body').closest('li a.active').find('input.form-control').focus();
                // $('body').find('li a.active').closest('li a').removeClass('active');
                
            },
            previousTab(){
                console.log($('body').find('li a.active').closest('li').prev('li').find('a')[0])
                // $('body').closest('li a.active').find('input.form-control').focus();
                // $('body').find('li a.active').closest('li a').removeClass('active');
                $('body').find('li a.active').closest('li').prev('li').find('a')[0].click();
                $('html,body').scrollTop(0);
            },
            finalScoreUpdated(id) {

                var app = this;
                
                var nominationUpdated = app.nominations.find(function(nomination){
                        return nomination.id == id
                    })

                var completed = true
                for (var i=1;i<6;i++){
                        
                        if (nominationUpdated.final_scores[0]['q'+i] == null) {
                            completed = false
                        }
                    }
                nominationUpdated['completed'] = true
                
            },
            checkIfCompleted(nominations){
                nominations.map(nomination=>{
                                var completed = true
                                for (var i=1;i<6;i++){
                                    
                                    if (nomination.final_scores || nomination.final_scores[0]['q'+i] == null) {
                                        completed = false
                                    }
                                }
                                nomination['completed'] = completed
                            })

                return nominations
            }
        }
}
</script>

<style scoped>
.left {
    position: relative;
    bottom: 1px;
    left: 0;
    width: auto;
    float: left;
}
.right {
    position: relative;
    bottom: 1px;
    right: 0;
    width: auto;
    float: right;
}
.thankyou {
    position: relative;
    height: 300px;
    margin: auto;
    width: 100%;
    border: 3px solid green;
    padding: 10px;
    text-align: center;

}

.thankyou h3 {
    margin: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>
