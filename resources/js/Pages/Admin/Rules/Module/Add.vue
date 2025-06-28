<template>
    <div>
        <button
            @click.prevent="isAddZoningRules = true"
            :class="{ 'opacity-25': isAddZoningRules }"
            :disabled="isAddZoningRules"
            class="px-3 py-2 bg-blue-500 text-nowrap font-bold mb-4 text-md float-end text-white rounded shadow"
        >
            <i class="fa fa-plus"></i> Add Zoning Rules
        </button>

        <Modal :show="isAddZoningRules" :maxWidth="'2xl'" title="Add Zoning Rules" @close="isAddZoningRules = false; errors = {}">
            <div class="grid grid-cols-1 gap-6 p-6">
                <form class="mt-4" @submit.prevent="addZoningRules">
                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Zoning District</label>
                        <select v-model="form.zoning_district" @change="handleBuildingTypeChange(form.zoning_district)" class="mt-1 p-2 border rounded-md w-full">
                            <option value="0">Select District</option>
                            <option value="1">Residential</option>
                            <option value="2">Commercial</option>
                            <option value="3">Industrial</option>
                        </select>
                        <p v-if="errors.zoning_district" class="text-red-500 text-xs mt-1">{{ errors.zoning_district[0] }}</p>
                    </div>

                    <div v-if="form.zoning_district" class="grid grid-cols-1 gap-6 p-1">
                        <!-- Required Area -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Maximum Lot Area (sq. meters)</label>
                            <input type="number" v-model="form.maximum_lot_area" class="mt-1 p-2 border rounded-md w-full" />
                            <p v-if="errors.maximum_lot_area" class="text-red-500 text-xs mt-1">{{ errors.maximum_lot_area[0] }}</p>
                        </div>

                        <!-- Minimum Lot Area -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Minimum Lot Area (sq. meters)</label>
                            <input type="number" v-model="form.minimum_lot_area" class="mt-1 p-2 border rounded-md w-full" />
                            <p v-if="errors.minimum_lot_area" class="text-red-500 text-xs mt-1">{{ errors.minimum_lot_area[0] }}</p>
                        </div>

                        <!-- Acceptable Land Rights -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Acceptable Land Rights</label>
                            <MultiSelectDropdown
                                :key="form.zoning_district"
                                :data="landRights"
                                placeholder="Search Land Rights"
                                @items-selected="handleSelectedItems"
                            />
                            <p v-if="errors.acceptable_land_rights" class="text-red-500 text-xs mt-1">{{ errors.acceptable_land_rights[0] }}</p>
                            <small class="text-gray-500">Comma-separated values</small>
                        </div>

                        <!-- Setback Compliance Required -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Setback Compliance Required</label>
                            <select v-model="form.setback_compliance_required" class="mt-1 p-2 w-full border rounded-md">
                                <option :value="true">Yes</option>
                                <option :value="false">No</option>
                            </select>
                            <p v-if="errors.setback_compliance_required" class="text-red-500 text-xs mt-1">{{ errors.setback_compliance_required[0] }}</p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">
                            <i class="fa fa-save"></i> Add
                        </button>
                    </div>
                </form>
            </div>
        </Modal>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import MultiSelectDropdown from "@/Components/MultiSelectDropdown.vue";
import Swal from "sweetalert2";
import { ref } from "vue";
import axios from "axios";

const emits = defineEmits(["transaction_id"]);
const isAddZoningRules = ref(false);
const errors = ref({}); // To store validation errors

const form = useForm({
    zoning_district: 0,
    minimum_lot_area: 0,
    maximum_lot_area: 0,
    setback_compliance_required: true,
});

const landRights = ref([
  { value: 1, label: "Own" },
  { value: 2, label: "Rent" },
  { value: 3, label: "Inherited" },
]);

const handleSelectedItems = (selectedItems) => {
  form.acceptable_land_rights = selectedItems.map((item) => item.value);
};
const handleBuildingTypeChange = async (id) => {
    form.name = await buildingTypeFormatter(id);
}
const addZoningRules = async () => {
    try {
        await axios.post(route("rules.add"), form);
        Swal.fire("Success!", "Landmark added successfully.", "success");
        form.reset();
        isAddZoningRules.value = false;
        errors.value = {}; // Clear errors after successful submission
        emits("transaction_id", Math.random());
    } catch (error) {
        if (error.response && error.response.data.errors) {
            errors.value = error.response.data.errors; // Store Laravel validation errors
        } else {
            Swal.fire("Error!", error.response?.data?.message || "Something went wrong.", "error");
        }
    }
};
const buildingTypeFormatter = (id) => {
    switch (parseInt(id ?? 0)) {
        case 1:
            return 'Residential';
            break;
        case 2:
            return 'Commercial';
            break;
        case 3:
            return 'Industrial';
            break;
        default:
            return 'None';
            break;
    }
}
</script>
