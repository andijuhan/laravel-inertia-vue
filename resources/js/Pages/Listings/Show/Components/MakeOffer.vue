<template>
    <Box>
        <template #header> Make an offer </template>
        <div>
            <form @submit.prevent="makeOffer">
                <input v-model.number="form.amount" type="text" class="input" />
                <input
                    v-model.number="form.amount"
                    class="w-full h-4 mt-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                    type="range"
                    :min="min"
                    :max="max"
                    step="10000"
                />
                <button
                    :disabled="form.processing"
                    type="submit"
                    class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed w-full text-sm mt-2"
                >
                    Make an Offer
                </button>
                <div class="input-error" v-if="form.errors.amount">
                    {{ form.errors.amount }}
                </div>
            </form>
        </div>
        <div class="flex justify-between text-gray-500 mt-2">
            <div>Difference</div>
            <div>
                <Price :price="difference" />
            </div>
        </div>
    </Box>
</template>

<script setup>
import Price from "@/Components/Price.vue";
import Box from "@/Components/UI/Box.vue";
import { useForm } from "@inertiajs/vue3";
import { debounce } from "lodash";
import { computed, watch } from "vue";

const props = defineProps({
    listingId: Number,
    price: Number,
});

const form = useForm({
    amount: props.price,
});

const difference = computed(() => form.amount - props.price);
const min = computed(() => Math.round(props.price / 2));
const max = computed(() => Math.round(props.price * 2));

const makeOffer = () =>
    form.post(route("listing.offer.store", props.listingId), {
        preserveScroll: true,
        preserveState: true,
    });

const emit = defineEmits(["offerUpdated"]);

watch(
    () => form.amount,
    debounce((value) => emit("offerUpdated", value), 500)
);
</script>
