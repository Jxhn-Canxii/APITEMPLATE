<template>
  <div class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-semibold mb-4 text-center">Barangay Resource Distribution</h3>

    <!-- Summary Metrics -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
      <div class="p-4 bg-blue-100 rounded-lg shadow text-center">
        <h4 class="text-lg font-medium">Total Buildings</h4>
        <p class="text-2xl font-bold">{{ totalBuildings }}</p>
      </div>
      <div class="p-4 bg-green-100 rounded-lg shadow text-center">
        <h4 class="text-lg font-medium">Total Items</h4>
        <p class="text-2xl font-bold">{{ totalItems }}</p>
      </div>
      <div class="p-4 bg-yellow-100 rounded-lg shadow text-center">
        <h4 class="text-lg font-medium">Critical Supplies</h4>
        <p class="text-2xl font-bold">{{ criticalSupplies }}</p>
      </div>
    </div>

    <!-- Inventory Distribution Pie Chart -->
    <div class="chart-container">
      <canvas ref="distributionChart"></canvas>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { Chart } from "chart.js/auto";

// Sample data for testing
const sampleInventoryData = [
  { building: "Health Center", inventory: 300 },
  { building: "Barangay Hall", inventory: 200 },
  { building: "Daycare Center", inventory: 150 },
  { building: "Evacuation Center", inventory: 100 },
  { building: "Police Outpost", inventory: 50 },
];

const totalBuildings = ref(sampleInventoryData.length);
const totalItems = ref(sampleInventoryData.reduce((sum, item) => sum + item.inventory, 0));
const criticalSupplies = ref(3); // Example static value

const distributionChart = ref(null);
let chartInstance = null;

const updateDistributionChart = () => {
  if (distributionChart.value && sampleInventoryData.length > 0) {
    const ctx = distributionChart.value.getContext("2d");

    // Destroy previous chart instance if it exists
    if (chartInstance) {
      chartInstance.destroy();
    }

    // Create the pie chart
    chartInstance = new Chart(ctx, {
      type: "pie",
      data: {
        labels: sampleInventoryData.map((item) => item.building),
        datasets: [
          {
            label: "Inventory Distribution",
            data: sampleInventoryData.map((item) => item.inventory),
            backgroundColor: [
              "#FF6384", "#36A2EB", "#FFCE56", "#4BC0C0", "#9966FF",
            ],
            borderColor: ["#fff", "#fff", "#fff", "#fff", "#fff"],
            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
      },
    });
  }
};

// Initialize Chart on Mount
onMounted(() => {
  updateDistributionChart();
});
</script>

<style scoped>
.chart-container {
  width: 100%;
  height: 300px; /* Fixed height */
  display: flex;
  justify-content: center;
}
canvas {
  width: 100% !important;
  height: 100% !important;
}
</style>
