<template>
  <Head title="Mapping" />
  <GuestLayout>
    <div class="bg-gray-100">
      
      <!-- Hero Section -->
      <section class="relative bg-cover bg-center h-screen flex items-center justify-center" style="background-image: url('/image/hero.jpg');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 text-center text-white px-4 sm:px-8 lg:px-16">
          <h1 class="text-5xl sm:text-6xl font-extrabold leading-tight mb-4">
            Zonal Mapping of Brgy. San Agustin
          </h1>
          <p class="text-xl sm:text-2xl mb-6">
            Explore the different zones of our community and learn about each area's key features and services.
          </p>
          <a href="#zones" class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white py-3 px-6 rounded-full text-lg font-semibold transition-all duration-300">
            Explore Zones
          </a>
        </div>
      </section>

      <!-- Zonal Map Section -->
      <section id="zones" class="py-16 px-4 bg-white text-center">
        <h2 class="text-3xl font-bold text-emerald-700 mb-6">Zonal Overview</h2>
        <p class="text-lg text-gray-700 max-w-3xl mx-auto mb-8">
          Brgy. San Agustin is divided into several key zones. Each zone is unique and plays a significant role in the community. Below, you will find a detailed overview of each zone, including its facilities, services, and key landmarks.
        </p>

        <!-- Displaying Zonal Map Image (replace with actual map image) -->
        <!-- <div class="max-w-4xl mx-auto mb-8">
          <img src="/image/hero.jpg" alt="Zonal Map of Brgy. San Agustin" class="w-full rounded-lg shadow-md" />
        </div> -->
         <!-- Contact Section -->
        <section class="py-16 px-4 bg-emerald-900 text-white text-center min-h-full mb-4">
          <Maps />
        </section>
        <!-- Zones Information (can be dynamically generated based on your data) -->
        <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Zone 1 -->
          <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-xl font-semibold text-emerald-700 mb-4">Zone 1: Central Area</h3>
            <p class="text-gray-700">This zone serves as the central hub of Brgy. San Agustin, featuring essential community services, commercial areas, and residential buildings.</p>
            <ul class="mt-4 text-gray-700">
              <li><strong>Key Services:</strong> Health center, Community Hall, Public Library</li>
              <li><strong>Nearby Landmarks:</strong> Central Park, Market Square</li>
            </ul>
          </div>
          
          <!-- Zone 2 -->
          <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-xl font-semibold text-emerald-700 mb-4">Zone 2: Residential Area</h3>
            <p class="text-gray-700">A peaceful residential area that is home to a diverse group of residents, offering a sense of community and family-friendly environment.</p>
            <ul class="mt-4 text-gray-700">
              <li><strong>Key Services:</strong> Elementary School, Daycare Center</li>
              <li><strong>Nearby Landmarks:</strong> Riverside Park, Residential Streets</li>
            </ul>
          </div>

          <!-- Zone 3 -->
          <div class="bg-white shadow-lg rounded-lg p-6">
            <h3 class="text-xl font-semibold text-emerald-700 mb-4">Zone 3: Commercial Area</h3>
            <p class="text-gray-700">A bustling zone with local businesses, stores, and markets providing goods and services to residents and visitors alike.</p>
            <ul class="mt-4 text-gray-700">
              <li><strong>Key Services:</strong> Marketplaces, Grocery Stores, Restaurants</li>
              <li><strong>Nearby Landmarks:</strong> Shopping District, Commercial Plaza</li>
            </ul>
          </div>
        </div>
      </section>
    </div>
  </GuestLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Maps from "@/Pages/Admin/ZonalMap/Module/Maps.vue";
  // No specific script needed for this zonal mapping layout
</script>

<style scoped>
/* You can add additional styles here if needed */
</style>
