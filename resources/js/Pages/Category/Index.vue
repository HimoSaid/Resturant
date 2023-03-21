<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({ categories: Object });
</script>

<template>
    <Head title="Categories" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Categories
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end">
                    <Link
                        :href="route('categories.create')"
                        as="button"
                        type="button"
                        class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"
                        >New Category</Link
                    >
                </div>
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
                >
                    <!--DataTable -->

                    <div
                        class="relative overflow-x-auto shadow-md sm:rounded-lg"
                    >
                        <table
                            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                        >
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                            >
                                <tr>
                                    <th scope="col" class="px-6 py-3">#ID</th>
                                    <th scope="col" class="px-6 py-3">Name</th>
                                    <th scope="col" class="px-6 py-3">
                                        Follow
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Compute Bounce
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Bounce
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="category in categories.data"
                                    :key="category.id"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                                >
                                    <td class="px-6 py-4">{{ category.id }}</td>
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        {{ category.name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ category.parent?.name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ category.compute_bounce }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ category.bounce }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <Link
                                            :href="
                                                route(
                                                    'categories.edit',
                                                    category.id
                                                )
                                            "
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                            >Edit</Link
                                        >
                                        /
                                        <Link
                                            :href="
                                                route(
                                                    'categories.destroy',
                                                    category.id
                                                )
                                            "
                                            preserve-state
                                            preserve-scroll
                                            method="delete"
                                            class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                            >Delete</Link
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <nav
                            class="mb-2 mr-2 flex items-center justify-between pt-4"
                            aria-label="Table navigation"
                        >
                            <span
                                class="ml-2 text-sm font-normal text-gray-500 dark:text-gray-400"
                                >Showing
                                <span
                                    class="font-semibold text-gray-900 dark:text-white"
                                    >{{ categories.meta.from }}-{{
                                        categories.meta.to
                                    }}</span
                                >
                                of
                                <span
                                    class="font-semibold text-gray-900 dark:text-white"
                                    >{{ categories.meta.total }}</span
                                ></span
                            >
                            <ul class="inline-flex items-center -space-x-px">
                                <li v-if="categories.links.prev">
                                    <Link
                                        :href="categories.links.prev"
                                        class="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                        preserve-scroll
                                    >
                                        <span class="sr-only">Previous</span>
                                        <svg
                                            class="w-5 h-5"
                                            aria-hidden="true"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                    </Link>
                                </li>

                                <li v-if="categories.links.next">
                                    <Link
                                        :href="categories.links.next"
                                        class="block px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                        preserve-scroll
                                    >
                                        <span class="sr-only">Next</span>
                                        <svg
                                            class="w-5 h-5"
                                            aria-hidden="true"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"
                                            ></path>
                                        </svg>
                                    </Link>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
