<template>
    <div>
        <label
            class="block font-medium text-sm text-gray-700 dark:text-gray-300"
            :for="name"
            >{{ label }}</label
        >
        <div class="relative">
            <input
                type="text"
                :id="name"
                v-model="searchQuery"
                class="block w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                :placeholder="placeholder"
                @input="fetchOptions"
            />
            <ul
                v-if="showOptions && filteredOptions.length"
                class="absolute left-0 right-0 mt-1 py-2 bg-white border rounded z-10"
            >
                <li
                    v-for="option in filteredOptions"
                    :key="option.id"
                    class="px-2 py-1 cursor-pointer hover:bg-gray-100"
                    @click="selectOption(option)"
                >
                    {{ option[labelField] }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        name: {
            type: String,
            required: true,
        },
        label: {
            type: String,
            default: "Label",
        },
        placeholder: {
            type: String,
            default: "Type to search...",
        },
        noOptionsText: {
            type: String,
            default: "No matching options.",
        },
        options: {
            type: Array,
            required: true,
        },

        modelValue: {
            type: Number,
        },
        labelField: {
            type: String,
            default: "label",
        },
        valueField: {
            type: String,
            default: "value",
        },
    },
    data() {
        return {
            searchQuery: "",
            showOptions: false,
            selectedOption: null,
            loading: false,
        };
    },
    computed: {
        filteredOptions() {
            if (!this.searchQuery) {
                return [];
            }
            const search = this.searchQuery.toLowerCase();
            return this.options.filter(
                (option) =>
                    option[this.labelField].toLowerCase().indexOf(search) !== -1
            );
        },
    },
    watch: {
        modelValue(newValue) {
            this.selectedOption = newValue;
            let el = this.options.find(
                (option) => option[this.valueField] == newValue
            );
            if (el) {
                this.searchQuery = el[this.labelField];
            }
        },
        //export value // recive : value
        //procceing i have word search
    },
    emits: ["update:modelValue", "loading", "search"],
    methods: {
        selectOption(option) {
            this.selectedOption = option;
            this.searchQuery = option[this.labelField];
            this.showOptions = false;
            // this.$emit("input", option[this.valueField]);
            this.$emit("update:modelValue", option[this.valueField]);
        },
        async fetchOptions() {
            if (this.loading) {
                return "";
            }
            if (!this.searchQuery) {
                return [];
            }
            this.showOptions = true;
            setTimeout(() => {
                this.loading = true;
                this.$emit("loading", true);
                this.$emit("search", this.searchQuery);
                this.loading = false;
            }, 600);

            // this.options = response;
            this.showOptions = true;
            this.$emit("loading", false);
        },
    },
    mounted() {
        let el = this.options.find(
            (option) => option[this.valueField] == this.modelValue
        );
        if (el) {
            this.searchQuery = el[this.labelField];
        }
    },
};
</script>
