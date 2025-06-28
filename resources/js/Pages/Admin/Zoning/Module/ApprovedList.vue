<template>
    <div class="">
        <div class="block bg-white rounded min-w-full min-h-screen p-2">
             <p hidden> {{ sessionRole = $page.props.auth.user.role}} Plus 1 Happy kaarawan</p>
            <!-- Search Bar -->
            <input
                type="text"
                v-model="search.search"
                @input.prevent="searchInput()"
                placeholder="Search Zoning Permits"
                class="mt-1 mb-4 p-2 border rounded w-full text-black"
            />

            <!-- Table -->
            <div class="min-w-screen min-h-full overflow-auto p-2">
                <table class="w-full whitespace-no-wrap text-nowrap">
                    <thead>
                        <tr class="border-b bg-green-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th class="border-b-2 border-gray-200 px-5 py-3 text-center">Approval ID</th>
                            <th class="border-b-2 border-gray-200 px-5 py-3 text-left">Applicant</th>
                            <th class="border-b-2 border-gray-200 px-5 py-3 text-left">Owner</th>
                            <th class="border-b-2 border-gray-200 px-5 py-3 text-left">Location</th>
                            <th class="border-b-2 border-gray-200 px-5 py-3 text-left">Status</th>
                            <th class="border-b-2 border-gray-200 px-5 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="permit in data.data" v-if="data.data?.length > 0 && !loading" :key="permit.id" class="text-gray-700">
                            <td class="border-b border-gray-200 px-5 py-5 text-sm text-center">
                                {{ permit.id }}
                            </td>
                            <td class="border-b border-gray-200 px-5 py-5 text-sm text-wrap">
                                {{ permit.first_name }} {{ permit.middle_name }} {{ permit.last_name }}
                            </td>
                            <td class="border-b border-gray-200 px-5 py-5 text-sm">
                                {{ permit.owner_name }}
                            </td>
                            <td class="border-b border-gray-200 px-5 py-5 text-sm">
                                {{ permit.location_of_lot }}
                            </td>
                            <td class="border-b border-gray-200 px-5 py-5 text-sm">
                                <span 
                                    :class="{
                                        'text-green-600': permit.status_id === 2,
                                        'text-red-600': permit.status_id === 3,
                                        'text-yellow-600': permit.status_id === 1
                                    }">
                                    {{ statusFormatter(permit.status_id) }}
                                </span>
                            </td>
                            <td class="border-b border-gray-200 px-5 py-5 text-sm">
                                <div class="flex justify-center space-x-2">
                                    <ViewForm :key="permit.id" :data="permit" />
                                    <button v-if="sessionRole == 1" @click="deletePermit(permit.id)" class="px-3 py-2 bg-gray-500 text-white rounded">
                                        <i class="fa fa-trash"></i> Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="data.data?.length == 0 && !loading">
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
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Paginator from "@/Components/Paginator.vue";
import { useDebounce } from "@/Utility/Helper.js";
import { ref, onMounted } from "vue";
import axios from "axios";
import Swal from "sweetalert2";

import ViewForm from './ViewForm.vue';

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

// Fetch the zoning permits data
const fetchData = async () => {
    try {
        loading.value = true;
        data.value = [];
        const response = await axios.post(route("zoning.approved.list"), search.value);
        data.value = response.data;
        loading.value = false;
    } catch (error) {
        loading.value = false;
        console.error("Error fetching zoning permits:", error);
    }
};

// Handle pagination changes
const handlePagination = (page_num) => {
    search.value.page_num = page_num ?? 1;
    fetchData();
};

// Refresh data after any transaction
const handleTransaction = () => {
    fetchData();
};

// Delete Zoning Permit
const deletePermit = async (id) => {
    try {
        const result = await Swal.fire({
            title: "Are you sure?",
            text: "You are about to delete this zoning permit.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
        });

        if (result.isConfirmed) {
            await axios.delete(route("zoning.delete", id));
            Swal.fire("Deleted!", "The zoning permit has been deleted.", "success");
            fetchData();
        }
    } catch (error) {
        console.error("Error deleting zoning permit:", error);
        Swal.fire("Error!", error.response?.data?.message || "Something went wrong.", "error");
    }
};

const statusFormatter = (status_id) => {
    switch (status_id) {
        case 1:
            return 'Pending';
            break;
        case 2:
            return 'Approved';
            break;
        case 3:
            return 'Rejected';
            break;
        default:
            break;
    }
}

</script>
