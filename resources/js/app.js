require('./bootstrap');

import * as Vue from "vue";
import App from './App.vue'
import * as VueRouter from 'vue-router';
import LinkForm from "./components/LinkForm";
import LinkList from "./components/LinkList";

const routes = [
    { path: '/', component: LinkForm },
    { path: '/list', component: LinkList },
]

const router = VueRouter.createRouter({
    history: VueRouter.createWebHistory(),
    routes,
});

Vue.createApp(App).use(router).mount('#app');
