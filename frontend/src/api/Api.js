import { createApi } from "./Axios"

export const userApi = createApi(import.meta.env.VITE_API_USER)
export const deliveryApi = createApi(import.meta.env.VITE_API_DELIVERY)
export const notificationApi = createApi(import.meta.env.VITE_API_NOTIFICATION)

export function setGlobalToken(token) {
  userApi.setToken(token)
  deliveryApi.setToken(token)
  notificationApi.setToken(token)
}