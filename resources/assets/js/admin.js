
// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * includes Vue and other libraries. It is a great starting point when
//  * building robust, powerful web applications using Vue and Laravel.
//  */

// require('./bootstrap');
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Vue = require('vue');

// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */
$.fn.editable.defaults.mode = 'inline';

Vue.component('messenge-vue', require('./components/admin/Messenge.vue'));
Vue.component('member-nomination', require('./components/admin/MemberNomination.vue'));
Vue.component('nomination-detail', require('./components/admin/NominationDetail.vue'));
Vue.component('nomination-show', require('./components/admin/NominationShow.vue'));
Vue.component('nomination-add', require('./components/admin/NominationAdd.vue'));
Vue.component('user-index', require('./components/admin/UserIndex.vue'));
Vue.component('judge-nomination', require('./components/admin/JudgeNomination.vue'));

const app = new Vue({
    el: '#admin'
    
    // components: { App },
    // template: '<App/>'
});
Vue.config.productionTip = false;


function format ( d ) {
    for (var question in d) {
        if(d.question==null) {
            d.question="Not set" }
    }
    
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
            '<tr>'+
                '<td>Full name:</td>'+
                '<td>'+d.name+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Hotel:</td>'+
                '<td>'+d.user.profile.company+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Q1:</td>'+
                '<td>'+d.q1+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Q2:</td>'+
                '<td>'+d.q2+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Q3:</td>'+
                '<td>'+d.q3+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Q4:</td>'+
                '<td>'+d.q4+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Q5:</td>'+
                '<td>'+d.q5+'</td>'+
            '</tr>'+
        '</table>';

    
}


/* Members Table */
$(document).ready(function(){
    
    var member_table = $('#member_table').DataTable(
        {
            "order": [[ 7, "desc" ]],
            "ajax":{"url":"/api/v1/member","dataSrc":""},
            "columnDefs": [ {
                "targets": 0,
                "render": function ( data, type, row, meta ) {
                    return '<a href="'+'/admin/member/'+data.id+'">View</a>';
                  }

                }
              ],
            columns: [
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": 'view'
                },
                { data: 'name' },
                { data: 'email' },
                { data: 'profile.company',
                "defaultContent": "<i>Not set</i>" },
                { data: 'profile.title',
                "defaultContent": "<i>Not set</i>" },
                { data: 'profile.phone',
                "defaultContent": "<i>Not set</i>" },
                { data: 'roles[0].name'},
                { data: 'created_at' },
            ],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf'
            ]

        }
    );

    // $('#member_table tbody').on('click', 'td.details-control', function () {
    //     var tr = $(this).closest('tr');

    //     var row = table.row( tr );

    //     if ( row.child.isShown() ) {
    //         // This row is already open - close it
    //         row.child.hide();
    //         tr.removeClass('shown');
    //     }
    //     else {
    //         // Open this row
    //         row.child( format(row.data()) ).show();
    //         tr.addClass('shown');
    //     }
    // } );
    var nomination_table = $('#nomination_table').DataTable(
        {   
            "order": [[ 7, "desc" ]],
            "ajax":{"url":"/api/v1/member/nominations","dataSrc":""},
            "columnDefs": [ {
                
                    "targets": 6,
                    "render": function ( data, type, row, meta ) {
                        if(data != null){
                            return '<a href="'+'/admin/member/'+data.id+'">'+data.name+'</a>'
                        }
                    }

                },
                {
                
                    "targets": 4,
                    "render": function ( data, type, row, meta ) {
                        
                        // console.log(data)
                        if ( data == null ) {
                            
                            return 0;

                        } else {
                            for (var question in data) {
                                
                                if (data[question] == null) {
                                    data[question] = 0
                                }

                            }
                            
                            
                            return parseInt(data.q1) + parseInt(data.q2) + parseInt(data.q3) + parseInt(data.q4) + parseInt(data.q5)
                        }
                        
                        
                      }
    
                    },
                {
                    "targets": 2,
                    "render": function ( data, type, row, meta ) {
                        
                        return '<a href="'+'/nomination/'+row.id+'">'+data+'</a>'
                      }
    
                    },
                    { "width": "20%", "targets": 4 }
              ],
            columns: [
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": 'view'
                },
                // {data: 'id'},
                { data: 'category' },
                { data: 'name' },
                { data: 'title'},
                { data: 'score' },
                // { data: 'q1',
                // "defaultContent": "<i>Not set</i>" },
                // { data: 'q2',
                // "defaultContent": "<i>Not set</i>" },
                // { data: 'q3',
                // "defaultContent": "<i>Not set</i>" },
                // { data: 'q4',
                // "defaultContent": "<i>Not set</i>" },
                // { data: 'q5',
                // "defaultContent": "<i>Not set</i>" },
                { data: 'user.profile.company',
                "defaultContent": "<i>Not set</i>" },
                { data: 'user'},
                { data: 'created_at' },
            ],
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf'
            ]

        }
    );

    $('#nomination_table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');

        var row = nomination_table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );


    var user_table = $('#user_table').DataTable(
        {
            "ajax":{"url":"/api/v1/member","dataSrc":""},
            
            columns: [
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": 'view'
                },
                { data: 'name' },
                { data: 'email' },
                { data: 'profile.company',
                "defaultContent": "<i>Not set</i>" },
                { data: 'roles[0].name'},
                { data: 'created_at' },
            ],
            // dom: 'Bfrtip'
            // ,buttons: [
            //     'copy', 'csv', 'excel', 'pdf'
            // ]

        }
    );

    var judge = $('#judge_table').DataTable(
        {
            // "order": [[ 7, "desc" ]],
            "ajax":{"url":"/api/v1/judge","dataSrc":""},
            "columnDefs": [ {
                "targets": 0,
                "render": function ( data, type, row, meta ) {
                    // console.log(meta)
                    return '<a href="'+'/admin/judge/'+meta.row+'">View</a>';
                  }

                },
                {
                    "targets": 3,
                    "render": function ( data, type, row, meta ) {
                        if (meta.row == 0) {
                            return '0~9'
                        } else if (meta.row >= 1) {
                            return meta.row*10 + '~' + (meta.row*10 + 10)
                        }
                        }
        
                    }
              ],
            
            columns: [
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": 'view'
                },
                { data: 'name' },
                { data: 'email' },
                { data: 'id',
                "defaultContent": "<i>Not set</i>" },
                
                { data: 'updated_at' },
            ]
        }
    );

    function format_2 ( d ) {
        for (var question in d) {
            if(d.question==null) {
                d.question="Not set" }
        }
        
        return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<tr>'+
                    '<td>Full name:</td>'+
                    '<td>'+d.name+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Hotel:</td>'+
                    '<td>'+d.company+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Q1:</td>'+
                    '<td>'+d.q1+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Q2:</td>'+
                    '<td>'+d.q2+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Q3:</td>'+
                    '<td>'+d.q3+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Q4:</td>'+
                    '<td>'+d.q4+'</td>'+
                '</tr>'+
                '<tr>'+
                    '<td>Q5:</td>'+
                    '<td>'+d.q5+'</td>'+
                '</tr>'+
            '</table>';
    
        
    }

    var final_list_table = $('#final_list_table').DataTable(
        {
            "pagingType": "full_numbers",
            "order": [[ 1, "desc" ]],
            "ajax":{"url":"/api/v1/final","dataSrc":""},
            "columnDefs": [ {
                "targets": 2,
                "render": function ( data, type, row, meta ) {
                    return '<a href="'+'/nomination/'+row.id+'">'+data+'</a>'
                  }

                },
                
              ],
              dom: 'fBrtip',
              buttons: [
                'csv', 'excel'
            ],
            columns: [
                {
                    "className":      'details-control',
                    "orderable":      false,
                    "data":           null,
                    "defaultContent": 'view'
                },
                { data: 'category' },
                { data: 'name' },
                { data: 'title' },
                { data: 'company' },
                { data: 'totalscore' },
                { data: 'updated_at' },
            ]
        }
    );

    $('#final_list_table tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');

        var row = final_list_table.row( tr );

        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format_2(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
})
            

    
export function showSucess(msg){
    jQuery('.alert-success').html('<p>'+msg+'</p>').show();
    jQuery('.alert-success').fadeOut(3500,null);
    disableBtn()

    function disableBtn(){
    
        $(':button').prop('disabled', true);
        setTimeout(function(){$(':button').prop('disabled', false);},2500);
    }
}   


