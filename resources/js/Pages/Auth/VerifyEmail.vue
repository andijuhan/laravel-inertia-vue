<template>
    <div>
        You need to verify first to see this page!
        <Link
            :href="route('verification.send')"
            method="post"
            class="btn-outline text-sm"
            >Resend email verification</Link
        >
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
</script>
