import Vue from 'vue';
import VueRouter from 'vue-router';
import HelloWorld from '../components/HelloWorld';
import Login from '../components/pages/Login';
import Dashboard from '../components/pages/Dashboard';
import Admin from '../components/pages/Admin';

// module
import ModuleList from '../components/pages/Module/index.vue';
import ModuleAdd from '../components/pages/Module/add.vue';
import ModuleEdit from '../components/pages/Module/edit.vue';

// submodule
import SubModuleList from '../components/pages/Submodule/index.vue';
import SubModuleAdd from '../components/pages/Submodule/add.vue';
import SubModuleEdit from '../components/pages/Submodule/edit.vue';


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
            name:'company',
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
        },
        {
            path:'/masterdata',
            name:'masterdata',
            component:Admin,
            meta: { 
                requiresAuth: true
            },
            redirect:{path:"/masterdata/module"},
            children:[
                {
                    path:'module',
                    name:'module',
                    component:ModuleList
                   
                },
                {
                    path:'module/add',
                    name:'module.add',
                    component:ModuleAdd
                   
                },
                {
                    path:'module/edit/:id',
                    name:'module.edit',
                    component:ModuleEdit
                   
                },

                {
                    path:'submodule',
                    name:'submodule',
                    component:SubModuleList
                   
                },
                {
                    path:'submodule/add',
                    name:'submodule.add',
                    component:SubModuleAdd
                   
                },
                {
                    path:'submodule/edit/:id',
                    name:'submodule.edit',
                    component:SubModuleEdit
                   
                }
            ]
        }
        

        
  ];

const router = new VueRouter({
    routes,
    mode:'history',
    linkActiveClass: "active",
    linkExactActiveClass: "active"
});


/*const isExist = (arr, name) => {
  const { length } = arr;
  const id = length + 1;
  const found = arr.some(el => el.username === name);
  if (!found) arr.push({ id, username: name });
  return arr;
}*/

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
            
            var routeList = store.getters['auth/routeList'];
            var isValidRoute = false;

            for(var route in routeList){
                if(routeList[route] == to.path){
                    isValidRoute = true;
                }
            }

            if(isValidRoute){
                next();
            }else{

                if(to.name){
                    store.dispatch('auth/inValidRoute',1);
                    next(from.path);
                }else{
                    store.dispatch('auth/inValidRoute',2);
                    next(from.path);
                }
            }
            
            
        } else {
            next('/login');
        }
    }
})

export default router

  