<template>
  <div class="bg-white p-6 rounded-lg shadow-md mb-4">
    <h3 class="text-xl font-semibold mb-4 text-center">Zoning Permit Stats</h3>
    
    <!-- Stats Section -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
      <div class="bg-blue-500 text-white p-4 rounded-lg shadow-md">
        <h4 class="font-semibold text-lg">Pending</h4>
        <p class="text-2xl">{{ stats.pending }}</p>
      </div>
      <div class="bg-green-500 text-white p-4 rounded-lg shadow-md">
        <h4 class="font-semibold text-lg">Approved</h4>
        <p class="text-2xl">{{ stats.approved }}</p>
      </div>
      <div class="bg-red-500 text-white p-4 rounded-lg shadow-md">
        <h4 class="font-semibold text-lg">Rejected</h4>
        <p class="text-2xl">{{ stats.rejected }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from 'axios';

const stats = ref({
  pending: 0,
  approved: 0,
  rejected: 0
});

// Fetch stats from API (replace with your actual API endpoint)
const fetchStats = async () => {
  try {
    const response = await axios.get(route('zoning.processing.stats')); // Adjust with your API endpoint
    stats.value = response.data; // Assuming the response is { pending: X, approved: Y, rejected: Z }
  } catch (error) {
    console.error("Error fetching stats:", error);
  }
};

// Initialize data on component mount
onMounted(() => {
  fetchStats();
});
</script>

<style scoped>
/* Custom styles if needed */
</style>
