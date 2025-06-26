import axios from 'axios';
import router from '../Router';
import { useAuthStore } from "@/Stores/Auth.js";

// Obter CSRF Token de forma segura
const getCsrfToken = () => {
    const metaTag = document.head.querySelector('meta[name="csrf-token"]');
    return metaTag ? metaTag.content : '';
};

// Criação da instância única
const http = axios.create({
    baseURL: (import.meta.env.VITE_BASE_URL || '/') + 'api/',
    headers: {
        'X-CSRF-TOKEN': getCsrfToken(),
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    },
    withCredentials: true // Para cookies/sessão
});

// Interceptor de Request
http.interceptors.request.use(
    (config) => {
        const authStore = useAuthStore();
        
        // Log para debug (remova em produção)
        console.log('[Request]', config.method?.toUpperCase(), config.url);
        
        // Adiciona token de autenticação se existir
        if (authStore.getToken()) {
            config.headers.Authorization = `Bearer ${authStore.getToken()}`;
        }
        
        return config;
    },
    (error) => {
        console.error('[Request Error]', error);
        return Promise.reject(error);
    }
);

// Interceptor de Response
http.interceptors.response.use(
    (response) => {
        console.log('[Response]', response.status, response.config.url);
        return response;
    },
    (error) => {
        if (error.response) {
            console.error('[Response Error]', error.response.status, error.config.url);
            
            // Tratamento de erros de autenticação
            if ([401, 403].includes(error.response.status)) {
                const authStore = useAuthStore();
                authStore.logout();
                router.push({ name: 'login' });
            }
            
            // Tratamento especial para erros 422 (validação)
            if (error.response.status === 422) {
                return Promise.reject({
                    ...error,
                    validationErrors: error.response.data.errors
                });
            }
        } else {
            console.error('[Network Error]', error.message);
        }
        
        return Promise.reject(error);
    }
);

export default http;