<template>
    <h1 class="text-3xl mb-4">Your Listings</h1>
    <section>
        <RealtorFilters :filters="filters" />
    </section>
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <Box v-for="listing in listings.data" :key="listing.id">
            <div
                class="flex flex-col md:flex-row gap-2 md:items-center justify-between"
            >
                <div>
                    <div
                        v-if="listing.sold_at"
                        class="text-xs font-medium border border-green-300 text-green-500 rounded-md p-1 inline-block uppercase mb-2"
                    >
                        Sold
                    </div>
                    <div class="xl:flex items-center gap-2">
                        <Price
                            :price="listing.price"
                            class="text-xl font-medium"
                        />
                        <ListingSpace :listing="listing" />
                    </div>
                    <ListingAddress :listing="listing" class="text-gray-500" />
                </div>
                <section>
                    <div
                        class="flex items-center gap-1 text-gray-600 dark:text-gray-300"
                    >
                        <a
                            v-if="!listing.deleted_at"
                            :href="route('listing.show', listing.id)"
                            target="_blank"
                            class="btn-outline text-xs font-medium"
                            >Preview</a
                        >
                        <Link
                            v-if="!listing.deleted_at"
                            :href="route('realtor.listing.edit', listing.id)"
                            class="btn-outline text-xs font-medium"
                            >Edit</Link
                        >
                        <Link
                            v-if="listing.deleted_at"
                            :href="route('realtor.listing.restore', listing.id)"
                            method="put"
                            class="btn-outline text-xs font-medium"
                            >Restore</Link
                        >
                        <Link
                            class="btn-outline text-xs font-medium"
                            :href="route('realtor.listing.destroy', listing.id)"
                            method="delete"
                        >
                            Delete
                        </Link>
                    </div>
                    <div class="mt-2">
                        <Link
                            :href="
                                route(
                                    'realtor.listing.image.create',
                                    listing.id
                                )
                            "
                            class="btn-outline flex items-center justify-center flex-grow text-xs font-medium"
                            >Images ({{ listing.images_count }})</Link
                        >
                    </div>
                    <div class="mt-2">
                        <Link
                            :href="route('realtor.listing.show', listing.id)"
                            class="btn-outline flex items-center justify-center flex-grow text-xs font-medium"
                            >Offers ({{ listing.offers_count }})</Link
                        >
                    </div>
                </section>
            </div>
        </Box>
    </section>
    <div v-if="listings.data.length" class="w-full flex justify-center my-8">
        <Pagination :links="listings.links" />
    </div>
    <EmptyState v-else>No Listings yet.</EmptyState>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import ListingAddress from "@/Components/ListingAddress.vue";
import ListingSpace from "@/Components/ListingSpace.vue";
import Price from "@/Components/Price.vue";
import Box from "@/Components/UI/Box.vue";
import RealtorFilters from "./Index/Components/RealtorFilters.vue";
import Pagination from "@/Components/UI/Pagination.vue";
import EmptyState from "@/Components/UI/EmptyState.vue";

defineProps({
    listings: Object,
    filters: Object,
});
</script>
