import Vue from 'vue';
import App from './App.vue';
import router from './router';

import { firestorePlugin } from 'vuefire';
import firebase from 'firebase';

const { Timestamp } = firebase.firestore;
export { Timestamp };

Vue.use(firestorePlugin);
Vue.use(firebase, { apiKey: ' AIzaSyAVJwGwkiy0lStur9TgIqA2GxgR-VuixQs' });

Vue.config.productionTip = false;

new Vue({
	router,
	render: h => h(App),
}).$mount('#app');
