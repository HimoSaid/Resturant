<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";

defineProps({ categories: Object });
let currentTab = ref(null);
</script>
<template>
    <div
        class="mb-4 border-b border-gray-200 dark:border-gray-700 mx-auto max-w-7xl"
    >
        <ul
            class="flex flex-wrap -mb-px text-sm font-medium text-center justify-center"
            id="myTab"
            data-tabs-toggle="#myTabContent"
            role="tablist"
        >
            <li
                class="mr-2"
                role="presentation"
                v-for="(category, key) in categories.data"
                :key="category.id"
            >
                <Link
                    :href="route('welcome', { category: category.name })"
                    preserveState
                    preserveScroll
                    as="button"
                    class="inline-block p-4 border-b-2 rounded-t-lg"
                    :id="category.name.replace(' ', '_') + '-tab'"
                >
                    {{ category.name }}
                </Link>
            </li>
        </ul>
    </div>
</template>
