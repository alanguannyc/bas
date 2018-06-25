<template>
    <div>
    <b-card class="mt-1"  sub-title="1.  Describe the employee’s overall job performance and dedication to his/her profession and to your Hotel.  Please be specific and cite at least one example."> 
                    <div  class="box"></div>
    <img src="/images/completed.png" v-show="completed" class="center" alt="..." />
        <p class="card-text">
            {{ nomination.q1 }}
        </p>
        <div class="score" v-on:click="showScore()">
            <h5 >Score: {{ score.q1 }}</h5>
        </div>
        <div class="scoreform">
            <form>
                <b-input-group>
                    <b-form-input type="number" min="0" max="5" placeholder="Enter your score" v-model="score.q1"></b-form-input>
                    <b-input-group-append>
                    
                    <b-btn variant="primary" v-on:click="saveScore()" >Save</b-btn>
                    <b-btn variant="outline-secondary" name='q1' v-on:click="clearScore()">Cancel</b-btn>
                    </b-input-group-append>
                </b-input-group>
            </form>
        </div>
        
    </b-card>

    <b-card class="mt-1" sub-title="2.    Describe the interaction of the employee with his/her co-workers. Please cite specific examples."
            >
        <p class="card-text">
            {{ nomination.q2 }}
        </p>
        <div class="score" v-on:click="showScore()">
            <h5 >Score: {{ score.q2 }}</h5>
        </div>
        <div class="scoreform">
            <form>
                <b-input-group>
                    <b-form-input type="number" min="0" max="5" placeholder="Enter your score" v-model="score.q2"></b-form-input>
                    <b-input-group-append>
                    
                    <b-btn variant="primary" v-on:click="saveScore()" >Save</b-btn>
                    <b-btn variant="outline-secondary" name='q2' v-on:click="clearScore()">Cancel</b-btn>
                    </b-input-group-append>
                </b-input-group>
            </form>
        </div>
    </b-card>

    <b-card class="mt-1" sub-title="3.    Describe the interaction of the employee with guests. Please cite specific examples of the employee’s positive impact on the guest experience at your hotel."
            >
        <p class="card-text">
            {{ nomination.q3 }}
        </p>
        <div class="score" v-on:click="showScore()">
            <h5 >Score: {{ score.q3 }}</h5>
        </div>
        <div class="scoreform">
            <form>
                <b-input-group>
                    <b-form-input type="number" min="0" max="5" placeholder="Enter your score" v-model="score.q3"></b-form-input>
                    <b-input-group-append>
                    
                    <b-btn variant="primary" v-on:click="saveScore()" >Save</b-btn>
                    <b-btn variant="outline-secondary" name='q3' v-on:click="clearScore()">Cancel</b-btn>
                    </b-input-group-append>
                </b-input-group>
            </form>
        </div>
    </b-card>

    <b-card class="mt-1" sub-title="4.    Please list any awards or recognition that the employee has received from the Hotel, management, guests, award organizations and/or peers."
            >
        <p class="card-text">
            {{ nomination.q4 }}
        </p>
        <div class="score" v-on:click="showScore()">
            <h5 >Score: {{ score.q4 }}</h5>
        </div>
        <div class="scoreform">
            <form>
                <b-input-group>
                    <b-form-input type="number" min="0" max="5" placeholder="Enter your score" v-model="score.q4"></b-form-input>
                    <b-input-group-append>
                    
                    <b-btn variant="primary" v-on:click="saveScore()" >Save</b-btn>
                    <b-btn variant="outline-secondary" name='q4' v-on:click="clearScore()">Cancel</b-btn>
                    </b-input-group-append>
                </b-input-group>
            </form>
        </div>
    </b-card>

    <b-card class="mt-1" sub-title="5.   Please list any other reasons for nominating this employee for the Big Apple Stars Awards."
            >
        <p class="card-text">
            {{ nomination.q5 }}
        </p>
        <div class="score" v-on:click="showScore()">
            <h5 >Score: {{ score.q5 }}</h5>
        </div>
        <div class="scoreform">
            <form>
                <b-input-group>
                    <b-form-input type="number" min="0" max="5" placeholder="Enter your score" v-model="score.q5"></b-form-input>
                    <b-input-group-append>
                    
                    <b-btn variant="primary" v-on:click="saveScore()" >Save</b-btn>
                    <b-btn variant="outline-secondary" name='q5' v-on:click="clearScore()">Cancel</b-btn>
                    </b-input-group-append>
                </b-input-group>
            </form>
        </div>
    </b-card>
    
</div>
</template>
<script>
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
                  q5:''
                  },
                  score:{
                    // total:'',
                    q1:'',
                    q2:'',
                    q3:'',
                    q4:'',
                    q5:''
                  }
                }
        },
        

        props: {
                data: {
                        type: Object
                            }
                },
        mounted() {
                var app = this;
                var id = app.data.id;
                
                axios.get(`/api/v1/nominations/${id}/edit`)
                    .then(function (resp) {
                    
                        app.nomination = resp.data;
                        if (resp.data.score) {
                            app.score = resp.data.score
                        }
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        // alert("Could not load nominations");
                    });
                
                
            },
        computed:{
                completed(){
                    for (var key in this.score) {
                        
                        if (this.score[key] == '') {
                            
                            return false;
                        } 
                        
                    }
                    return true;
                }
            },
        methods: {
            
            saveScore() {
                var app = this;
                var newScore = app.score;
                newScore.id = app.data.id
                
                axios.post(`/api/v1/score`, newScore)
                .then(function (resp) {
                    console.log(resp.data);
                })
                .catch(function (resp) {
                    console.log(resp);
                });
                // this.showscore = false;
                
                // this.next().focus()
                event.target.closest('div .scoreform').style.display = 'none'
                
                // event.target.hide();
            },
            showScore() {
                var tar = event.target.closest('div');
                
                $(tar).next().show();
                
                $(tar).closest('div.card').find('input.form-control').focus();

                for (var key in this.score) {
                    if(this.score[key]==''){
                        console.log('no record')
                    }
                        
                        
                        
                    }
                        
                
            },
            clearScore() {
                var id = event.target.name;
                this.score[id] = 0;
            }
        }
    }
    </script>
    <style scoped>
    b-card {
        margin-top:5px;
    }
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
    
    img {
    width: 40%;
        opacity: 0.7;
        z-index: 1000;
        position: absolute;

        right: 0;
        top: 2px;
        height: 180px;
        width: auto;
        
    }
  .center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
}




    </style>
    