<template>
    <Head title="Residents Management" />

    <AuthenticatedLayout>
        <template #header>
            Residents Management
        </template>
        <div class="bg-white rounded shadow p-4">
           <div class="block bg-white rounded min-w-full min-h-screen p-2">
                <!-- Search Bar -->
                <div class="flex justify-between text-nowrap gap-5 mb-3">
                    <input
                        type="text"
                        v-model="search.search"
                        @input.prevent="searchInput()"
                        placeholder="Search Residents"
                        class="px-2 py-2 font-bold mb-4 w-full text-md float-end text-black rounded shadow"
                    />
                    <Add :key="updateKey" @transaction_id="handleTransaction()" />
                </div>
                <!-- Table -->
                <div class="min-w-screen min-h-full overflow-auto p-2">
                    <table class="w-full whitespace-no-wrap text-nowrap">
                        <thead>
                            <tr class="border-b bg-green-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                <th class="border-b-2 border-gray-200 px-5 py-3 text-left">Full Name</th>
                                <th class="border-b-2 border-gray-200 px-5 py-3 text-right">Age</th>
                                <th class="border-b-2 border-gray-200 px-5 py-3 text-left">Gender</th>
                                <th class="border-b-2 border-gray-200 px-5 py-3 text-left">City</th>
                                <th class="border-b-2 border-gray-200 px-5 py-3 text-left">Barangay</th>
                                <th class="border-b-2 border-gray-200 px-5 py-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="resident in data.residents" v-if="data.residents?.length > 0 && !loading" :key="resident.id" class="text-gray-700">
                                <td class="border-b border-gray-200 px-5 py-5 text-wrap text-sm">
                                    {{ resident.firstname }} {{ resident.lastname }}
                                </td>
                                <td class="border-b border-gray-200 px-5 text-right py-5 text-sm">
                                    {{ resident.age ?? 'N/A' }}
                                </td>
                                <td class="border-b border-gray-200 px-5 text-left py-5 text-sm">
                                    {{ resident.gender ?? 'N/A' }}
                                </td>
                                <td class="border-b border-gray-200 px-5 text-left text-wrap py-5 text-sm">
                                    {{ resident.city }}
                                </td>
                                <td class="border-b border-gray-200 px-5 text-left py-5 text-sm">
                                    {{ resident.barangay }}
                                </td>
                                <td class="border-b border-gray-200 px-5 py-5 text-sm text-center">
                                    <div class="flex justify-center items-center">
                                        <Edit :key="resident.id" @transaction_id="handleTransaction()" :data="resident" />
                                        <Delete :key="resident.id" @transaction_id="handleTransaction()" :id="resident.id" />
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="data.residents?.length == 0 && !loading">
                                <td colspan="6" class="border-b text-center font-bold text-lg border-gray-200 bg-white px-5 py-5">
                                    <p class="text-red-500 whitespace-no-wrap">
                                        No Data Found!
                                    </p>
                                </td>
                            </tr>
                            <tr v-if="loading">
                                <td colspan="6" class="border-b text-center font-bold text-lg border-gray-200 bg-white px-5 py-5">
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
import Swal from "sweetalert2";

import Add from "./Module/Add.vue";
import Edit from "./Module/Edit.vue";
import Delete from "./Module/Delete.vue";

const data = ref([]);
const loading = ref(false);
const search = ref({
    page_num: 1,
    total_pages: 0,
    total: 0,
    search: "",
    itemsperpage: 10,
});

onMounted(() => {
    fetchData();
});

const searchInput = useDebounce(async () => {
  search.value.page_num = 1;
  data.value.items = []; // Clear current items
  await fetchData();
}, 500);

// Fetch the residents data
const fetchData = async () => {
    try {
        loading.value = true;
        data.value = [];
        const response = await axios.post(route("residents.list"), search.value);
        data.value = response.data;
        loading.value = false;
    } catch (error) {
        loading.value = false;
        console.error("Error fetching residents:", error);
    }
};

// Handle pagination changes
const handlePagination = (page_num) => {
    search.value.page_num = page_num ?? 1;
    fetchData();
};

const updateKey = ref(0);

const handleTransaction = (id) => {
    fetchData();
    updateKey.value = id;
};

</script>
