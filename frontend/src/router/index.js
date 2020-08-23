import Vue from 'vue';
import VueRouter from 'vue-router';
import HelloWorld from '../components/HelloWorld';
import Login from '../components/pages/Login';
import Dashboard from '../components/pages/Dashboard';
import Admin from '../components/pages/Admin';
import store from '../store'

Vue.use(VueRouter);

const routes = [
        {
            path:'/login',
            name:'login',
            component:Login,
            meta: { 
                outofauth: true
            }
        },
        {
            path:'/hello',
            name:'hello',
            component:HelloWorld
            
        },
        {
            path:'/',
            name:'HelloWorld',
            component:HelloWorld,
            redirect:{path:"login"}
        },
        {
            path:'/admin',
            name:'admin',
            component:Admin,
            meta: { 
                requiresAuth: true
            },
            redirect:{path:"/admin/dashboard"},
            children:[
                {
                    path:'dashboard',
                    name:'admin.dashboard',
                    component:Dashboard
                   
                }
            ]
        },
        {
            path:'/company',
            name:'comapany',
            component:Admin,
            meta: { 
                requiresAuth: true
            },
            redirect:{path:"/company/index"},
            children:[
                {
                    path:'index',
                    name:'company.index',
                    component:Dashboard
                   
                }
            ]
        }
  ];

const router = new VueRouter({
    routes,
    mode:'history' 
});

// check valid route
router.beforeEach((to, from, next) => {
    if(to.name == 'login') {
        if(store.state.auth.status.loggedIn) { 
            next('/admin');
        } else {
            next();
        }
    } else{
        if(store.state.auth.status.loggedIn) { 
            next();
        } else {
            next('/login');
        }
    }
})

export default router

  