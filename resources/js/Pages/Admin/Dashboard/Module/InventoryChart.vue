<template>
  <div class="bg-white p-4 rounded-lg shadow-md">
    <h3 class="text-xl font-semibold mb-4">Inventory Chart</h3>
    <canvas ref="inventoryChart"></canvas>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { Chart } from "chart.js/auto";

// Mock data to simulate inventory items
const mockData = [
  { name: "Item 1", quantity: 10 },
  { name: "Item 2", quantity: 20 },
  { name: "Item 3", quantity: 30 },
  { name: "Item 4", quantity: 40 },
  { name: "Item 5", quantity: 50 },
];

const inventoryChart = ref(null);

const updateChart = () => {
  if (inventoryChart.value && mockData.length > 0) {
    const ctx = inventoryChart.value.getContext("2d");

    // Destroy previous chart if it exists
    if (window.myInventoryChart) {
      window.myInventoryChart.destroy();
    }

    // Create the chart
    window.myInventoryChart = new Chart(ctx, {
      type: "bar", // Example chart type, can be 'pie', 'line', etc.
      responsive: true,
      data: {
        labels: mockData.map((item) => item.name),
        datasets: [
          {
            label: "Inventory Quantity",
            data: mockData.map((item) => item.quantity),
            backgroundColor: "rgba(75, 192, 192, 0.2)",
            borderColor: "rgba(75, 192, 192, 1)",
            borderWidth: 1,
          },
        ],
      },
    });
  }
};

onMounted(() => {
  updateChart();
});
</script>

<style scoped>
/* Add custom styles for the chart component */
</style>
