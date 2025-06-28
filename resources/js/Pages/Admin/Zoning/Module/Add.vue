<template>
    <div>
        <button
            @click.prevent="isAddModalOpen = true"
            :class="{ 'opacity-25': isAddModalOpen }"
            :disabled="isAddModalOpen"
            class="px-3 py-2 bg-blue-500 font-bold mb-4 text-nowrap text-md float-end text-white rounded shadow"
        >
            <i class="fa fa-file-contract"></i> Create Zoning Permit
        </button>

        <Modal :show="isAddModalOpen" :maxWidth="'fullscreen'" title="Create Zoning Permit Application" @close="isAddModalOpen = false,errors = false">
            <div class="grid grid-cols-1 gap-6 p-6">
                <form class="mt-4" @submit.prevent="addPermit">
                    <!-- Date and Receipt Information Section -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Date Information</h3>
                        <div class="grid grid-cols-1 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Date of Application</label>
                                <input type="date" v-model="form.date_of_application" class="mt-1 p-2 border rounded-md w-full" />
                                <p v-if="errors.date_of_application" class="text-red-500 text-xs mt-1">{{ errors.date_of_application[0] }}</p>
                            </div>

                            <!-- <div>
                                <label class="block text-sm font-medium text-gray-700">OR Date</label>
                                <input type="date" v-model="form.or_date" class="mt-1 p-2 border rounded-md w-full" />
                                <p v-if="errors.or_date" class="text-red-500 text-xs mt-1">{{ errors.or_date[0] }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Official Receipt No.</label>
                                <input type="text" v-model="form.official_receipt_no" placeholder="Enter receipt number" class="mt-1 p-2 border rounded-md w-full" />
                                <p v-if="errors.official_receipt_no" class="text-red-500 text-xs mt-1">{{ errors.official_receipt_no[0] }}</p>
                            </div> -->
                        </div>
                    </div>

                    <!-- Personal Information Section -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Personal Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
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
                    </div>

                    <!-- Address Section -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Address Details</h3>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Address</label>
                            <textarea v-model="form.address" placeholder="Enter Address" class="mt-1 p-2 border rounded-md w-full"></textarea>
                            <p v-if="errors.address" class="text-red-500 text-xs mt-1">{{ errors.address[0] }}</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
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

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                                <input type="text" v-model="form.contact_number" placeholder="Enter contact number" class="mt-1 p-2 border rounded-md w-full" />
                                <p v-if="errors.contact_number" class="text-red-500 text-xs mt-1">{{ errors.contact_number[0] }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" v-model="form.email" placeholder="Enter email" class="mt-1 p-2 border rounded-md w-full" />
                                <p v-if="errors.email" class="text-red-500 text-xs mt-1">{{ errors.email[0] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Compliance</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <!-- Setback Compliance Section -->
                            <div class="mb-6">
                                <h3 class="text-md font-semibold text-gray-800 mb-2">Setback Compliance</h3>
                                <div class="mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" v-model="form.setback_compliance" class="form-checkbox h-5 w-5 text-blue-600" />
                                        <span class="ml-2 text-gray-700">Compliant with setback regulations</span>
                                    </label>
                                </div>
                                <p v-if="errors.setback_compliance" class="text-red-500 text-xs mt-1">{{ errors.setback_compliance[0] }}</p>
                            </div>
                            <div class="mb-6">
                                <h3 class="text-md font-semibold text-gray-800 mb-2">Existing Structures Compliance</h3>
                                <div class="mt-2">
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" v-model="form.existing_structures" class="form-checkbox h-5 w-5 text-blue-600" />
                                        <span class="ml-2 text-gray-700"> Are there existing structures on this lot?</span>
                                    </label>
                                </div>
                                <p v-if="errors.existing_structures" class="text-red-500 text-xs mt-1">{{ errors.setback_compliance[0] }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Property Information Section -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Property Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Location of Lot</label>
                                <input type="text" v-model="form.location_of_lot" placeholder="Enter location" class="mt-1 p-2 border rounded-md w-full" />
                                <p v-if="errors.location_of_lot" class="text-red-500 text-xs mt-1">{{ errors.location_of_lot[0] }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Lot Area (sqm.)</label>
                                <input type="number" v-model="form.lot_area" placeholder="Lot Area (sqm.)" class="mt-1 p-2 border rounded-md w-full" />
                                <p v-if="errors.lot_area" class="text-red-500 text-xs mt-1">{{ errors.lot_area[0] }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Right Over Land</label>
                                <select v-model="form.right_over_land" class="mt-1 p-2 border rounded-md w-full">
                                    <option value="">Select Type</option>
                                    <option value="1">Own</option>
                                    <option value="2">Rent</option>
                                    <option value="3">Inherited</option>
                                </select>
                                <p v-if="errors.right_over_land" class="text-red-500 text-xs mt-1">{{ errors.right_over_land[0] }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Zoning District</label>
                                <select v-model="form.zoning_district" class="mt-1 p-2 border rounded-md w-full">
                                    <option value="">Select District</option>
                                    <option value="1">Residential</option>
                                    <option value="2">Commercial</option>
                                    <option value="3">Industrial</option>
                                </select>
                                <p v-if="errors.zoning_district" class="text-red-500 text-xs mt-1">{{ errors.zoning_district[0] }}</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Proposed Use</label>
                                <select v-model="form.proposed_use" class="mt-1 p-2 border rounded-md w-full">
                                    <option value="">Select Proposed Use</option>
                                    <option value="1">Single Family Home</option>
                                    <option value="2">Multi-Family Housing</option>
                                    <option value="3">Retail Business</option>
                                    <option value="4">Office Space</option>
                                    <option value="5">Mixed Use</option>
                                </select>
                                <p v-if="errors.proposed_use" class="text-red-500 text-xs mt-1">{{ errors.proposed_use[0] }}</p>
                            </div>

                            <div class="">
                                <label class="block text-sm font-medium text-gray-700">Upload File</label>
                                <input
                                    type="file"
                                    @change="handleFileUpload"
                                    class="mt-1 p-2 border rounded-md w-full"
                                />
                                <p v-if="errors.file" class="text-red-500 text-xs mt-1">{{ errors.file[0] }}</p>
                            </div>

                        </div>
                    </div>


                    <!-- Submit Button -->
                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 rounded">
                            <i class="fa fa-save"></i> Submit Application
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
const errors = ref({});
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
    zoning_district: '',
    proposed_use: '',
    existing_structures: false,
    setback_compliance: false,
    file: null,
});

const handleFileUpload = (event) => {
    const file = event.target.files[0];
    form.file = file ? file : null;
};

const addPermit = async () => {
    try {
        // Show confirmation before proceeding
        const result = await Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to submit this zoning permit application?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, submit!',
            cancelButtonText: 'No, cancel!',
        });

        // If the user confirms, proceed with the API call
        if (result.isConfirmed) {
            const formData = new FormData();
            const formValues = form.data(); // Extract only necessary data

            Object.keys(formValues).forEach((key) => {
                if (formValues[key]) {
                    formData.append(key, formValues[key]);
                }
            });

            const response = await axios.post(route("zoning.add"), formData, {
                headers: { "Content-Type": "multipart/form-data" },
            });

            Swal.fire("Success!", "Zoning permit added successfully.", "success");
            form.reset();
            form.file = null;
            errors.value = {};
            isAddModalOpen.value = false;
            emits("transaction_id", Math.random());
        }
    } catch (error) {
        if (error.response && error.response.data.errors) {
            errors.value = error.response.data.errors; // Laravel returns errors as an object of arrays
        } else {
            Swal.fire("Error!", error.response?.data?.message || "Something went wrong.", "error");
        }
    }
};

</script>
