<script setup lang="ts">
    import { router } from '@inertiajs/vue3';
    import { reactive, ref } from 'vue';
    import { LoginRequest } from '../http/requests/LoginRequest';
    import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
    import { faRefresh, faSignIn } from '@fortawesome/free-solid-svg-icons';
    import { AuthService } from '../http/service/AuthService';

    const request: LoginRequest = reactive(new LoginRequest);
    const authService = new AuthService;
    const spin = ref<boolean>(false);

    const login = async () => {
        spin.value = true;
        try {
            const errors = request.validate();
            if(Object.keys(errors).length > 0){
                console.error('Validation errors:', request.errors.password);
                return;
            }
            await authService.login(request.email, request.password, request.rememberMe);

            router.visit('/event');
            
        } catch (error: unknown) {
            if(error instanceof Error) {
                request.errors.password = [error.message];
            } else {
                console.error('An unknown error occurred during login.', error);
            }
        } finally {
            spin.value = false;
        }
    }
</script>

<template>
    <div class="flex h-screen items-center justify-center bg-red-300 px-4">
        <div class="rounded-lg border border-white bg-white p-2 shadow-lg w-full md:w-1/2 lg:w-1/3">
            <h1 class="text-xl font-bold text-center">Ingresar</h1>
            <hr class="text-gray-300 my-1">
            <div class="flex flex-col gap-2 mb-3">
                <div class="flex gap-2">
                    <span class="hidden">Email:</span>
                    <div class="flex flex-col w-full">
                        <input
                            type="text"
                            class="w-full border border-gray-300 rounded-md px-2 py-1"
                            placeholder="Email"
                            v-model="request.email"
                        >
                        <small class="text-red-500 italic" v-for="errors in request.errors.email">
                            {{ errors }}
                        </small>
                    </div>
                </div>
                <div class="flex gap-2">
                    <span class="hidden">Password:</span>
                    <div class="flex flex-col w-full">
                        <input 
                            type="password"
                            class="w-full border border-gray-300 rounded-md px-2 py-1"
                            placeholder="Password"
                            v-model="request.password"
                        >
                        <small class="text-red-500 italic" v-for="errors in request.errors.password">
                            {{ errors }}
                        </small>
                    </div>
                </div>
                <div class="flex gap-1 items-center justify-center">
                    <input 
                        type="checkbox"
                        class=""
                        v-model="request.rememberMe"
                    >
                    <span class="">Recuérdame:</span>
                </div>
            </div>
            <div class="w-full flex items-center justify-center">
                <button class="border border-sky-300 bg-sky-400 text-center px-2 py-1 rounded-md cursor-wait flex items-center justify-center gap-1"
                    v-if="spin"
                >
                    <FontAwesomeIcon :icon="faRefresh" class="animate-spin" />
                    <span class="font-medium text-shadow-sm">Ingresando...</span>
                </button>
                <button
                    v-else
                    class="border border-sky-300 bg-sky-300 text-center px-2 py-1 rounded-md cursor-pointer flex items-center justify-center gap-1"
                    @click="login"
                >
                    <FontAwesomeIcon :icon="faSignIn" class="size-4" />
                    <span class="font-medium text-shadow-sm">Ingresar</span>
                </button>

            </div>
        </div>
    </div>
</template>