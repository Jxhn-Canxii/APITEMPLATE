<template>
    <div>
        <button
            @click.prevent="openModal()"
            :class="{ 'opacity-25': isModalOpen }"
            :disabled="isModalOpen"
            class="px-3 py-2 bg-yellow-500 text-nowrap font-bold mb-4 text-md float-end text-white rounded shadow"
        >
            <i class="fa fa-edit"></i> Edit
        </button>

        <Modal :show="isModalOpen" :maxWidth="'2xl'" :title="'Edit Census Record'" @close="isModalOpen = false">
            <div class="grid grid-cols-1 gap-6 p-6">
                <form class="mt-4" @submit.prevent="updateCensus">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Year</label>
                        <input type="number" v-model="form.year" class="mt-1 p-2 border rounded-md w-full bg-gray-200" disabled />
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700"># of Households</label>
                        <input type="number" v-model="form.households" placeholder="Enter number of households" class="mt-1 p-2 border rounded-md w-full"  @input="calculatePopulation" />
                        <p v-if="errors.households" class="text-red-500 text-xs mt-1">{{ errors.households[0] }}</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Male Population</label>
                            <input type="number" v-model="form.male" placeholder="Enter male population" class="mt-1 p-2 border rounded-md w-full"  @input="calculatePopulation" />
                            <p v-if="errors.male" class="text-red-500 text-xs mt-1">{{ errors.male[0] }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Female Population</label>
                            <input type="number" v-model="form.female" placeholder="Enter female population" class="mt-1 p-2 border rounded-md w-full"  @input="calculatePopulation" />
                            <p v-if="errors.female" class="text-red-500 text-xs mt-1">{{ errors.female[0] }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Total Population</label>
                        <input type="number" v-model="form.population" class="bg-gray-200 mt-1 p-2 border rounded-md w-full" disabled />
                        <p v-if="errors.population" class="text-red-500 text-xs mt-1">{{ errors.population[0] }}</p>
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">
                             <i class="fa fa-save"></i> Save
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
import { ref, watch } from "vue";
import axios from "axios";

const props = defineProps({
    data: Object, // Pass census data as prop
});
const emits = defineEmits(["transaction_id"]);
const isModalOpen = ref(false);
const errors = ref({}); // Store validation errors

const form = useForm({
    id: "",
    year: "",
    population: "",
    households: "",
    male: "",
    female: "",
});

// Watch for changes in props and update form
watch(
    () => props.data,
    (newData) => {
        if (newData) {
            form.id = newData.id;
            form.year = newData.year;
            form.population = newData.population;
            form.households = newData.households;
            form.male = newData.male;
            form.female = newData.female;
        }
    },
    { immediate: true }
);

// Open modal
const openModal = () => {
    isModalOpen.value = true;
};

// Calculate total population
const calculatePopulation = () => {
    form.population = (parseInt(form.male) || 0) + (parseInt(form.female) || 0);
};

// Update census record
const updateCensus = async () => {
    try {
        await axios.patch(route("barangay.census.update", { id: form.id }), form);
        Swal.fire("Success!", "Census record updated successfully.", "success");
        isModalOpen.value = false;
        errors.value = {}; // Clear errors after successful submission
        emits("transaction_id", Math.random());
    } catch (error) {
        console.log(error);
       if (error.response && error.response.data.errors) {
            errors.value = error.response.data.errors; // Store Laravel validation errors
        }else{
            Swal.fire("Error!", error.response?.data?.message || "Something went wrong.", "error");
        }
    }
};
</script>
