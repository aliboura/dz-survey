/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
/*
const app = new Vue({
    el: '#app',
});
*/


import VueRouter from 'vue-router'
import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import Vuetify from 'vuetify';
import VueFormulate from '@braid/vue-formulate'

/**********************/



Vue.use(Vuetify)

Vue.use(VueFormWizard)


Vue.use(VueRouter);


Vue.component('my-header', require('./components/MyHeader.vue').default);

Vue.use(VueFormulate)

//const VueFormulate = require('@braid/vue-formulate')
//Vue.use(VueFormulate.default)







Vue.component('survey-dialog', require('./components/Dialog.vue').default);
Vue.component('survey-dialog-create', require('./components/DialogCreate.vue').default);
Vue.component('survey-config', require('./components/DialogEditSurvey.vue').default);

Vue.component('page-edit-dialog', require('./components/DialogEditPage.vue').default);
Vue.component('response-edit-dialog', require('./components/DialogEditResponse.vue').default);

Vue.component('survey-dialog-create-new-survey', require('./components/DialogCreateNewSurvey.vue').default);

Vue.component('survey-dialog-client', require('./components/DialogClient.vue').default);
Vue.component('survey-dialog-preview', require('./components/DialogPreview.vue').default);

Vue.component('survey-edit-tabs', require('./components/SurveyEditTabs.vue').default);
Vue.component('survey-trello', require('./components/SurveyTrello.vue').default);
Vue.component('surveys-list', require('./components/SurveysList.vue').default);
Vue.component('survey-report', require('./components/SurveyReport.vue').default);

Vue.component('sidebar', require('./components/Sidebar.vue').default);

Vue.component('user-survey-vuetify', require('./components/UserSurveyVuetify.vue').default);

Vue.component('chart-pie', require('./components/Pie.vue').default);
Vue.component('dialog-report', require('./components/DialogReport.vue').default);


 


const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    


});
