<template>
    <div>
        <Head title="Zoning Permits" />
        <p hidden>{{ sessionRole = $page.props.auth.user.role }} Plus 1 Happy Kaarawan</p>
        <AuthenticatedLayout>
            <template #header> Zoning Permits {{ sessionRole.value }}</template>

            <div class="bg-white rounded shadow p-4">
                
                <!-- Add Permit Button -->
                <div class="flex justify-end gap-4">
                    <!-- <TrainModel v-if="sessionRole == 1" @transaction_id="handleTransaction()" /> -->
                    <Add @transaction_id="handleTransaction()" />
                </div>
                <!-- Tabs Navigation -->
                <div class="flex flex-wrap px-3">
                    <!-- Tab Buttons (Responsive) -->
                    <button
                        v-for="tab in tabs"
                        :key="tab"
                        @click="activeTab = tab"
                        class="px-4 py-2 hover:bg-gray-200 focus:outline-none text-center w-full sm:w-auto"
                        :class="{
                            'border-b-2 border-emerald-500 bg-yellow-50 text-emerald-500 font-bold': activeTab === tab,
                            'text-gray-600': activeTab !== tab
                        }"
                    >
                        {{ tab }}
                    </button>
                </div>

                <!-- Tab Content -->
                <div class="mt-4 bg-gray-300">
                    <ApprovedList :key="updateKey" v-if="activeTab === 'Approved'" />
                    <PendingList :key="updateKey" v-if="activeTab === 'Pending'" />
                    <RejectedList :key="updateKey" v-if="activeTab === 'Rejected'" />
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, computed } from "vue";

import Add from "./Module/Add.vue";
import TrainModel from "./Module/TrainModel.vue";
import ApprovedList from "./Module/ApprovedList.vue";
import PendingList from "./Module/PendingList.vue";
import RejectedList from "./Module/RejectedList.vue";

// Assuming you get the session role from a prop or store
const sessionRole = ref(0); // Example: Change this dynamically

const tabs = ["Pending", "Approved", "Rejected"];
const activeTab = ref("Pending"); // Default to Pending

// Filter tabs based on role
const filteredTabs = computed(() => {
    return sessionRole.value == 3 ? tabs.filter(tab => tab !== "Pending") : tabs;
});

const updateKey = ref(0);
const handleTransaction = (id) => {
    updateKey.value = id;
};
</script>
