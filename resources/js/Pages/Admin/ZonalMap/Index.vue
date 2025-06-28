<template>
    <Head title="Barangay Zonal Map" />

    <AuthenticatedLayout>
        <template #header>
            Zonal Maps
        </template>
        <div class="bg-white rounded shadow p-4">
           <Maps />
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Paginator from "@/Components/Paginator.vue";
import { ref, onMounted } from "vue";
import axios from "axios";
import Swal from "sweetalert2";

import Maps from "./Module/Maps.vue";

</script>
