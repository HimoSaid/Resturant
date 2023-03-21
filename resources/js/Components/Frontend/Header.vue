<script setup>
import { Link } from "@inertiajs/vue3";

import { ref } from "vue";
let showMobileMenu = ref("false");
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>
<template>
    <header>
        <nav
            class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800"
        >
            <div
                class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl"
            >
                <a href="https://flowbite.com" class="flex items-center">
                    <img
                        src="logo.png"
                        class="mr-3 h-6 sm:h-9"
                        alt="Flowbite Logo"
                    />
                    <span
                        class="self-center text-xl font-semibold whitespace-nowrap dark:text-white"
                        >Flavorsome Fare</span
                    >
                </a>
                <div
                    class="justify-between items-center w-full lg:flex lg:w-auto lg:order-1"
                    :class="{ hidden: showMobileMenu }"
                    id="mobile-menu-2"
                >
                    <ul
                        class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0"
                    >
                        <li>
                            <a
                                href="#home"
                                class="block py-2 pr-4 pl-3 text-gray-700 rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 dark:text-white"
                                aria-current="page"
                                >Home</a
                            >
                        </li>
                        <li>
                            <a
                                href="#categories"
                                class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700"
                                >Categories</a
                            >
                        </li>
                        <li>
                            <a
                                href="#items"
                                class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700"
                                >Items</a
                            >
                        </li>
                        <li>
                            <a
                                href="#contact"
                                class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700"
                                >Contact</a
                            >
                        </li>
                    </ul>
                </div>
                <div
                    class="justify-between w-full lg:flex lg:w-auto lg:order-1"
                >
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                        >Dashboard</Link
                    >

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                            >Log in</Link
                        >

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                            >Register</Link
                        >
                    </template>
                </div>
            </div>
        </nav>
    </header>
</template>
