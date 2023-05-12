require('./bootstrap');


import { createApp } from 'vue';
import ExampleComponent from './components/example.vue';


const app = createApp({
    components: {
       ExampleComponent
    }
 });
 
 app.mount('#app');