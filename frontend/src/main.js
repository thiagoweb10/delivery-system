import { createApp } from "vue";
import { createPinia } from 'pinia'
import App from "./App.vue";
import router from "./router";

import "./assets/tailwind.css";

// Font Awesome
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// importar ícones que você quer usar
import { faTruck, faBox, faClock, faBell, faCog, faRoute, faCheck, faThumbsDown, faHouse } from '@fortawesome/free-solid-svg-icons'

// adicionar ícones na "library"
library.add(faTruck, faBox, faClock, faBell, faCog, faRoute, faCheck, faThumbsDown, faHouse )

const app = createApp(App)

app.component('FontAwesomeIcon', FontAwesomeIcon)
const pinia = createPinia()
app.use(pinia)
app.use(router)

app.mount('#app')

import { useAuthStore } from '@/store/auth'
const auth = useAuthStore()
auth.loadFromStorage()

