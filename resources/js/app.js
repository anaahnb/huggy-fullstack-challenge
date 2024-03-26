import "./bootstrap";
    
import router from "./router";
import { createApp } from "vue";

import App from "./App.vue";
import ButtonComponent from './components/ButtonComponent.vue'
import InputComponent from './components/InputComponent.vue'

const app = createApp(App);

app.component('ButtonComponent', ButtonComponent);
app.component('InputComponent', InputComponent);

app.use(router).mount("#app");