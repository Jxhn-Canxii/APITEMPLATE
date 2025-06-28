<template>
    <div>
        <button
            @click.prevent="isAddModalOpen = true"
            :class="{ 'opacity-25': isAddModalOpen }"
            :disabled="isAddModalOpen"
            class="px-3 py-2 bg-blue-500 font-bold text-nowrap mb-4 text-md float-end text-white rounded shadow"
        >
            <i class="fa fa-plus"></i> Add Zoning Permit
        </button>

        <Modal :show="isAddModalOpen" :maxWidth="'2xl'" title="Edit Zoning Permit" @close="isAddModalOpen = false">
            <div class="grid grid-cols-1 gap-6 p-6">
                <form class="mt-4" @submit.prevent="editPermit">
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Date of Application</label>
                            <input type="date" v-model="form.date_of_application" class="mt-1 p-2 border rounded-md w-full" />
                            <p v-if="errors.or_date" class="text-red-500 text-xs mt-1">{{ errors.date_of_application[0] }}</p>
                        </div>

                        <!-- <div>
                            <label class="block text-sm font-medium text-gray-700">OR Date</label>
                            <input type="date" v-model="form.or_date" class="mt-1 p-2 border rounded-md w-full" />
                            <p v-if="errors.or_date" class="text-red-500 text-xs mt-1">{{ errors.or_date[0] }}</p>
                        </div> -->
                    </div>

                    <!-- <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Official Receipt No.</label>
                        <input type="text" v-model="form.official_receipt_no" placeholder="Enter receipt number" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.official_receipt_no" class="text-red-500 text-xs mt-1">{{ errors.official_receipt_no[0] }}</p>
                    </div> -->

                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" v-model="form.first_name" placeholder="Enter first name" class="mt-1 p-2 border rounded-md w-full" />
                            <p v-if="errors.first_name" class="text-red-500 text-xs mt-1">{{ errors.first_name[0] }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                            <input type="text" v-model="form.middle_name" placeholder="Enter middle name" class="mt-1 p-2 border rounded-md w-full" />
                            <p v-if="errors.middle_name" class="text-red-500 text-xs mt-1">{{ errors.middle_name[0] }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" v-model="form.last_name" placeholder="Enter last name" class="mt-1 p-2 border rounded-md w-full" />
                            <p v-if="errors.last_name" class="text-red-500 text-xs mt-1">{{ errors.last_name[0] }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Address</label>
                        <textarea v-model="form.description" placeholder="Enter Address" class="mt-1 p-2 border rounded-md w-full"></textarea>
                        <p v-if="errors.address" class="text-red-500 text-xs mt-1">{{ errors.address[0] }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ZIP Code</label>
                            <input type="number" max="9999" v-model="form.zip" placeholder="Enter ZIP code" class="mt-1 p-2 border rounded-md w-full" />
                             <p v-if="errors.zip" class="text-red-500 text-xs mt-1">{{ errors.zip[0] }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Owner Name</label>
                            <input type="text" v-model="form.owner_name" placeholder="Enter owner name" class="mt-1 p-2 border rounded-md w-full" />
                            <p v-if="errors.owner_name" class="text-red-500 text-xs mt-1">{{ errors.owner_name[0] }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                            <input type="text" v-model="form.contact_number" placeholder="Enter contact number" class="mt-1 p-2 border rounded-md w-full" />
                            <p v-if="errors.contact_number" class="text-red-500 text-xs mt-1">{{ errors.contact_number[0] }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="text" v-model="form.email" placeholder="Enter email" class="mt-1 p-2 border rounded-md w-full" />
                            <p v-if="errors.email" class="text-red-500 text-xs mt-1">{{ errors.email[0] }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Location of Lot</label>
                        <input type="text" v-model="form.location_of_lot" placeholder="Enter location" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.location_of_lot" class="text-red-500 text-xs mt-1">{{ errors.location_of_lot[0] }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Right Over Land</label>
                        <select v-model="form.right_over_land" class="mt-1 p-2 border rounded-md w-full">
                            <option value="">Select Type</option>
                            <option value="Own">Own</option>
                            <option value="Rent">Rent</option>
                            <option value="Leased">Leased</option>
                        </select>
                        <p v-if="errors.right_over_land" class="text-red-500 text-xs mt-1">{{ errors.right_over_land[0] }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Lot Area (sqm)</label>
                        <input type="number" v-model="form.lot_area" placeholder="Enter lot area" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.lot_area" class="text-red-500 text-xs mt-1">{{ errors.lot_area[0] }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Upload File</label>
                        <input type="file" @change="handleFileUpload" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.file" class="text-red-500 text-xs mt-1">{{ errors.file[0] }}</p>
                    </div>

                    <div class="flex items-center">
                        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">
                            Submit
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
import InputError from "@/Components/InputError.vue";
import Swal from "sweetalert2";
import { ref } from "vue";
import axios from "axios";

const emits = defineEmits(["transaction_id"]);
const isAddModalOpen = ref(false);

const form = useForm({
    date_of_application: "",
    or_date: "",
    official_receipt_no: "0000",
    first_name: "",
    middle_name: "",
    last_name: "",
    address: "",
    zip: "",
    owner_name: "",
    contact_number: "",
    email: "",
    location_of_lot: "",
    right_over_land: "",
    lot_area: "",
    file: null,
});

const handleFileUpload = (event) => {
    const file = event.target.files[0];
    form.file = file ? file : null;
};

const editPermit = async () => {
    try {
        const formData = new FormData();
        const formValues = form.data(); // Extract only necessary data

        Object.keys(formValues).forEach((key) => {
            if (formValues[key]) {
                formData.append(key, formValues[key]);
            }
        });


        const response = await axios.patch(route("zoning.edit"), formData, {
            headers: { "Content-Type": "multipart/form-data" },
        });

        Swal.fire("Success!", "Zoning permit added successfully.", "success");
        form.reset();
        form.file = null;
        isAddModalOpen.value = false;
        emits("transaction_id", Math.random());
    } catch (error) {
        Swal.fire("Error!", error.response?.data?.message || "Something went wrong.", "error");
    }
};
</script>
