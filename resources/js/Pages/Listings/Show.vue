<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-2">
        <Box class="md:col-span-7 flex items-center justify-center">
            <div
                v-if="listing.images.length"
                class="grid grid-cols-2 gap-1 w-full"
            >
                <img
                    v-for="image in listing.images"
                    :key="image.id"
                    :src="image.src"
                    alt=""
                    class="h-[250px] w-full rounded-md object-cover object-center"
                />
            </div>
            <div v-else class="font-medium text-gray-500">No images</div>
        </Box>
        <div class="flex flex-col md:col-span-5 gap-2">
            <Box>
                <template #header> Basic info </template>
                <Price :price="listing.price" class="text-2xl font-bold" />
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-gray-500" />
            </Box>

            <Box>
                <template #header> Monthly Payment </template>
                <div>
                    <label class="label" for=""
                        >Interest rate ({{ interestRate }}%)</label
                    >
                    <input
                        v-model.number="interestRate"
                        class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                        type="range"
                        min="0.1"
                        max="30"
                        step="0.1"
                    />

                    <label class="label" for=""
                        >Duration ({{ duration }} years)</label
                    >
                    <input
                        v-model.number="duration"
                        class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
                        type="range"
                        min="0.1"
                        max="30"
                        step="0.1"
                    />
                    <div class="text-gray-600 dark:text-gray-300 mt-2">
                        <div class="text-gray-400">Your monthly payment</div>
                        <Price :price="monthlyPayment" class="text-3xl" />
                    </div>

                    <div class="mt-2 text-gray-500">
                        <div class="flex justify-between">
                            <div>Total Paid</div>
                            <div>
                                <Price :price="totalPaid" class="font-medium" />
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <div>Principal Paid</div>
                            <div>
                                <Price
                                    :price="listing.price"
                                    class="font-medium"
                                />
                            </div>
                        </div>

                        <div class="flex justify-between">
                            <div>Total Interest</div>
                            <div>
                                <Price
                                    :price="totalInterest"
                                    class="font-medium"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </Box>
            <MakeOffer
                v-if="user"
                @offer-updated="offer = $event"
                :listing-id="listing.id"
                :price="listing.price"
            />
        </div>
    </div>
</template>

<script setup>
import ListingAddress from "@/Components/ListingAddress.vue";
import ListingSpace from "@/Components/ListingSpace.vue";
import Price from "@/Components/Price.vue";
import Box from "@/Components/UI/Box.vue";

import { computed, ref } from "vue";
import { useMonthlyPayment } from "@/Composables/useMonthlyPayment";
import MakeOffer from "./Show/Components/MakeOffer.vue";
import { usePage } from "@inertiajs/vue3";

const interestRate = ref(2.5);
const duration = ref(20);

const page = usePage();
const props = defineProps({
    listing: Object,
});

const offer = ref(props.listing.price);

const user = computed(() => page.props.user);

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(
    offer,
    interestRate,
    duration
);
</script>
