<template>
  <div class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-semibold mb-4 text-center">Barangay Revenue Overview</h3>
    
    <!-- Chart Container -->
    <div class="chart-container">
      <canvas ref="revenueChart"></canvas>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";
import { Chart } from "chart.js/auto";

// Sample revenue data for barangay funds
const sampleRevenueData = [
  { name: "Business Permits", revenue: 50000 },
  { name: "Real Property Tax", revenue: 75000 },
  { name: "Barangay Clearance", revenue: 20000 },
  { name: "Community Projects", revenue: 10000 },
  { name: "Market Fees", revenue: 30000 },
];

const revenueChart = ref(null);
let chartInstance = null;

const updateRevenueChart = () => {
  if (revenueChart.value && sampleRevenueData.length > 0) {
    const ctx = revenueChart.value.getContext("2d");

    // Destroy previous chart if it exists
    if (chartInstance) {
      chartInstance.destroy();
    }

    // Create the revenue bar chart
    chartInstance = new Chart(ctx, {
      type: "bar",
      data: {
        labels: sampleRevenueData.map((item) => item.name),
        datasets: [
          {
            label: "Revenue Collected (₱)",
            data: sampleRevenueData.map((item) => item.revenue),
            backgroundColor: "rgba(255, 159, 64, 0.5)",
            borderColor: "rgba(255, 159, 64, 1)",
            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
          },
        },
      },
    });
  }
};

// Watch for future data updates (if props will be used later)
watch(() => sampleRevenueData, updateRevenueChart, { deep: true });

onMounted(() => {
  updateRevenueChart();
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
