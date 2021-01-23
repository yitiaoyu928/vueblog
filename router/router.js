import Vue from 'vue';
import VueRouter from 'vue-router';
import regist from '../src/register/regist.vue';
import login from '../src/login/login.vue';
import home from '../src/home/home.vue';
import detail from '../src/detail/detail.vue';
import taste from '../src/taste/taste.vue';
import wishes from '../src/wishes/wishes.vue';
import timeline from '../src/timeline/timeline.vue';
import info from '../src/info/info.vue';
import editInfo from '../src/editInfo/editInfo.vue'; 
Vue.use(VueRouter);
let routes = [{
        path: '/home',
        component: home,
        name: home,
        alias:'/',
        children: [{
            path: '',
            component: detail
        },{
            path:'taste',
            component:taste

        },{
            path:'wishes',
            component:wishes

        },{
            path:'timeline',
            component:timeline

        },{
            path:'info/:id',
            component:info
        },{
            path:'editInfo',
            component:editInfo
        }]
    },
    {
        path: '/regist',
        component: regist,
        name: regist
    }, {
        path: '/login',
        component: login,
        name: login
    }
]
let router = new VueRouter({
    routes
})
export default router;