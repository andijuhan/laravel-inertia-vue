<template>
    <form @submit.prevent="create">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-2">
                <label class="label" for="">Beds</label>
                <input class="input" v-model.number="form.beds" type="text" />
                <span class="input-error" v-if="form.errors.beds">
                    {{ form.errors.beds }}
                </span>
            </div>
            <div class="col-span-2">
                <label class="label" for="">Baths</label>
                <input class="input" v-model.number="form.baths" type="text" />
                <span class="input-error" v-if="form.errors.baths">
                    {{ form.errors.baths }}
                </span>
            </div>
            <div class="col-span-2">
                <label class="label" for="">Area</label>
                <input class="input" v-model.number="form.area" type="text" />
                <span class="input-error" v-if="form.errors.area">
                    {{ form.errors.area }}
                </span>
            </div>
            <div class="col-span-4">
                <label class="label" for="">City</label>
                <input class="input" v-model="form.city" type="text" />
                <span class="input-error" v-if="form.errors.city">
                    {{ form.errors.city }}
                </span>
            </div>
            <div class="col-span-2">
                <label class="label" for="">Code</label>
                <input class="input" v-model="form.code" type="text" />
                <span class="input-error" v-if="form.errors.code">
                    {{ form.errors.code }}
                </span>
            </div>
            <div class="col-span-4">
                <label class="label" for="">Street</label>
                <input class="input" v-model="form.street" type="text" />
                <span class="input-error" v-if="form.errors.street">
                    {{ form.errors.street }}
                </span>
            </div>
            <div class="col-span-2">
                <label class="label" for="">Street Number</label>
                <input class="input" v-model="form.street_number" type="text" />
                <span class="input-error" v-if="form.errors.street_number">
                    {{ form.errors.street_number }}
                </span>
            </div>
            <div class="col-span-6">
                <label class="label" for="">Price</label>
                <input class="input" v-model="form.price" type="text" />
                <span class="input-error" v-if="form.errors.price">
                    {{ form.errors.price }}
                </span>
            </div>
            <div class="col-span-6">
                <button class="btn-primary" type="submit">Create</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    beds: 0,
    baths: 0,
    area: 0,
    city: null,
    code: null,
    street: null,
    street_number: null,
    price: 0,
});

const create = () => form.post(route("realtor.listing.store"));
</script>

<style scoped>
label {
    margin-right: 2em;
}
div {
    padding: 2px;
}
</style>
