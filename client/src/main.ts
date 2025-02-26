import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue';
import 'vuetify/styles';
import { createVuetify } from 'vuetify';

const vuetify = createVuetify({});
const app = createApp(App);

app.use(createPinia());
app.use(vuetify);
app.mount('#app');
