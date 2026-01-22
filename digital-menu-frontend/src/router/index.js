import { createRouter, createWebHistory } from 'vue-router';
import Login from '../views/Login.vue';
import Register from '../views/Register.vue';
import Dashboard from '../views/Dashboard.vue';
import PublicMenu from '../views/PublicMenu.vue';
import MenuItems from '../views/MenuItems.vue';

const routes = [
  { path: '/', component: Login },
  { path: '/register', component: Register },
  { path: '/dashboard', component: Dashboard },
  { path: '/menu/:slug', component: PublicMenu, props: true },
  {path:'/menu',component:MenuItems},
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
