<template>
    <!-- Header Section -->
    <div class="">
        <Header />
    </div>
    <div class="min-h-screen min-wscreen bg-emerald-700">
            <!-- Slot for Dynamic Content -->
        <slot />
    </div>
    <!-- Optional Footer Section -->
    <footer class="bg-emerald-900 text-white py-4">
        <div class="text-center">
        <p>&copy; 2025 Brgy. San Agustin. All rights reserved.</p>
        </div>
    </footer>
</template>

<script setup>
import Header from '@/Layouts/GuestHeader.vue';
</script>

<style scoped>
/* Ensure the footer stays at the bottom */
footer {
  position: relative;
  bottom: 0;
  width: 100%;
}

.flex-grow {
  flex-grow: 1; /* Ensures the content area fills available space */
}

.bg-emerald-900 {
  background-color: #064e3b; /* Dark Emerald color */
}
</style>
