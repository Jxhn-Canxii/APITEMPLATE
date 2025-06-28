<template>
    <Head title="System Logs" />

    <AuthenticatedLayout>
        <template #header>
            System Logs
        </template>
        <div class="bg-white rounded shadow p-4">
            <div class="block bg-white rounded min-w-full min-h-screen p-2">
                <!-- Search Bar -->
                <div class="flex justify-start text-nowrap gap-5 mb-3">
                    <input
                        type="text"
                        v-model="search.search"
                        @input.prevent="searchInput()"
                        placeholder="Search Logs"
                        class="px-2 py-2 font-bold mb-4 w-full text-md float-end text-black rounded shadow"
                    />
                </div>
                <!-- Table -->
                <div class="min-w-screen min-h-full overflow-auto p-2">
                    <table class="w-full whitespace-no-wrap text-nowrap">
                        <thead>
                            <tr class="border-b bg-green-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                <th class="border-b-2 border-gray-200 px-5 py-3">User ID</th>
                                <th class="border-b-2 border-gray-200 px-5 py-3">Action</th>
                                <th class="border-b-2 border-gray-200 px-5 py-3">Module</th>
                                <!-- <th class="border-b-2 border-gray-200 px-5 py-3">IP Address</th>
                                <th class="border-b-2 border-gray-200 px-5 py-3">Details</th> -->
                                <th class="border-b-2 border-gray-200 px-5 py-3">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="log in data.logs" v-if="data.logs?.length > 0 && !loading" :key="log.id" class="text-gray-700">
                                <td class="border-b border-gray-200 px-5 py-5 text-sm">
                                    {{ log.user_name }}
                                </td>
                                <td class="border-b border-gray-200 px-5 py-5 text-sm text-wrap">
                                    {{ log.action }}
                                </td>
                                <td class="border-b border-gray-200 px-5 py-5 text-sm">
                                    {{ log.module }}
                                </td>
                                <!-- <td class="border-b border-gray-200 px-5 py-5 text-sm">
                                    {{ log.ip_address }}
                                </td>
                                <td class="border-b border-gray-200 px-5 py-5 text-sm">
                                    {{ log.details }}
                                </td> -->
                                <td class="border-b border-gray-200 px-5 py-5 text-sm">
                                    {{ formatDate(log.created_at) }}
                                </td>
                            </tr>
                            <tr v-if="data.logs?.length == 0 && !loading">
                                <td colspan="4" class="border-b text-center font-bold text-lg border-gray-200 bg-white px-5 py-5">
                                    <p class="text-red-500 whitespace-no-wrap">
                                        No Logs Found!
                                    </p>
                                </td>
                            </tr>
                             <tr v-if="loading">
                                <td colspan="4" class="border-b text-center font-bold text-lg border-gray-200 bg-white px-5 py-5">
                                    <p class="text-red-500 whitespace-no-wrap">
                                       Loading...
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="flex w-full overflow-auto">
                    <Paginator
                        v-if="data.total > 0"
                        :page_number="search.page_num"
                        :total_rows="data.total ?? 0"
                        :itemsperpage="search.itemsperpage"
                        @page_num="handlePagination"
                    />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Paginator from "@/Components/Paginator.vue";
import { useDebounce } from "@/Utility/Helper.js";
import { ref, onMounted } from "vue";
import axios from "axios";

// Store logs data
const data = ref([]);
const loading = ref(false);
// Store search and pagination state
const search = ref({
    page_num: 1,
    total_pages: 0,
    total: 0,
    search: "",
    itemsperpage: 10,
});

// Fetch logs when the page loads
onMounted(() => {
    fetchData();
});

const searchInput = useDebounce(async () => {
  search.value.page_num = 1;
  data.value.items = []; // Clear current items
  await fetchData();
}, 500);


// Fetch logs from API
const fetchData = async () => {
    try {
        loading.value = true;
        data.value = [];
        const response = await axios.post(route("logs.list"), search.value);
        data.value = response.data;
        loading.value = false;
    } catch (error) {
        loading.value = false;
        console.error("Error fetching logs:", error);
    }
};

// Handle pagination changes
const handlePagination = (page_num) => {
    search.value.page_num = page_num ?? 1;
    fetchData();
};

// Format date for display
const formatDate = (timestamp) => {
    return new Date(timestamp).toLocaleString();
};
</script>
