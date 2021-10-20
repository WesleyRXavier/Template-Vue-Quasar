

const routes = [
  {
    path: '/',
    component: () => import('layouts/AuthLayout.vue'),
    children: [
      { path: 'login', name: 'login', component: () => import('pages/auth/Login.vue') },
      { path: 'register', name: 'register', component: () => import('pages/auth/Register.vue') }
    ],


  },

  {
    path: '/admin',
    component: () => import('layouts/AdminLayout.vue'), 
    children: [
      { path: 'home',name:'home', component: () => import('pages/admin/Home.vue') },
      
    ],

  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/Error404.vue')
  }
]

export default routes
