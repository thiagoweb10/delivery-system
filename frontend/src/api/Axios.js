import axios from "axios"

export function createApi(baseURL = "") {
  const api = axios.create({
    baseURL,
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
    },
  })

  let authToken = localStorage.getItem("token") || null

  api.setToken = (token) => {
    authToken = token
    if (token) {
      localStorage.setItem("token", token)
    } else {
      localStorage.removeItem("token")
    }
  }

  api.interceptors.request.use(
    (config) => {
      if (authToken) config.headers.Authorization = `Bearer ${authToken}`
      return config
    },
    (error) => Promise.reject(error)
  )

  api.interceptors.response.use(
    (response) => response,
    (error) => {
      if (error.response) {
        const status = error.response.status
        switch (status) {
          case 401:
            api.setToken(null)
            window.location.href = "/login"
            break
          case 403:
            alert("Você não tem permissão para acessar este recurso.")
            break
          case 404:
            console.warn("Recurso não encontrado:", error.response.config.url)
            break
          default:
            console.error("Erro na requisição:", error.response)
        }
      }
      return Promise.reject(error)
    }
  )

  return api
}