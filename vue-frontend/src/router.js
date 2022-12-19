//import vue router
import { createRouter, createWebHistory } from 'vue-router'
//define a routes
const routes = [
    {
        path: '/',
        name: 'login',
        component: () => import('@/components/indexPage.vue')
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('@/components/registerPage.vue')
    },
    {
    path: '/beranda',
    name: 'beranda',
    component: () => import('@/components/DashboardLayout.vue'),
        children:[
            {
                path: "/barang",
                name: "barang.index",
                component: () =>
                import('@/views/Barang/indexPage.vue'),
            },
            {
                path: "/kritik",
                name: "kritik",
                component: () =>
                import('@/views/Kritik/kritikPage.vue'),
            },
            {
                path: "/transaksi",
                name: "transaksi.index",
                component: () =>
                import('@/views/Transaksi/transaksiPage.vue'),
            },
            {
                path: "/user",
                name: "user",
                component: () =>
                import('@/views/User/userPage.vue'),
            },
            {
                path: "/user/edit",
                name: "user.edit",
                component: () =>
                import('@/views/User/editPage.vue'),
            },
            
        ], 
    },
    {
        path: '/admin',
        name: 'admin',
        component: () => import('@/components/DashboardAdmin.vue'),
        children:[
            {
                path: "/admin",
                name: "admin.index",
                component: () =>
                import('@/views/Admin/adminPage.vue'),
            },
            {
                path: "/barang/create",
                name: "barang.create",
                component: () =>
                import('@/views/Barang/createPage.vue'),
            },
            {
                path: "/barang/edit",
                name: "barang.edit",
                component: () =>
                import('@/views/Barang/editPage.vue'),
            },
            {
                path: "/admin",
                name: "kritik.index",
                component: () =>
                import('@/views/Admin/adminKritik.vue'),
            },
        ],
    },
]
//create router
const router = createRouter({
history: createWebHistory(),
routes // config routes
})
export default router;
