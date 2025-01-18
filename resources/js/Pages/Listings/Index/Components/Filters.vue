<template>
    <form @submit.prevent="filter">
        <div class="mt-4 mb-8 flex flex-wrap gap-4">
            <div class="flex flex-nowrap items-center">
                <input
                    v-model.number="form.price_from"
                    class="input-filter-l w-28"
                    type="text"
                    placeholder="Price from"
                />
                <input
                    v-model.number="form.price_to"
                    class="input-filter-r w-28"
                    type="text"
                    placeholder="Price to"
                />
            </div>
            <div class="flex flex-nowrap items-center">
                <select v-model="form.beds" class="input-filter-l w-24">
                    <option :value="null">Beds</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                    <option :value="6">6+</option>
                </select>
                <select v-model="form.baths" class="input-filter-r w-24">
                    <option :value="null">Baths</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                    <option :value="6">6+</option>
                </select>
            </div>
            <div class="flex flex-nowrap items-center">
                <input
                    v-model.number="form.area_from"
                    type="text"
                    class="input-filter-l w-28"
                    placeholder="Area from"
                />
                <input
                    v-model.number="form.area_to"
                    type="text"
                    class="input-filter-r w-28"
                    placeholder="Area to"
                />
            </div>
            <div class="flex flex-nowrap items-center gap-2">
                <button class="btn" type="submit">Filter</button>
                <button @click="clear" class="btn-ghost" type="reset">
                    Clear
                </button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    filters: Object,
});

const form = useForm({
    price_from: props.filters.price_from ?? null,
    price_to: props.filters.price_to ?? null,
    beds: props.filters.beds ?? null,
    baths: props.filters.baths ?? null,
    area_from: props.filters.area_from ?? null,
    area_to: props.filters.area_to ?? null,
});

const filter = () => {
    form.get(route("listing.index"), {
        preserveState: true,
        preserveScroll: true,
    });
};

const clear = () => {
    form.beds = null;
    form.baths = null;
    form.price_from = null;
    form.price_to = null;
    form.area_from = null;
    form.area_to = null;
    filter();
};
</script>
