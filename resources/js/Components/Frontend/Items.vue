<script setup>
import { ref } from "vue";
defineProps({ items: Object });
</script>
<template>
    <!-- ====== Cards Section Start -->
    <section class="bg-[#F3F4F6] pt-20 pb-10 lg:pt-[120px] lg:pb-20">
        <div class="container mx-auto">
            <div class="-mx-4 flex flex-wrap">
                <div
                    v-for="(item, key) in items.data"
                    :key="item.id"
                    class="w-full px-4 md:w-1/2 xl:w-1/3"
                >
                    <div class="mb-10 overflow-hidden rounded-lg bg-white">
                        <img
                            src="images/noodles.jpg"
                            alt="noodles"
                            class="w-full"
                        />
                        <div class="p-8 text-center sm:p-9 md:p-7 xl:p-9">
                            <h3>
                                <a
                                    class="text-dark hover:text-primary mb-4 block text-xl font-semibold sm:text-[22px] md:text-xl lg:text-[22px] xl:text-xl 2xl:text-[22px]"
                                >
                                    {{ item.name }}
                                </a>
                            </h3>
                            <p
                                class="text-body-color mb-7 text-base leading-relaxed"
                            >
                                {{ item.summary }}
                            </p>
                            <span
                                class="text-body-color hover:border-primary hover:bg-primary inline-block rounded-full border border-[#E5E7EB] py-2 px-7 text-base font-medium transition hover:text-white"
                            >
                                {{
                                    item.compute_bounce
                                        ? item.compute_bounce + "%"
                                        : "%"
                                }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Cards Section End -->
</template>
