<template>
    <div class="container" >

     <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" :data-target="'#' + data.id + 'select'" :on-click="getJudge">
  Change Judge
</button>

<!-- <button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="updateJudge">Change Judge</button> -->

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" :id="data.id +'select'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">
            <!-- <slot name="title">
            I'm the default title!
          </slot> -->
          <div v-if="data">
                <h3>{{data.id}} </h3>
                <h3>{{data.name}}</h3>
                <!-- <h4>{{data.user.profile.company}}</h4> -->
          </div>
          
        </h5>
          
        
      </div>
      <div class="modal-body">
        
        <v-select v-model="selected" :options="options" ></v-select>
        <br/>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-dismiss="modal" v-on:click="updateJudge">
        Confirm
        </button>

      </div>
    </div>
  </div>
</div>
 
  


    </div>
    
</template>

<script>
import vSelect from 'vue-select'
import _ from 'lodash'
    export default {
        data() {
            return {
                options: [],
                selected: {},
                nomination:
                {
                
                  },
            }
        },
        
        // props: ['nomination'],
        props: {
                data: {
                    type: Object
                        }
                },
        
        mounted() {
                var app = this;
                var id = app.data.id;

                _.delay(this.getJudge, 800)
                
                axios.get(`/api/v1/judge/`)
                    .then(function (resp) {
                        var unselected = {
                            id: 0,
                            label: 'NO JUDGE'
                        }
                        app.options = resp.data.map(judge => ({id: judge.id, label: judge.name}))
                        app.options.push(unselected)
                        
                    })
                    .catch(function (resp) {
                        console.log(resp);
                    });
            },
            
          components: {
            "v-select" : vSelect
        },      
           
        methods: {

            getJudge() {
                var app = this;
                var id = app.data.id;
                axios.get(`/api/v1/nominations/`+ id +`/edit`)
                    .then(resp=>{
                    if(resp.data.judge){
                        app.selected = {id: resp.data.judge_id, label: resp.data.judge.name}
                        }
                    })
            },

            updateJudge() {
                var app = this;
                var id = app.data.id;
                var params = {
                    'id' : id,
                    'judge_id' : this.selected.id
                }

                axios.post(`/api/v1/updatejudge`, params)
                    .then(resp=>{
                        app.selected = {
                            id: id,
                            label: this.selected.label
                        }
                        this.$emit('updateJudge', app.selected)
                    })
                    .catch(err => {
                        console.log(err)
                    })
            },

        
            
        }
    }
    </script>

