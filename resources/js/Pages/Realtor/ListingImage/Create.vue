<template>
    <Box>
        <template #header> Upload New Images </template>
        <form @submit.prevent="upload">
            <section class="flex gap-2 items-center my-4">
                <input
                    class="border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700 dark:file:text-gray-400 file:border-0 file:bg-gray-100 dark:file:bg-gray-800 file:hover:bg-gray-200"
                    type="file"
                    multiple
                    @input="addFiles"
                />
                <button
                    :disabled="form.processing"
                    class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed"
                    type="submit"
                >
                    Upload
                </button>
                <button @click="reset" class="btn-outline" type="reset">
                    Reset
                </button>
            </section>
            <div v-if="imageErorrs.length" class="input-error">
                <div v-for="(error, index) in imageErorrs" :key="index">
                    {{ error }}
                </div>
            </div>
        </form>
    </Box>

    <Box v-if="listing.images.length" class="mt-4">
        <template #header> Listing Images </template>
        <section
            class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"
        >
            <div
                v-for="image in listing.images"
                :key="image.id"
                class="flex flex-col gap-2"
            >
                <img
                    :src="image.src"
                    alt=""
                    class="w-full h-[300px] object-cover object-center rounded-md"
                />
                <Link
                    :href="
                        route('realtor.listing.image.destroy', [
                            listing.id,
                            image.id,
                        ])
                    "
                    method="delete"
                    class="btn-outline text-xs font-medium"
                    >Delete</Link
                >
            </div>
        </section>
    </Box>
</template>

<script setup>
import Box from "@/Components/UI/Box.vue";
import { useForm, Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
    listing: Object,
});

const form = useForm({
    images: [],
});

const imageErorrs = computed(() => Object.values(form.errors));

const upload = () =>
    form.post(route("realtor.listing.image.store", props.listing.id), {
        onSuccess: () => form.reset("images"),
    });

const addFiles = (event) => {
    for (const image of event.target.files) {
        form.images.push(image);
    }
};

const reset = () => form.reset("images");
</script>
