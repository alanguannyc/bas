<template>
    <div class="container" >
        <div v-show="!lastPage">
        <b-card no-body >
        <b-tabs pills card vertical >
            <div v-for="nomination in nominations" v-bind:key="nomination.id">
            <b-tab :title="nomination.category" >
            <judge-show :data="nomination">
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
        <div class="thankyou" v-show="lastPage">
            <h3>Thanks for your participation!</h3>
            
        </div>
    </div>
</template>
<script>
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue);
export default {
    data(){
        return {
            nominations:'',
            score:'',
            lastPage:false
        }
    },
    mounted() {
            var app = this;
            var url = purl(window.location.href)
            var id = url.segment(-1)
            
            

            axios.get(`/api/v1/judge/${id}`)
                .then(function (resp) {
                    
                    app.nominations = resp.data;
                    // app.member = resp.data.member;
                    // app.profile = resp.data.member.profile;
                    
                    // app.role = resp.data.member.roles[0];
                    // console.log(app.nominations)
                    
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
