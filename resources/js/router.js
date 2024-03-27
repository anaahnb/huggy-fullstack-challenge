import { createRouter, createWebHistory } from "vue-router";

const routes = [
    { path: "/", component: () => import("./pages/Home.vue"), },
    { path: "/contatos", component: () => import("./pages/Contatos.vue"), },
    { path: "/login", component: () => import("./pages/Login.vue"), },
    { path: "/register", component: () => import("./pages/Register.vue"), },


];

export default createRouter ({
    history: createWebHistory(),
    routes,
});