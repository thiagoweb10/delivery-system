import { defineStore } from "pinia"

export const useAuthStore = defineStore("auth", {
  state: () => ({
    token: localStorage.getItem("token") || null,
    user: null,
  }),

  actions: {
    setToken(token) {
      this.token = token
      localStorage.setItem("token", token)
    },
    logout() {
      this.token = null
      this.user = null
      localStorage.removeItem("token")
    },
  },
})
