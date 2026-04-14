import axios from "axios";

const api = axios.create({
    baseURL: '/',
    withCredentials: true,
    withXSRFToken: true,
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
    }
});

api.interceptors.response.use(
    response => response,
    async error => {
        if (error.response?.status === 419) {
            await api.get('/sanctum/csrf-cookie')
            return axios(error.config)
        }
        return Promise.reject(error)
    }
)

export default api;