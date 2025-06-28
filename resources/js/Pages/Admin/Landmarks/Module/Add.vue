<template>
    <div>
        <button
            @click.prevent="isAddModalOpen = true"
            :class="{ 'opacity-25': isAddModalOpen }"
            :disabled="isAddModalOpen"
            class="px-3 py-2 bg-blue-500 text-nowrap font-bold mb-4 text-md float-end text-white rounded shadow"
        >
            <i class="fa fa-plus"></i> Add Landmark
        </button>

        <Modal :show="isAddModalOpen" :maxWidth="'2xl'" title="Add Landmark" @close="isAddModalOpen = false; errors = {}">
            <div class="grid grid-cols-1 gap-6 p-6">
                <form class="mt-4" @submit.prevent="addLandmark">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Landmark Name</label>
                        <input type="text" v-model="form.name" placeholder="Enter landmark name" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.name" class="text-red-500 text-xs mt-1">{{ errors.name[0] }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Building Type</label>
                        <select v-model="form.building_type" class="mt-1 p-2 border rounded-md w-full">
                            <option value="">Select Type</option>
                            <option value="Residential">Residential</option>
                            <option value="Commercial">Commercial</option>
                            <option value="Industrial">Industrial</option>
                            <option value="Religious">Religious</option>
                            <option value="School">School</option>
                            <option value="Government">Government</option>
                            <option value="Market">Market</option>
                            <option value="Sports Facility">Sports Facility</option>
                            <option value="Health Center">Health Center</option>
                        </select>
                        <p v-if="errors.building_type" class="text-red-500 text-xs mt-1">{{ errors.building_type[0] }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Latitude</label>
                            <input type="text" v-model="form.latitude" placeholder="Enter latitude" class="mt-1 p-2 border rounded-md w-full" />
                            <p v-if="errors.latitude" class="text-red-500 text-xs mt-1">{{ errors.latitude[0] }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Longitude</label>
                            <input type="text" v-model="form.longitude" placeholder="Enter longitude" class="mt-1 p-2 border rounded-md w-full" />
                            <p v-if="errors.longitude" class="text-red-500 text-xs mt-1">{{ errors.longitude[0] }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea v-model="form.description" placeholder="Enter landmark description" class="mt-1 p-2 border rounded-md w-full"></textarea>
                        <p v-if="errors.description" class="text-red-500 text-xs mt-1">{{ errors.description[0] }}</p>
                    </div>

                    <div class="flex items-center justify-end">
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
import Swal from "sweetalert2";
import { ref } from "vue";
import axios from "axios";

const emits = defineEmits(["transaction_id"]);
const isAddModalOpen = ref(false);
const errors = ref({}); // To store validation errors

const form = useForm({
    name: "",
    description: "",
    building_type: "",
    latitude: "",
    longitude: "",
});

const addLandmark = async () => {
    try {
        await axios.post(route("landmarks.add"), form);
        Swal.fire("Success!", "Landmark added successfully.", "success");
        form.reset();
        isAddModalOpen.value = false;
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
</script>
