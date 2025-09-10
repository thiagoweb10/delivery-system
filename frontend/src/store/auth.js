import { defineStore } from "pinia"

export const useAuthStore = defineStore("auth", {
  state: () => ({
    token: localStorage.getItem("token") || null,
    user: null,
  }),

  getters: {
    userAvatar: (state) => state.user?.avatar,
    userName: (state) => state.user?.name,
    userRoleLabel: (state) => state.user?.roles?.[0]?.label,

    isCourier: (state) => state.user?.roles?.[0]?.name === "courier",
    isClient: (state) => state.user?.roles?.[0]?.name === "client",

    welcomeMessage: (state) => {
      if (!state.user) return 'Olá, Usuário!'
      const role = state.user.roles?.[0]?.label || ''
      const name = state.user.name
      const extra = state.user.roles?.[0]?.name === 'courier'
        ? 'Pronto para pegar novas entregas?'
        : 'Confira suas entregas disponíveis.'
      return `Olá, ${role} ${name}! ${extra}`
    },

    userAvatarUrl: (state) => {
      if (!state.user) return '@/img/avatar.png'
      
      return state.user.avatar 
        ? `/src/assets/img/${state.user.avatar}` 
        : '/src/assets/img/avatar.png'
    }
  },

  actions: {
    setUser(user){
      this.user = user
      localStorage.setItem('user', JSON.stringify(user))
    },
    setToken(token) {
      this.token = token
      localStorage.setItem("token", token)
    },
    logout() {
      this.token = null
      this.user = null
      localStorage.removeItem("token")
      localStorage.removeItem('user')
    },
    loadFromStorage() {
      const user = localStorage.getItem('user')
      const token = localStorage.getItem('token')
      if (user) this.user = JSON.parse(user)
      if (token) this.token = token
    },
  },
})
