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
                path: 'submodule',
                name: 'submodule-index',
                component: () =>
                    import ('../components/Content/Submodule/index.vue'),
                meta: {
                    requiresAuth: true,
                }
            },
            {
                path: 'submodule/add',
                name: 'submodule-add',
                component: () =>
                    import ('../components/Content/Submodule/add.vue'),
                meta: {
                    requiresAuth: true,

                }
            },
            {
                path: 'submodule/edit/:id',
                name: 'submodule-edit',
                component: () =>
                    import ('../components/Content/Submodule/edit.vue'),
                meta: {
                    requiresAuth: true,

                }
            },
            {
                path: 'rolepage/list',
                name: 'role-page-assoc',
                component: () =>
                    import ('../components/Content/RolePage/index.vue'),
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