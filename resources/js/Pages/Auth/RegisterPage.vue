<template>
    <AuthLayout>
        <LoadingComponent :isLoading="isLoading">
            <div class="text-center">
                <span>{{ $t('Loading') }}</span>
            </div>
        </LoadingComponent>
        <div v-if="!isLoading" class="my-auto">
            <div class="px-4 py-5">
                <div class="min-h-[calc(100vh-565px)] text-center flex flex-col items-center justify-center">
                    <div class="w-full bg-white rounded-lg shadow-lg md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-700 dark:border-gray-700">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h1 class="mb-8 text-3xl text-center">{{ $t('Register') }}</h1>

                            <div class="mt-4 px-4">
                                <form @submit.prevent="registerSubmit" method="post" action="" class="">
                                    <div class="relative mb-3">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                            <i class="fa-regular fa-user text-success-emphasis"></i>
                                        </div>
                                        <input type="text"
                                               name="name"
                                               v-model="registerForm.name"
                                               class="input-group"
                                               :placeholder="$t('Enter name')"
                                               required
                                        >
                                        <div v-if="errors.name" class="text-red-500 text-sm mt-1">
                                            {{ errors.name[0] }}
                                        </div>
                                    </div>

                                    <div class="relative mb-3">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                            <i class="fa-regular fa-envelope text-success-emphasis"></i>
                                        </div>
                                        <input type="email"
                                               name="email"
                                               v-model="registerForm.email"
                                               class="input-group"
                                               :placeholder="$t('Enter email or phone')"
                                               required
                                        >
                                        <div v-if="errors.email" class="text-red-500 text-sm mt-1">
                                            {{ errors.email[0] }}
                                        </div>
                                    </div>

                                    <div class="relative mb-3">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                            <i class="fa-light fa-address-card text-success-emphasis"></i>
                                        </div>
                                        <input type="text"
                                               name="cpf"
                                               v-model="registerForm.cpf"
                                               class="input-group"
                                               :placeholder="$t('Enter cpf')"
                                               required
                                        >
                                        <div v-if="errors.cpf" class="text-red-500 text-sm mt-1">
                                            {{ errors.cpf[0] }}
                                        </div>
                                    </div>

                                    <div class="relative mb-3">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                            <i class="fa-regular fa-phone"></i>
                                        </div>
                                        <input type="text"
                                               name="phone"
                                               v-maska
                                               data-maska="[
                                    '(##) ####-####',
                                    '(##) #####-####'
                                  ]"
                                               v-model="registerForm.phone"
                                               class="input-group"
                                               :placeholder="$t('Enter your phone')"
                                               required
                                        >
                                        <div v-if="errors.phone" class="text-red-500 text-sm mt-1">
                                            {{ errors.phone[0] }}
                                        </div>
                                    </div>

                                    <div class="relative mb-3">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                            <i class="fa-regular fa-lock text-success-emphasis"></i>
                                        </div>
                                        <input :type="typeInputPassword"
                                               name="password"
                                               v-model="registerForm.password"
                                               class="input-group pr-[40px]"
                                               :placeholder="$t('Type the password')"
                                               required
                                        >
                                        <button type="button" @click.prevent="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3.5 ">
                                            <i v-if="typeInputPassword === 'password'" class="fa-regular fa-eye"></i>
                                            <i v-if="typeInputPassword === 'text'" class="fa-sharp fa-regular fa-eye-slash"></i>
                                        </button>
                                        <div v-if="errors.password" class="text-red-500 text-sm mt-1">
                                            {{ errors.password[0] }}
                                        </div>
                                    </div>

                                    <div class="relative mb-3">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                            <i class="fa-regular fa-lock text-success-emphasis"></i>
                                        </div>
                                        <input :type="typeInputPassword"
                                               name="password_confirmation"
                                               v-model="registerForm.password_confirmation"
                                               class="input-group pr-[40px]"
                                               :placeholder="$t('Confirm the Password')"
                                               required
                                        >
                                        <button type="button" @click.prevent="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3.5">
                                            <i v-if="typeInputPassword === 'password'" class="fa-regular fa-eye"></i>
                                            <i v-if="typeInputPassword === 'text'" class="fa-sharp fa-regular fa-eye-slash"></i>
                                        </button>
                                        <div v-if="errors.password_confirmation" class="text-red-500 text-sm mt-1">
                                            {{ errors.password_confirmation[0] }}
                                        </div>
                                    </div>

                                    <div class="mb-3 mt-5">
                                        <button @click.prevent="isReferral = !isReferral" type="button" class="flex justify-between w-full">
                                            <p>{{ $t('Enter Referral/Promo Code') }}</p>
                                            <div class="">
                                                <i v-if="isReferral" class="fa-solid fa-chevron-up"></i>
                                                <i v-if="!isReferral" class="fa-solid fa-chevron-down"></i>
                                            </div>
                                        </button>

                                        <div v-if="isReferral" class="relative mb-3 mt-1">
                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                                <i class="fa-regular fa-user text-success-emphasis"></i>
                                            </div>
                                            <input type="text" name="reference_code" v-model="registerForm.reference_code" class="input-group" :placeholder="$t('Code')">
                                        </div>
                                    </div>

                                    <hr class="mb-3 mt-2 dark:border-gray-600">

                                    <div class="mb-3 mt-11">
                                        <div class="flex">
                                            <input id="term-a" v-model="registerForm.term_a" name="term_a" required type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="term-a" class="ml-2 text-sm font-medium text-left text-gray-900 dark:text-gray-300">{{ $t('I agree to the User Agreement & confirm I am at least 18 years old') }}</label>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="flex items-center">
                                            <input id="term-agreement" v-model="registerForm.agreement" name="term_b" required type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="term-agreement" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $t('I agree with the') }} <a href="#" class="text-primary hover:underline">{{ $t('terms and conditions') }}</a>.</label>
                                        </div>
                                    </div>

                                    <div class="mt-5 w-full">
                                        <button type="submit" :disabled="isSubmitting" class="ui-button-blue rounded w-full mb-3" :class="{ 'opacity-50 cursor-not-allowed': isSubmitting }">
                                            <span v-if="isSubmitting">{{ $t('Registering...') }}</span>
                                            <span v-else>{{ $t('Register') }}</span>
                                        </button>
                                    </div>
                                </form>

                                <div class="login-wrap mt-5">
                                    <div class="line-text">
                                        <div class="l"></div>
                                        <div class="t">{{ $t('Register with your social networks') }}</div>
                                        <div class="l"></div>
                                    </div>

                                    <div class="social-group mt-3">
                                        <a :href="redirectSocialTo()" class="text-social-button hover:text-white focus:ring-4 focus:outline-none font-medium text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:hover:text-white ">
                                            <i class="fa-brands fa-google"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthLayout>
