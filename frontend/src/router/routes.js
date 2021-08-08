const routes = [{
        path: '/admin',
        name: 'admin',
        component: () =>
            import ('./../components/Admin.vue'),
        meta: {
            isIndex: false,
            requiresAuth: true
        },
        redirect: { name: "module-index" },
        children: [{
                path: 'dashboard',
                name: 'admin.dashboard',
                component: () =>
                    import ('./../components/Content/Dashboard.vue'),
                meta: {
                    requiresAuth: true,
                    permission: 'dashboard-list',
                    isIndex: true
                }
            },
            {
                path: 'module',
                name: 'module-index',
                component: () =>
                    import ('../components/Content/Module/index.vue'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                path: 'module/add',
                name: 'module-add',
                component: () =>
                    import ('../components/Content/Module/add.vue'),
                meta: {
                    requiresAuth: true,

                }
            },
            {
                path: 'module/edit/:id',
                name: 'module-edit',
                component: () =>
                    import ('../components/Content/Module/edit.vue'),
                meta: {
                    requiresAuth: true,

                }
            },
            {
                path: '*',
                name: '404',
                component: () =>
                    import ('./../components/Content/404.vue'),
                meta: {
                    requiresAuth: false
                }
            },
        ]
    },

    {
        path: '/login',
        name: 'Login',
        component: () =>
            import ('./../components/Login.vue'),
        meta: {
            isIndex: false,
            isLoginRoute: true
        },
    },

    {
        path: '/',
        name: 'HelloWorld',
        component: () =>
            import ('./../components/HelloWorld.vue'),
        redirect: { path: "/login" }
    },

]

export default routes;