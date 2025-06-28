<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header> Dashboard </template>

        <div class="bg-white rounded shadow p-4">
           <div class="grid grid-cols-1 gap-6">
                <ProcessingStats />
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Chart Components -->
                <InventoryChart />
                <SalesChart  />
                <RevenueChart />
                <CensusChart />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import axios from "axios"; // Ensure axios is imported
import Swal from "sweetalert2";
import Modal from "@/Components/Modal.vue";
import Paginator from "@/Components/Paginator.vue";

import InventoryChart from "./Module/InventoryChart.vue";
import SalesChart from "./Module/SalesChart.vue";
import RevenueChart from "./Module/RevenueChart.vue";
import CensusChart from "./Module/CensusChart.vue";
import ProcessingStats from "./Module/ProcessingStats.vue";

onMounted(() => {});
</script>
