<script setup lang="ts">
    import { AuthService } from '../auth/http/service/AuthService';
    import { faBars, faJedi, faPhone, faUser } from '@fortawesome/free-solid-svg-icons';
    import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
    import { onMounted, ref } from 'vue';
    import { onClickOutside } from '@vueuse/core';
    import { router } from '@inertiajs/vue3';
    import { UserResponse } from '@/application/auth/responses/UserResponse';
    import { Link } from '@inertiajs/vue3';
import { faArrowAltCircleLeft } from '@fortawesome/free-regular-svg-icons/faArrowAltCircleLeft';

    const authService = new AuthService;

    const user = ref<UserResponse | null>(null);
    const userMenu = ref<boolean>(false);
    const userMenuRef = ref<HTMLElement | null>(null);
    const sideMenu = ref<boolean>(false);
    const sideMenuRef = ref<HTMLElement | null>(null);

    onClickOutside(userMenuRef, () => {
        userMenu.value = false;
    });

    onClickOutside(sideMenuRef, () => {
        sideMenu.value = false;
    });

    const handleLogout = async () => {
        await authService.logout();
        router.visit('/');
    }

    onMounted(() => {
        (async () => {
            if(!user.value){
                user.value = await authService.user();
            }
        })();
    });
</script>

<template>
    <div class="flex flex-col h-screen bg-sky-200 md:px-4 md:py-1">
        <div class="w-full bg-indigo-500 p-2 md:rounded-md flex gap-1 items-center">
            <span class="bg-white rounded-md p-1 whitespace-nowrap flex flex-row items-center gap-1">
                <FontAwesomeIcon :icon="faJedi" class="text-indigo-500" />
                <span class="text-indigo-500 tracking-wide font-semibold ">RECSA</span>
            </span>
            <div ref="sideMenuRef" class="relative flex flex-col w-fit">
                <span class="bg-transparent rounded-md p-1 border border-white cursor-pointer w-[2rem] text-center lg:hidden" @click="sideMenu = !sideMenu">
                    <FontAwesomeIcon :icon="faBars" class="text-white" />
                </span>
                <div v-if="sideMenu" class="rounded-sm bg-indigo-500 p-1 w-[70vw] sm:w-[30vw] border border-indigo-500 bg-sky-200 fixed left-0 md:left-4 top-12 lg:hidden">
                    <ul class="gap-1 flex flex-col">
                        <Link class="block text-white bg-indigo-400 px-2 py-1 w-full cursor-pointer rounded-sm flex gap-1 items-center" href="/event" >
                            <FontAwesomeIcon :icon="faPhone" />
                            <span class="font-medium tracking-wide text-shadow-md">Evento</span>
                        </Link>
                    </ul>
                </div>
            </div>
            <div ref="userMenuRef" class="relative ms-auto flex flex-col whitespace-nowrap">
                <span class="bg-transparent rounded-full p-1 border border-white cursor-pointer" @click="userMenu = !userMenu">
                    <FontAwesomeIcon :icon="faUser" class="text-white" />
                    <small class="text-xs text-white text-shadow-md">{{ user?.name }}</small>
                </span>
                <div v-if="userMenu" class="rounded-sm bg-indigo-500 absolute p-1 w-[10rem] -bottom-9 -right-2 border border-indigo-500 bg-sky-200">
                    <p class="text-indigo-500 text-shadow-md w-full cursor-pointer" @click="handleLogout">Salir</p>
                </div>
            </div>
        </div>
        <div class="flex gap-2 w-full h-screen">
            <div class="rounded-md bg-indigo-500 p-1 border border-sky-200 w-64 h-full shadow-2xl hidden lg:block">
                <ul class="w-full gap-1 flex flex-col h-full">
                    <Link class="block text-white bg-indigo-400 px-2 py-1 w-full cursor-pointer rounded-sm flex gap-1 items-center" href="/event" >
                        <FontAwesomeIcon :icon="faPhone" />
                        <span class="font-medium tracking-wide text-shadow-md">Evento</span>
                    </Link>
                    <div class="px-2 py-1 w-full flex gap-1 items-center justify-center mt-auto relative" >
                        <hr class="absolute w-full text-indigo-400">
                        <FontAwesomeIcon :icon="faArrowAltCircleLeft" class="text-xl bg-indigo-500 z-10 text-indigo-400 cursor-pointer" />
                    </div>
                </ul>
            </div>
            <div class="flex-1">
                <slot  />
            </div>
        </div>
    </div>
</template>