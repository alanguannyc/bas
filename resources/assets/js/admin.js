
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
Vue.component('user-index', require('./components/admin/UserIndex.vue'));
Vue.component('judge-nomination', require('./components/admin/JudgeNomination.vue'));

const app = new Vue({
    el: '#admin'
    
    // components: { App },
    // template: '<App/>'
});



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
                '<td>Email:</td>'+
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
                        
                        return '<a href="'+'/admin/member/'+data.id+'">'+data.name+'</a>'
                    }

                },
                {
                
                    "targets": 4,
                    "render": function ( data, type, row, meta ) {
                        
                        
                        if (data == null) {
                            // data=0;
                            return 0;
                            for (var question in data) {
                                data[question] = 0
                            }
                        } else {
                            return data.q1 + data.q2 + data.q3 + data.q4 + data.q5
                        }
                        console.log(data)
                        
                      }
    
                    },
                {
                    "targets": 2,
                    "render": function ( data, type, row, meta ) {
                        
                        return '<a href="'+'/nomination/'+row.id+'">'+data+'</a>'
                      }
    
                    },
                    { "width": "20%", "targets":4 }
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