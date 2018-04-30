import Vue from 'vue';
import Router from 'vue-router';
import AddNominee from './components/AddNominee';
import EditNominee from './components/EditNominee';
import NominationsIndex from './components/NominationsIndex';


Vue.use(Router);

export default new Router({
  routes: [
    {
        path: '/nominations/',
        name: 'NominationsIndex',
        component: NominationsIndex
    },
    {
        path: '/nominations/add',
        name: 'AddNominee',
        component: AddNominee
    },
    {
        path: '/nominations/:id/edit',
        name: 'EditNominee',
        component: EditNominee
    }
  ]
});
