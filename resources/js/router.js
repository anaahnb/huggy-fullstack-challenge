import { createRouter, createWebHistory } from "vue-router";

const routes = [
    { path: "/", component: () => import("/resources/js/pages/Home.vue"), },
    { path: "/contatos", component: () => import("/resources/js/pages/Contatos.vue"), },
    { path: "/login", component: () => import("/resources/js/pages/Login.vue"), },
    { path: "/register", component: () => import("/resources/js/pages/Register.vue"), },


];

export default createRouter ({
    history: createWebHistory(),
    routes,
});