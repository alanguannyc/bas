
// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * includes Vue and other libraries. It is a great starting point when
//  * building robust, powerful web applications using Vue and Laravel.
//  */



// require('./bootstrap');
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
window.Vue = require('vue');

// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('member-profile', require('./components/member/MemberProfile.vue'));
Vue.component('nominations-index', require('./components/member/NominationsIndex.vue'));
Vue.component('add-nominee', require('./components/member/AddNominee.vue'));
Vue.component('nominations-history', require('./components/member/NominationsHistory.vue'));

Vue.prototype.$applicationRuning = true
const app = new Vue({
    el: '#member',
    
    // router,
    // components: { App },
    // template: '<App/>'
});



// import router from './routes.js';
// import VueRouter from 'vue-router';

// Vue.use(VueRouter);
// $("#sidebarNav li a").click(function() {
       
//     $(this).parent().addClass('active').siblings().removeClass('active');

//     });
$(function(){
    var current = location.pathname;
    
    $('#sidebarNav li a').each(function(){

        if ($(this).attr('href') == current){
            
            $(this).parent().addClass('active');
        }
        
        
    })
})

$( ":button.add" ).click(function() {
    if(window.location.pathname !== "/dashboard/nominations") {
        window.location.pathname = "/dashboard/nominations";
    }
    
    $( "#add-more-area" ).toggle( "slow" );
  });
  

//   $.material.options.autofill = true;
//   $.material.init();


export function showSucess(msg){
    jQuery('.alert-success').html('<p>'+msg+'</p>').show();
    jQuery('.alert-success').fadeOut(3500,null);
    disableBtn()

    function disableBtn(){
    
        $(':button').prop('disabled', true);
        setTimeout(function(){$(':button').prop('disabled', false);},2500);
    }
}   

