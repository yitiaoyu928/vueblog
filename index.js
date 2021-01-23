import Vue from 'vue';
import app from './app.vue';
// 组件库
import navBar from './src/navbar/navbar.vue';
import idCard from './src/userinfo/userinfo.vue';
import myDialog from './src/dialog/dialog.vue';
// 路由和Vuex
import router from './router/router.js';
import store from './vuex/vuex.js';
import 'normalize.css';
import './public/style.css';
import './public/setRadio.js';
import './public/icon-font/iconfont.css';
import axios from 'axios';
import qs from 'qs';
Vue.component('nav-bar',navBar);
Vue.component('id-card',idCard);
Vue.component('my-dialog',myDialog);
Vue.prototype.$axios = axios;
Vue.prototype.$qs = qs;
let vue = new Vue({
	el:'#app',
	render(create) {
		return create(app)
	},
	router,
	store
});