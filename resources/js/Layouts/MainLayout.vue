<template>
    <header
        class="border-b w-full border-gray-200 dark:border-gray-700 dark:bg-gray-800 bg-white"
    >
        <div class="container mx-auto">
            <nav class="p-4 flex items-center justify-between">
                <div class="text-lg font-medium">
                    <Link :href="route('listing.index')">Listings</Link>
                </div>
                <div
                    class="text-indigo-600 dark:text-indigo-300 font-bold text-center"
                >
                    <Link :href="route('listing.index')">LaraZillow</Link>
                </div>
                <div
                    v-if="user"
                    class="flex items-center justify-between gap-4"
                >
                    <Link
                        class="text-gray-500 relative"
                        :href="route('notification.index')"
                    >
                        🔔
                        <div
                            v-if="notificationCount"
                            class="absolute -top-1 -right-1 text-xs bg-red-500 text-white px-1 rounded-full"
                        >
                            {{ notificationCount }}
                        </div>
                    </Link>
                    <Link
                        class="text-sm text-gray-500"
                        :href="route('realtor.listing.index')"
                        >{{ user.name }}</Link
                    >
                    <Link
                        class="btn-primary"
                        :href="route('realtor.listing.create')"
                        >+ New Listing</Link
                    >
                    <div>
                        <Link :href="route('logout')" method="delete"
                            >Logout</Link
                        >
                    </div>
                </div>
                <div v-else class="flex items-center gap-4">
                    <Link class="" :href="route('user-account.create')"
                        >Register</Link
                    >
                    <Link class="" :href="route('login')">Sign-In</Link>
                </div>
            </nav>
        </div>
    </header>

    <main class="container mx-auto p-4 w-full">
        <div
            v-if="flashSuccess"
            class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2"
        >
            {{ flashSuccess }}
        </div>
        <slot></slot>
    </main>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();
const flashSuccess = computed(() => page.props.flash.success);
const user = computed(() => page.props.user);
const notificationCount = computed(() =>
    Math.min(page.props.user.notificationCount, 9)
);
</script>
