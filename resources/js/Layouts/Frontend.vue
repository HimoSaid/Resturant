<script setup>
import Header from "@/Components/Frontend/Header.vue";
import Footer from "@/Components/Frontend/Footer.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>
<template>
    <div class="bg-slate-200 dark:bg-slate-900">
        <Header :can-login="canLogin" :can-register="canRegister" />
        <main class="min-h-screen">
            <slot />
        </main>
        <Footer />
    </div>
</template>
