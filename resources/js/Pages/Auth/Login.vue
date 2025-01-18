<template>
    <form @submit.prevent="login">
        <div class="w-1/2 mx-auto flex flex-col gap-4">
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
                <button type="submit" class="btn-primary w-full">Login</button>

                <div class="mt-2 text-center">
                    <Link
                        :href="route('user-account.create')"
                        class="text-sm text-gray-500"
                    >
                        Need an account? Register
                    </Link>
                </div>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm, Link } from "@inertiajs/vue3";

const form = useForm({
    email: null,
    password: null,
});

const login = () => form.post(route("login"));
</script>
