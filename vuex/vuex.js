import Vue from 'vue';
import VueX from 'vuex';
Vue.use(VueX);
const store = new VueX.Store({
	state:{
		userInfo :{}
	}
});
export default store;