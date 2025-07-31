import axios from "axios";
import { useAuthStore } from '@/stores/authStore.js'

const api = axios.create({
  timeout: 30000, // Set request timeout
  headers: {
    "Content-Type": "application/json",
  },
  baseURL: import.meta.env.VITE_API_PATH_URL,
});

api.interceptors.request.use(config => {
  const authStore = useAuthStore();
  const token = authStore.getToken;
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

export default api;