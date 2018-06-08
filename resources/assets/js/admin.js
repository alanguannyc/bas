
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
                '<td>'+d.email+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Company:</td>'+
                '<td>'+d.profile.company+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Title:</td>'+
                '<td>'+d.profile.title+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Phone:</td>'+
                '<td>'+d.profile.phone+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td>Address:</td>'+
                '<td>'+d.profile.address+'</td>'+
            '</tr>'+
        '</table>';

    
}

axios.get('/admin/user/api')
    .then(res=>{
        var newdata = res.data;
        $(document).ready( function () {
            var table = $('#user_table').DataTable(
                {
                    data:newdata,
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
                    ],
                    dom: 'frtipB',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf'
                    ]

                }
            );

            $('#user_table tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
    
                var row = table.row( tr );
    
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

        } );

        
    })
    .catch(function(err){
        console.log(err);
    });

   

    

    $('button').click(function(){
        alert('yes')
    })