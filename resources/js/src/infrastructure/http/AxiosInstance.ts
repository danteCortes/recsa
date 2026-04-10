import axios from "axios";
import { useAuthStore } from "../auth/http/stores/AuthStore";

const axiosInstance = axios.create({
    baseURL: import.meta.env.VITE_API_URL,
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    },
    withCredentials: true,
    withXSRFToken: true
});

// Interceptor de request: agrega el token en cada petición
axiosInstance.interceptors.request.use(
    (config) => {
        const authStore = useAuthStore();
        const token = authStore.$state.token;
        if (token) {
            config.headers.Authorization = `Bearer ${token}`
        }
        return config
    },
    (error) => Promise.reject(error)
)

// Interceptor de response: maneja token expirado
axiosInstance.interceptors.response.use(
    (response) => response, 
    (error) => {
        if (error.response?.status === 401) {
            const authStore = useAuthStore();
            authStore.clearSession();
            window.location.href = '/';
        }
        return Promise.reject(error)
    }
)

export default axiosInstance