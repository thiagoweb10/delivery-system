import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "@/views/Dashboard.vue";
import Preview from "@/views/Preview.vue";
import Login from "@/views/Login.vue";

const routes = [
  { path: "/", name: "dashboard", component: Dashboard },
  { path: "/dashboard", name: "dashboard", component: Dashboard },
  { path: "/detalhes", name: "Preview", component: Preview },
  { path: "/login", name: "login", component: Login },

];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
