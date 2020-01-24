import Vue from 'vue';
import App from './view/App.vue'
import store from './store'
import router from './routes'
import components from './components'


const app = new Vue({

	el: '#app',
	template: '<app></app>',
	components: {App},
	router,
	store
})