import { Notify } from 'quasar';

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
    beforeEnter: (to, from, next) => {
      const logado = false;
      Notify.create({
        icon: 'ion-close',
        color: 'neagtive',
        message: 'Nao existe usuario logado',
        progress: true,
        actions:[{icon: 'close',color:'white'}]
        

      })
      next('/login')
    },
    children: [
      { path: 'profile', component: () => import('pages/auth/Login.vue') },
      { path: 'cadastro', component: () => import('pages/auth/Register.vue') }
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
