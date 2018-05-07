
// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * includes Vue and other libraries. It is a great starting point when
//  * building robust, powerful web applications using Vue and Laravel.
//  */

require('./bootstrap');

window.Vue = require('vue');

// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */

// // Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    router,
    components: { App },
    template: '<App/>'
});

import App from './App.vue';

import router from './routes.js';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

function format ( d ) {
    // `d` is the original data object for the row
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
            '<td>Company:</td>'+
            '<td>'+d.profile.title+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Company:</td>'+
            '<td>'+d.profile.phone+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Company:</td>'+
            '<td>'+d.profile.address+'</td>'+
        '</tr>'+
    '</table>';
}




axios.get('/admin/user/api')
    .then(res=>{
        var newdata = res.data;
        var table = $(document).ready( function () {
            $('#user_table').DataTable(
                {
                    data:newdata,
                    columns: [
                        {"className": 'details-control'},
                        { data: 'email' },
                        { data: 'name' }
                    ],
                    dom: 'frtipB',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf'
                    ]

                }
            );
        } );
    })
    .catch(function(err){
        console.log(err);
    });
 
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