import { createRouter, createWebHistory } from "vue-router";

const routes = [
    { path: "/", component: () => import("./pages/Home.vue"), },
    { path: "/contatos", component: () => import("./pages/Contatos.vue"), },
];

export default createRouter ({
    history: createWebHistory(),
    routes,
});