<template>
  <div class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-semibold mb-4 text-center">Barangay Collection Trend</h3>
    <div class="chart-container">
      <canvas ref="collectionChart"></canvas>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { Chart } from "chart.js/auto";

// Sample data for barangay collections over time
const sampleCollectionData = [
  { date: "2025-03-01", amount: 5000 },
  { date: "2025-03-02", amount: 7500 },
  { date: "2025-03-03", amount: 12000 },
  { date: "2025-03-04", amount: 10000 },
  { date: "2025-03-05", amount: 15000 },
  { date: "2025-03-06", amount: 20000 },
  { date: "2025-03-07", amount: 18000 },
];

const collectionChart = ref(null);

const updateChart = () => {
  if (collectionChart.value && sampleCollectionData.length > 0) {
    const ctx = collectionChart.value.getContext("2d");

    // Destroy previous chart if it exists
    if (window.myCollectionChart) {
      window.myCollectionChart.destroy();
    }

    // Create the line chart for collections
    window.myCollectionChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: sampleCollectionData.map((item) => item.date),
        datasets: [
          {
            label: "Total Collections (₱)",
            data: sampleCollectionData.map((item) => item.amount),
            fill: false,
            borderColor: "rgba(75, 192, 192, 1)",
            tension: 0.3, // Smooth curve
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
  updateChart();
});
</script>

<style scoped>
.chart-container {
  width: 100%;
  height: 300px; /* Fixed height */
}
canvas {
  width: 100% !important;
  height: 100% !important;
}
</style>
