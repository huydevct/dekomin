import {createApp} from 'vue';
import Demo from "../components/ProductCreateUpdate.vue";
import { plugin as Slicksort } from 'vue-slicksort';

const App = createApp(Demo);
App.use(Slicksort);
// App.use(VueSweetalert2);
App.mount('#create');
