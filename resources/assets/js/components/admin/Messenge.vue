<template>
    <div class="container">
        <!-- <H4>Edit new nominees</H4> -->
<!-- <form method="post">
 
  <div>
    <div class="form-group row">
        <div class="col-sm-12">
<p contenteditable="true" v-bind:value="messenge" > {{ messenge }} </p> </div>
  </div>

  <button type="submit"  @click="update()" class="btn btn-primary">Submit</button>
  </div>

</form> -->

<a v-on:click="update()" id="messengebox">{{ messenge }}</a>
<form class="form-inline editableform">
    <div class="control-group">
        
         <div><div class="editable-input"></div><div class="editable-buttons" ></div></div>
         <!-- <button type="submit" class="editable-submit" :click="update()">ok</button>
<button type="button" class="editable-cancel">cancel</button> -->
         <div class="editable-error-block"></div>
    </div> 
</form>

        
    </div>
</template>

<script>
    export default {
        data() {
            return {
              messenge:"Instruction...",
            }
    },

        mounted() {

            

            var app = this;
          
            axios.get(`/api/v1/messenge`)
                .then(function (resp) {
                  
                    if((!!resp.data.text)) {
                        app.messenge = resp.data.text 
                    }

                    
// $('#messengebox').editable('disable',{
                
//                 url: '/post' //this url will not be used for creating new user, it is only for update
//             });
                    
                })
                .catch(function (resp) {
                    console.log(resp);
                    // alert("Could not load nominations");
                });
            

            $('#messengebox').on('save', function(e, params) {
                // alert('Saved value: ' + params.newValue);
                $(this).data('editable').disable();
                // $('#messengebox').editable('hide')
                var newMessenge={}
                newMessenge.text = params.newValue
                // var text = JSON.parse(params.newValue)
                
                axios.post(`/api/v1/messenge`, newMessenge)
                .then(function (resp) {
                    
                    // app.messenge = resp.data.messenge
                })
                .catch(function (resp) {
                    console.log(resp);
                    // alert("Could not load nominations");
                });
            });
        },
        updated(){
        $('#messengebox').editable('disable',{
                
                url: '/post' //this url will not be used for creating new user, it is only for update
            });
        },
        methods: {
            update() {
              
            $('#messengebox').editable('enable')
            // event.preventDefault();
            // var app = this;
          
            // var newMessenge = app.messenge;
            
            // axios.post(`/api/v1/messenge`, newMessenge)
            //     .then(function (resp) {
            //         console.log(resp.data);
            //     })
            //     .catch(function (resp) {
            //         console.log(resp);
            //         // alert("Could not load nominations");
            //     });
            },
            // say: function (message) {
            //     alert(message)
            //     }
        }
    }
</script>