</template>

<script>
import {useToast} from "vue-toastification";
import {useAuthStore} from "@/Stores/Auth.js";
import HttpApi from "@/Services/HttpApi.js";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import {useRoute, useRouter} from "vue-router";
import {onMounted, reactive} from "vue";
import {useSpinStoreData} from "@/Stores/SpinStoreData.js";
import LoadingComponent from "@/Components/UI/LoadingComponent.vue";

export default {
    props: [],
    components: { LoadingComponent, AuthLayout },
    data() {
        return {
            isLoading: false,
            isSubmitting: false, // Adicionado para controlar o estado de envio
            typeInputPassword: 'password',
            isReferral: false,
            registerForm: {
                name: '',
                email: '',
                password: '',
                cpf: '',
                phone: '', // Movido para cima para melhor ordem
                password_confirmation: '',
                reference_code: '',
                term_a: false,
                agreement: false,
                spin_token: '',
                spin_data: null
            },
            errors: {}
        }
    },
    setup() {
        const router = useRouter();
        const route = useRoute(); // Adicionado para melhor acesso à rota
        const routeParams = reactive({
            code: null,
        });

        onMounted(() => {
            const params = new URLSearchParams(window.location.search);
            if (params.has('code')) {
                routeParams.code = params.get('code');
            }
        });

        return { routeParams, router, route };
    },
    computed: {
        isAuthenticated() {
            const authStore = useAuthStore();
            return authStore.isAuth;
        },
        formIsValid() {
            return (
                this.registerForm.name &&
                this.registerForm.email &&
                this.registerForm.password &&
                this.registerForm.password_confirmation &&
                this.registerForm.cpf &&
                this.registerForm.phone && // Adicionado phone na validação
                this.registerForm.term_a &&
                this.registerForm.agreement &&
                this.registerForm.password === this.registerForm.password_confirmation
            );
        }
    },
    mounted() {
        if(this.isAuthenticated) {
            this.router.push({ name: 'home' });
            return; // Importante: sair da função se já autenticado
        }

        // Tratamento do código de referência melhorado
        const routeCode = this.route.params.code || this.routeParams.code;
        
        if (routeCode) {
            try {
                // Tenta decodificar como base64
                const str = atob(routeCode);
                const obj = JSON.parse(str);
                this.registerForm.spin_token = routeCode;
                this.registerForm.spin_data = obj;
            } catch (e) {
                // Se falhar, trata como código de referência normal
                this.registerForm.reference_code = routeCode;
                this.isReferral = true;
            }
        }
    },
    methods: {
        redirectSocialTo() {
            return '/auth/redirect/google';
        },
        togglePassword() {
            this.typeInputPassword = this.typeInputPassword === 'password' ? 'text' : 'password';
        },
        async registerSubmit(event) {
            event.preventDefault();
            
            // Previne múltiplos envios
            if (this.isSubmitting) {
                return;
            }
            
            if (!this.formIsValid) {
                useToast().error(this.$t('Please fill all required fields correctly'));
                return;
            }

            this.isSubmitting = true;
            this.errors = {};
            const toast = useToast();
            const authStore = useAuthStore();

            try {
                // Preparação do payload com limpeza de dados
                const payload = {
                    name: this.registerForm.name.trim(),
                    email: this.registerForm.email.trim().toLowerCase(),
                    cpf: this.registerForm.cpf.replace(/\D/g, ''),
                    phone: this.registerForm.phone.replace(/\D/g, ''),
                    password: this.registerForm.password,
                    password_confirmation: this.registerForm.password_confirmation,
                    term_a: this.registerForm.term_a,
                    agreement: this.registerForm.agreement
                };

                // Adicionar campos opcionais apenas se existirem
                if (this.registerForm.reference_code) {
                    payload.reference_code = this.registerForm.reference_code;
                }
                
                if (this.registerForm.spin_token) {
                    payload.spin_token = this.registerForm.spin_token;
                }
                
                if (this.registerForm.spin_data) {
                    payload.spin_data = this.registerForm.spin_data;
                }

                console.log('Enviando payload:', payload); // Debug

                const response = await HttpApi.post('auth/register', payload);
                
                console.log('Resposta recebida:', response.data); // Debug
                
                if(response.data && response.data.access_token) {
                    authStore.setToken(response.data.access_token);
                    authStore.setUser(response.data.user);
                    authStore.setIsAuth(true);

                    // Reset do formulário
                    this.resetForm();

                    toast.success(this.$t('Your account has been created successfully'));
                    
                    // Aguarda um pouco antes de redirecionar
                    setTimeout(() => {
                        this.router.push({ name: 'profileDeposit' });
                    }, 1000);
                } else {
                    throw new Error('Token de acesso não recebido');
                }
                
            } catch (error) {
                console.error('Erro no registro:', error); // Debug
                
                if (error.response) {
                    // Erro do servidor
                    const status = error.response.status;
                    const data = error.response.data;

                    console.log('Status:', status);
                    console.log('Resposta do erro:', data);
                    
                    if (status === 422 && data.errors) {
                        // Erros de validação
                        this.errors = data.errors;
                        Object.values(data.errors).flat().forEach(msg => {
                            toast.error(msg);
                        });
                    } else if (status === 429) {
                        // Rate limit
                        toast.error(this.$t('Too many attempts. Please try again later.'));
                    } else {
                        // Outros erros do servidor
                        toast.error(data.message || this.$t('Registration failed. Please try again.'));
                    }
                } else if (error.request) {
                    // Erro de rede
                    toast.error(this.$t('Network error. Please check your connection.'));
                } else {
                    // Outros erros
                    toast.error(this.$t('An unexpected error occurred.'));
                }
            } finally {
                this.isSubmitting = false;
            }
        },
        resetForm() {
            this.registerForm = {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                cpf: '',
                phone: '',
                reference_code: '',
                term_a: false,
                agreement: false,
                spin_token: '',
                spin_data: null
            };
            this.errors = {};
        }
    }
};
</script>

<style scoped>
/* Adicione estilos específicos se necessário */
</style>