import Vue from 'vue';
import Router from 'vue-router';
import AddNominee from './components/AddNominee';
import NominationsIndex from './components/NominationsIndex';


Vue.use(Router);

export default new Router({
  routes: [
    {
        path: '/nominations',
        name: 'NominationsIndex',
        component: NominationsIndex
    },
    {
        path: '/nominations/add',
        name: 'AddNominee',
        component: AddNominee
    }
  ]
});
