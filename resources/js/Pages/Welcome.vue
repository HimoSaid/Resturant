<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Frontend from "@/Layouts/Frontend.vue";
import Hero from "@/Components/Frontend/Hero.vue";
import Sections from "@/Components/Frontend/Sections.vue";
import Items from "@/Components/Frontend/Items.vue";
import ContactUs from "@/Components/Frontend/ContactUs.vue";

// defineProps({
//     canLogin: Boolean,
//     canRegister: Boolean,
// });
defineProps({
    sub_categories: Object,
    categories: Object,
    items: Object,
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <Head title="Resturant Menu" />
    <Frontend :can-login="canLogin" :can-register="canRegister">
        <!-- Hero -->
        <Hero />
        <div id="categories">
            <Sections :categories="categories" />
            <Sections :categories="sub_categories" />
        </div>
        <div id="items">
            <Items :items="items" />
        </div>
        <div id="contact">
            <ContactUs />
        </div>
    </Frontend>
</template>
