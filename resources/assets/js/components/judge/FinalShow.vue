<template>
    <div>
    <b-card class="mt-1"  sub-title="1.  Describe the employee’s overall job performance and dedication to his/her profession and to your Hotel.  Please be specific and cite at least one example."> 
                    <div  class="box"></div>
    <!-- <img src="/images/completed.png" v-show="completed" class="center" alt="..." /> -->
        <div class="card-text answer" v-html="nomination.q1">

        </div>
        <div>
            <!-- <label for="range-1"><i variant="warning">Give your score by using the slider below</i></label> -->
            
            <b-badge variant="info">Give your score by using the slider below</b-badge>
            <br />
            <b-form-input id="range-1" v-model="score.q1" type="range" min="0" max="10"></b-form-input>
            <div class="mt-2">Score: {{ score.q1 }}</div>
        </div>
        
    </b-card>

    <b-card class="mt-1" sub-title="2.    Describe the interaction of the employee with his/her co-workers. Please cite specific examples."
            >
       <div class="card-text answer" v-html="nomination.q2">

        </div>
        <div>
            <!-- <label for="range-1"><i variant="warning">Give your score by using the slider below</i></label> -->
            
            <b-badge variant="info">Give your score by using the slider below</b-badge>
            <br />
            <b-form-input id="range-2" v-model="score.q2" type="range" min="0" max="10"></b-form-input>
            <div class="mt-2">Score: {{ score.q2 }}</div>
        </div>
    </b-card>

    <b-card class="mt-1" sub-title="3.    Describe the interaction of the employee with guests. Please cite specific examples of the employee’s positive impact on the guest experience at your hotel."
            >
        <div class="card-text answer" v-html="nomination.q3">

        </div>
        <div>
            <!-- <label for="range-1"><i variant="warning">Give your score by using the slider below</i></label> -->
            
            <b-badge variant="info">Give your score by using the slider below</b-badge>
            <br />
            <b-form-input id="range-3" v-model="score.q3" type="range" min="0" max="10"></b-form-input>
            <div class="mt-2">Score: {{ score.q3 }}</div>
        </div>
    </b-card>

    <b-card class="mt-1" sub-title="4.    Please list any awards or recognition that the employee has received from the Hotel, management, guests, award organizations and/or peers."
            >
        <div class="card-text answer" v-html="nomination.q4">

        </div>
        <div>
            <!-- <label for="range-1"><i variant="warning">Give your score by using the slider below</i></label> -->
            
            <b-badge variant="info">Give your score by using the slider below</b-badge>
            <br />
            <b-form-input id="range-4" v-model="score.q4" type="range" min="0" max="10"></b-form-input>
            <div class="mt-2">Score: {{ score.q4 }}</div>
        </div>
    </b-card>

    <b-card class="mt-1" sub-title="5.   Please list any other reasons for nominating this employee for the Big Apple Stars Awards."
            >
        <div class="card-text answer" v-html="nomination.q5">

        </div>
        <div>
            <!-- <label for="range-1"><i variant="warning">Give your score by using the slider below</i></label> -->
            
            <b-badge variant="info">Give your score by using the slider below</b-badge>
            <br />
            <b-form-input  id="range-5" v-model="score.q5" type="range" min="0" max="10"></b-form-input>
            <div class="mt-2">Score: {{ score.q5 }}</div>
        </div>
    </b-card>
    <b-alert v-model="showSuccess" fade variant="success" dismissible >
      Scores Saved!
    </b-alert>
    <b-btn variant="primary" v-on:click.prevent="saveScore()" >Save</b-btn>
    <b-btn variant="outline-secondary"  v-on:click="clearScore()">Cancel</b-btn>
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
                  },
                  showSuccess :false,
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

                        if (resp.data.final_scores[0]) {
                            app.score = resp.data.final_scores[0]
                            
                        }
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        // alert("Could not load nominations");
                    });
                
                
            },
        computed:{
                completed(){
                    var app = this;
                    for (var key in this.score) {
                        
                        if (app.score[key] == '') {
                            
                            return false;
                        } 
                        
                    }
                    return true;
                }
            },
        methods: {
            
            saveScore() {
                // e.preventDefault()
                var app = this;
                var newScore = app.score;
                newScore.id = app.data.id

                axios.post(`/api/v1/finalScore`, newScore)
                .then(function (resp) {
                    
                    app.showSuccess = true
                    
                    setTimeout(() => {
                        app.showSuccess = false
                    }, 1500);

                    app.$emit('finalScoreUpdated', app.data.id)
                    
                })
                .catch(function (resp) {
                    console.log(resp);
                });
                // this.showscore = false;
                
                // this.next().focus()
                // event.target.closest('div .scoreform').style.display = 'none'
                
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
                for ( var i = 1; i<6 ; i++){
                    this.score['q'+i] = null;
                }
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
.answer {
    white-space: pre-line;
}





    </style>
    