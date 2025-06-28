<template>
  <Head title="Home" />
  <GuestLayout>
    <div class="bg-gray-100">
      <!-- Hero Section -->
      <section class="relative bg-cover bg-center h-screen flex items-center justify-center" style="background-image: url('/image/hero.jpg');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 text-center text-white px-4 sm:px-8 lg:px-16">
          <h1 class="text-5xl sm:text-6xl font-extrabold leading-tight mb-4">
            Welcome to Brgy. San Agustin
          </h1>
          <p class="text-xl sm:text-2xl mb-6">
            Discover the heart of our community, where tradition meets progress.
          </p>
          <a href="/about" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white py-3 px-6 rounded-full text-lg font-semibold transition-all duration-300">
            Learn More
          </a>
        </div>
      </section>

      <!-- About Section -->
      <section class="py-16 px-4 bg-white text-center">
        <h2 class="text-3xl font-bold text-emerald-700 mb-6">About Brgy. San Agustin</h2>
        <p class="text-lg text-gray-700 max-w-3xl mx-auto">
          Brgy. San Agustin is a vibrant community committed to fostering growth, sustainability, and unity. With a rich history and a promising future, we strive to create a safe and progressive environment for all our residents.
        </p>
        <a href="/about" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white py-3 px-6 rounded-full text-lg font-semibold mt-8">
          Discover More About Us
        </a>
      </section>

      <!-- Services/Features Section -->
      <section class="py-16 px-4 bg-gray-50">
        <h2 class="text-3xl font-bold text-emerald-700 text-center mb-8">Our Community Services</h2>
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Service 1 -->
          <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-xl font-semibold text-emerald-700 mb-4">Health & Wellness</h3>
            <p class="text-gray-700">Our community offers a variety of health and wellness programs, from regular medical check-ups to fitness activities for all ages.</p>
          </div>
          <!-- Service 2 -->
          <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-xl font-semibold text-emerald-700 mb-4">Education & Workshops</h3>
            <p class="text-gray-700">We provide educational resources and workshops to empower our residents and help them grow both personally and professionally.</p>
          </div>
          <!-- Service 3 -->
          <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-xl font-semibold text-emerald-700 mb-4">Community Events</h3>
            <p class="text-gray-700">Our community regularly hosts cultural events, festivals, and social gatherings to bring our people together and celebrate our shared heritage.</p>
          </div>
        </div>
      </section>

      <!-- Events Section -->
      <section class="py-16 px-4 bg-white">
        <h2 class="text-3xl font-bold text-emerald-700 text-center mb-8">Upcoming Events</h2>
        <div class="space-y-8">
          <!-- Event 1 -->
          <div class="bg-emerald-100 p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-emerald-700 mb-2">Community Clean-Up Drive</h3>
            <p class="text-gray-700">Join us for a community-wide clean-up event to make our neighborhood cleaner and greener. Date: March 28, 2025</p>
          </div>
          <!-- Event 2 -->
          <div class="bg-emerald-100 p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-emerald-700 mb-2">Summer Festival</h3>
            <p class="text-gray-700">Celebrate the summer with a fun-filled festival, complete with games, music, and food. Date: April 15, 2025</p>
          </div>
          <!-- Event 3 -->
          <div class="bg-emerald-100 p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-emerald-700 mb-2">Health and Wellness Fair</h3>
            <p class="text-gray-700">Our Health and Wellness Fair features workshops, health check-ups, and wellness tips. Date: May 5, 2025</p>
          </div>
        </div>
      </section>

      <!-- Contact Section -->
      <section class="py-16 px-4 bg-emerald-900 text-white text-center">
        <h2 class="text-3xl font-bold mb-6">Get In Touch</h2>
        <p class="text-lg mb-6">Have questions or want to connect with the community? Reach out to us through the contact form or visit us at our Barangay Hall.</p>
        <a href="/contact" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white py-3 px-6 rounded-full text-lg font-semibold transition-all duration-300">
          Contact Us
        </a>
      </section>
    </div>
  </GuestLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
// No specific script needed for this homepage layout
</script>

<style scoped>
/* You can add additional styles here if needed */
</style>
