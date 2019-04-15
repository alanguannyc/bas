<template>
    <div class="container" >
        <div v-if="!lastPage && setting.application_on">
            <b-card no-body >
            <b-tabs pills card vertical >
                <div v-for="nomination in nominations" v-bind:key="nomination.id">

                <!-- <b-tab :title="nomination.category" > 
                
                </b-tab> -->

                <b-tab > 
                <template slot="title">
                     {{nomination.category}} 
                     <span v-show="nomination.completed" style="color:green;">
                         <i><strong>Completed</strong></i>
                     </span>
                </template>
                <judge-show :data="nomination" @scoreUpdated="scoreUpdated">
                                        </judge-show>
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
    data: function(){
        return {
            completed:false,
            nominations:'',
            score:'',
            lastPage:false,
            setting:{
                    application_on: ''
                },
        }
    },

    // watch: {
    //     'setting': {
    //         handler:  
    //         _.debounce(function (newData, oldData){
    //         var app = this;
    //         axios.get('/api/v1/setting')
    //         .then(function (resp) {
    //             app.setting = resp.data;

    //         })
    //         .catch(function (resp) {
    //             console.log(resp);
    //             // alert("Could not load nominations");
    //         });
    //             deep: true
    //         }, 1000)
    //     },
    // },
 
    mounted() {
            var app = this;
            axios.get(`/api/v1/judgepanel/`)
                .then(function (resp) {

                    // app.nominations = resp.data.nominations;
                    app.nominations = resp.data.nominations.map(nomination=>{
                        var completed = true
                        for (var i=1;i<6;i++){
                            
                            if (nomination.score['q'+i] == null) {
                                completed = false
                            }
                        }
                        nomination['completed'] = completed

                        return nomination
                    })


                })
                .catch(function (err) {
                    console.log(err);
                    // alert("Could not load nominations");
                });

            axios.get('/api/v1/setting')
                .then(function (resp) {
                    app.setting = resp.data;

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
            scoreUpdated() {

                
                
                // app.nominations.forEach(nomination=>{
                //                 var completed = true
                //                 for (var i=1;i<6;i++){
                                    
                //                     if (nomination.score['q' + i]==null) {
                //                         completed = false
                //                     }
                                    
                //                 }
                //                 nomination['completed'] = completed


                //             })
                
                var app = this;
                axios.get(`/api/v1/judgepanel/`)
                .then(function (resp) {

                    app.nominations = resp.data.nominations;
                    app.nominations = app.nominations.map(nomination=>{
                        var completed = true
                        for (var i=1;i<6;i++){
                            
                            if (nomination.score['q'+i] == null) {
                                completed = false
                            }
                        }
                        nomination['completed'] = completed

                        return nomination
                    })


                })

                
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

:root {
--brand-success : #5cb85c;
--loader-size: 7em;
--check-height: loader-size/2;
--check-width: check-height/2;
--check-left: (loader-size/6 + $loader-size/12);
--check-thickness: 3px;
--check-color: brand-success;
}


/* .circle-loader {
  margin-bottom: var(loader-size/2);
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-left-color: var(check-color);
  animation: loader-spin 1.2s infinite linear;
  position: relative;
  display: inline-block;
  vertical-align: top;
  border-radius: 50%;
  width: var(loader-size);
  height: var(loader-size);
}

.load-complete {
  -webkit-animation: none;
  animation: none;
  border-color: var(check-color);
  transition: border 500ms ease-out;
}

.checkmark {
  display: none;
  
  &.draw:after {
    animation-duration: 800ms;
    animation-timing-function: ease;
    animation-name: checkmark;
    transform: scaleX(-1) rotate(135deg);
  }
  
  &:after {
    opacity: 1;
    height: var(check-height);
    width: var(check-width);
    transform-origin: left top;
    border-right: var(check-thickness) solid var(check-color);
    border-top: var(check-thickness) solid var(check-color);
    content: '';
    left: var(check-left);
    top: var(check-height);
    position: absolute;
  }
}

@keyframes loader-spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes checkmark {
  0% {
    height: 0;
    width: 0;
    opacity: 1;
  }
  20% {
    height: 0;
    width: var(check-width);
    opacity: 1;
  }
  40% {
    height: var(check-height);
    width: var(check-width);
    opacity: 1;
  }
  100% {
    height: var(check-height);
    width: var(check-width);
    opacity: 1;
  }
} */
</style>
