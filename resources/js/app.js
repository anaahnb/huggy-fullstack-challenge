import "./bootstrap";
    
import router from "./router";
import { createApp } from "vue";

import Toast, { useToast } from 'vue-toastification';
import "vue-toastification/dist/index.css";

import App from "./App.vue";

const app = createApp(App);
app.use(Toast, { position: "top-right", timeout: 8000, closeOnClick: true, pauseOnHover: true, draggable: true, draggablePercent: 0.6, showCloseButtonOnHover: false, hideProgressBar: true, closeButton: "button", icon: true, rtl: false});


app.use(router).mount("#app");  