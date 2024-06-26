import "./bootstrap";
    
import router from "./router";
import { createApp } from "vue";

import Toast, { useToast } from 'vue-toastification';
import VueTheMask from 'vue-the-mask';

import axios from 'axios';


axios.defaults.validateStatus = function (status) {
    return status >= 200 && status < 300;
};

import "vue-toastification/dist/index.css";

import App from "./App.vue";

const app = createApp(App);
app.use(Toast, { position: "top-right", timeout: 8000, closeOnClick: true, pauseOnHover: true, draggable: true, draggablePercent: 0.6, showCloseButtonOnHover: false, hideProgressBar: true, closeButton: "button", icon: true, rtl: false});
app.use(VueTheMask);

app.use(router).mount("#app");  