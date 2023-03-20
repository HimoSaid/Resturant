<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import TextAreaInput from "@/Components/TextAreaInput.vue";
import AutocompleteInput from "@/Components/AutocompleteInput.vue";

import { Head, useForm, router } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";

const props = defineProps({ category: Object, categories: Array });

let listCategories = ref(props.categories);

const form = useForm({
    name: props.category.name,
    summary: props.category.summary,
    bounce: props.category.bounce,
    parent_id: props.category.parent_id,
});
const submit = () => {
    router.post(
        route("categories.update", props.category.id),
        Object.assign(
            {
                _method: "put",
            },
            form
        )
    );
};
let loading = ref(false);
const search = (searchQuery) => {
    loading = true;
    router.get(
        route("categories.edit", props.category.id),
        { search: searchQuery, value: form.parent_id },
        { replace: true, preserveState: true, preserveScroll: true }
    );
    loading = false;
};

const isLoading = () => {};
</script>
<template>
    <Head title="Edit Category" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"
            >
                Edit Category
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg max-w-xl mx-auto"
                >
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <form @submit.prevent="submit">
                            <div>
                                <AutocompleteInput
                                    name="parent_id"
                                    label="Follow to Category"
                                    :options="listCategories"
                                    label-field="name"
                                    value-field="id"
                                    v-model="form.parent_id"
                                    @search="search"
                                    @loading="isLoading"
                                ></AutocompleteInput>
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.parent_id"
                                />
                            </div>
                            <div>
                                <InputLabel for="name" value="Name" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    autofocus
                                    autocomplete="name"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.name"
                                />
                            </div>
                            <div>
                                <InputLabel for="summary" value="summary" />

                                <TextAreaInput
                                    id="summary"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.summary"
                                    autofocus
                                    autocomplete="summary"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.summary"
                                />
                            </div>
                            <div>
                                <InputLabel for="bounce" value="Bounce" />

                                <TextInput
                                    id="bounce"
                                    type="number"
                                    class="mt-1 block w-full"
                                    v-model="form.bounce"
                                    autofocus
                                    autocomplete="bounce"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.bounce"
                                />
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <PrimaryButton
                                    class="ml-4"
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Update Category
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
