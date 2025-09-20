import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "@/views/Dashboard.vue";
import Preview from "@/views/Preview.vue";
import Login from "@/views/Login.vue";
import ResetPasswordLink from "@/views/ResetPasswordLink.vue";
import ResetPassword from "@/views/ResetPassword.vue";
import ResetNewPassword from "@/views/ResetNewPassword.vue";



const routes = [

  { path: "/login",         name: "login",              component: Login },
  { path: "/",              name: "delivery-dashboard", component: Dashboard },
  { path: "/dashboard",     name: "delivery-dashboard", component: Dashboard },
  { path: "/detalhes/:id?", name: "delivery-details",   component: Preview, props: true },
  { path: "/nova-senha",   name: "reset-password-new", component: ResetNewPassword },

];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;