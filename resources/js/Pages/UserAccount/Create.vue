<template>
    <form @submit.prevent="register">
        <div class="w-1/2 mx-auto flex flex-col gap-4">
            <div>
                <label for="name" class="label">Name</label>
                <input
                    v-model="form.name"
                    type="text"
                    id="name"
                    class="input"
                />
                <div class="input-error" v-if="form.errors.name">
                    {{ form.errors.name }}
                </div>
            </div>
            <div>
                <label for="email" class="label">E-mail</label>
                <input
                    v-model="form.email"
                    type="text"
                    id="email"
                    class="input"
                />
                <div class="input-error" v-if="form.errors.email">
                    {{ form.errors.email }}
                </div>
            </div>
            <div>
                <label for="password" class="label">Password</label>
                <input
                    v-model="form.password"
                    type="password"
                    id="password"
                    class="input"
                />
                <div class="input-error" v-if="form.errors.password">
                    {{ form.errors.password }}
                </div>
            </div>
            <div>
                <label for="password_confirmation" class="label"
                    >Confirm Password</label
                >
                <input
                    v-model="form.password_confirmation"
                    type="password"
                    id="password_confirmation"
                    class="input"
                />
            </div>
            <div>
                <button type="submit" class="btn-primary w-full">
                    Create Account
                </button>

                <div class="mt-2 text-center">
                    <Link :href="route('login')" class="text-sm text-gray-500">
                        Already have an account? Sign-In
                    </Link>
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm, Link } from "@inertiajs/vue3";

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
});

const register = () => form.post(route("user-account.store"));
</script>
