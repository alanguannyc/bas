
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
const app = new Vue({
    el: '#admin'
    
    // components: { App },
    // template: '<App/>'
});

import App from './App.vue';


function format ( d ) {

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
                '<td>Company:</td>'+
                '<td>'+d.q1+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Title:</td>'+
                '<td>'+d.q2+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Phone:</td>'+
                '<td>'+d.q3+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Address:</td>'+
                '<td>'+d.q4+'</td>'+
            '</tr>'+
        '</table>';

    
}


/* Members Table */
$(document).ready(function(){
    
    var member_table = $('#member_table').DataTable(
        {
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
            "ajax":{"url":"/api/v1/member/nominations","dataSrc":""},
            "columnDefs": [ {
                "targets": 4,
                "render": function ( data, type, row, meta ) {
                    
                    return '<a href="'+'/admin/member/'+data.id+'">'+data.name+'</a>'
                  }

                },
                {
                    "targets": 0,
                    "render": function ( data, type, row, meta ) {
                        
                        return '<a href="'+'/nomination/'+data.id+'">view</a>'
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
                { data: 'category' },
                { data: 'name' },
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
})
            

    
