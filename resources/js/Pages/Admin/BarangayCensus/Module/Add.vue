<template>
    <div>
        <button
            @click.prevent="isAddModalOpen = true"
            :class="{ 'opacity-25': isAddModalOpen }"
            :disabled="isAddModalOpen"
            class="px-3 py-2 bg-blue-500 font-bold mb-4 text-md float-end text-white rounded shadow"
        >
            <i class="fa fa-plus"></i> Add Census
        </button>

        <Modal :show="isAddModalOpen" :maxWidth="'2xl'" title="Add Census Record" @close="isAddModalOpen = false,errors = false">
            <div class="grid grid-cols-1 gap-6 p-6">
                <form class="mt-4" @submit.prevent="addCensus">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Year</label>
                        <input type="number" v-model="form.year" placeholder="Enter census year" class="mt-1 p-2 border rounded-md w-full"  />
                        <p v-if="errors.year" class="text-red-500 text-xs mt-1">{{ errors.year[0] }}</p>
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
                        <input type="number" v-model="form.population" disabled class="bg-gray-200 mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.population" class="text-red-500 text-xs mt-1">{{ errors.population[0] }}</p>
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
    year: "",
    population: 0,
    households: "",
    male: "",
    female: "",
});

const calculatePopulation = () => {
    form.population = (parseInt(form.male) || 0) + (parseInt(form.female) || 0);
};

const addCensus = async () => {
    try {
        await axios.post(route("barangay.census.add"), form);
        Swal.fire("Success!", "Census record added successfully.", "success");
        form.reset();
        form.population = 0;
        isAddModalOpen.value = false;
        errors.value = {}; // Clear errors after successful submission
        emits("transaction_id", Math.random());
    } catch (error) {
        if (error.response && error.response.data.errors) {
            errors.value = error.response.data.errors; // Store Laravel validation errors
        }else{
            Swal.fire("Error!", error.response?.data?.message || "Something went wrong.", "error");
        }
        
    }
};
</script>
