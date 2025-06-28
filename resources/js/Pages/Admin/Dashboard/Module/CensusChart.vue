<template>
  <div class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-semibold mb-4 text-center">Barangay Census Trend</h3>
    <div class="chart-container">
      <canvas ref="censusChart"></canvas>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from "vue";
import axios from "axios";
import { Chart } from "chart.js/auto";

const censusChart = ref(null);
const censusData = ref([]);

const fetchCensusData = async () => {
  try {
    const response = await axios.get(route("barangay.census.chart"));
    censusData.value = response.data;
    updateChart();
  } catch (error) {
    console.error("Error fetching census data:", error);
  }
};

const updateChart = () => {
  if (censusChart.value && censusData.value.length > 0) {
    const ctx = censusChart.value.getContext("2d");

    if (window.myCensusChart) {
      window.myCensusChart.destroy();
    }

    window.myCensusChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: censusData.value.map((item) => item.year),
        datasets: [
          {
            label: "Households",
            data: censusData.value.map((item) => item.households),
            borderColor: "rgba(75, 192, 192, 1)",
            tension: 0.3,
          },
          {
            label: "Male Population",
            data: censusData.value.map((item) => item.male),
            borderColor: "rgba(54, 162, 235, 1)",
            tension: 0.3,
          },
          {
            label: "Female Population",
            data: censusData.value.map((item) => item.female),
            borderColor: "rgba(255, 99, 132, 1)",
            tension: 0.3,
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

onMounted(fetchCensusData);
watch(censusData, updateChart, { deep: true });
</script>

<style scoped>
.chart-container {
  width: 100%;
  height: 300px;
}
canvas {
  width: 100% !important;
  height: 100% !important;
}
</style>