export function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
          /*check if the item starts with the same letters as the text field value:*/
          if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
            /*create a DIV element for each matching element:*/
            b = document.createElement("DIV");
            /*make the matching letters bold:*/
            b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
            b.innerHTML += arr[i].substr(val.length);
            /*insert a input field that will hold the current array item's value:*/
            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
            /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function(e) {
                /*insert the value for the autocomplete text field:*/
                inp.value = this.getElementsByTagName("input")[0].value;
                /*close the list of autocompleted values,
                (or any other open lists of autocompleted values:*/
                closeAllLists();
            });
            a.appendChild(b);
          }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
          /*If the arrow DOWN key is pressed,
          increase the currentFocus variable:*/
          currentFocus++;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 38) { //up
          /*If the arrow UP key is pressed,
          decrease the currentFocus variable:*/
          currentFocus--;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 13) {
          /*If the ENTER key is pressed, prevent the form from being submitted,*/
          e.preventDefault();
          if (currentFocus > -1) {
            /*and simulate a click on the "active" item:*/
            if (x) x[currentFocus].click();
          }
        }
    });
    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }
    function closeAllLists(elmnt) {
      /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
  }
  

  $( document ).ready(function() {
    $('#scoreUpdate').click(function(){

        axios.post(`/update`)
        .then(resp =>  {    
            
       })
        // getNominations().then((resp)=>{
        //     findEmptyResp(resp)
        // })
        

    })
})

  //get all nominations to find empty responses
  async function getNominations() {
    let nominations = await axios.get(`/api/v1/member/nominations/`)
             .then(resp =>  {    
                 return resp.data
            })
             .catch(function (resp) {
                 console.log(resp);
            })
            return nominations
 }

 
  
     
 //find empty responses
 async function findEmptyResp(nominations){

    for (var index in nominations) {
        
        var j = 1
        for (j = 1; j< 6; j++) {
            
            if(nominations[index]['q'+j] == null || nominations[index]['q'+j].length < 1){
            
                await findScores(nominations[index].id, j)

            }
        }
    }
    //  $.each(nominations, function( key, value ) {
    //     var j = 1
    //     for (j = 1; j< 6; j++) {
            
    //         if(value['q'+j] == null || value['q'+j].length < 1){
                
    //             findScores(value.id, j)

    //         }
    //     }
         
    //  })
 }


 //find scores for each nominations
 async function findScores(id, i) {
     await axios.get(`/api/v1/nominations/${id}/edit`)
     .then(function (resp) {
         if (resp.data.score) {
            var currentScore =  resp.data.score

            currentScore["q"+ i] = 0
   
            updateScores(currentScore)
         }
         
        
     })
 }
 

 // update scores
 async function updateScores(score){
     await axios.post(`/api/v1/updateEmptyScore`, score)
     .then(function (resp) {
         
     })
     .catch(function (resp) {
         console.log(resp);
     });
 }