<template>
    <div>
        <button
            @click.prevent="isAddResident = true"
            :class="{ 'opacity-25': isAddResident }"
            :disabled="isAddResident"
            class="px-3 py-2 bg-blue-500 text-nowrap font-bold mb-4 text-md float-end text-white rounded shadow"
        >
            <i class="fa fa-plus"></i> Add Resident
        </button>

        <Modal :show="isAddResident" :maxWidth="'2xl'" title="Add Resident" @close="isAddResident = false; errors = {}">
            <div class="grid grid-cols-1 gap-6 p-6">
                <form class="mt-4" @submit.prevent="addResident">
                    <!-- Census Information -->
                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Date of Census</label>
                        <input type="date" v-model="form.date_of_census" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.date_of_census" class="text-red-500 text-xs mt-1">{{ errors.date_of_census[0] }}</p>
                    </div>

                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Area of Census Street</label>
                        <input type="text" v-model="form.area_of_census_street" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.area_of_census_street" class="text-red-500 text-xs mt-1">{{ errors.area_of_census_street[0] }}</p>
                    </div>

                    <!-- Full Name -->
                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Full Name</label>
                        <div class="flex gap-3">
                            <input v-model="form.first_name" type="text" placeholder="First Name" class="mt-1 p-2 border rounded-md w-full" />
                            <input v-model="form.middle_name" type="text" placeholder="Middle Name" class="mt-1 p-2 border rounded-md w-full" />
                            <input v-model="form.last_name" type="text" placeholder="Last Name" class="mt-1 p-2 border rounded-md w-full" />
                        </div>
                        <p v-if="errors.first_name" class="text-red-500 text-xs mt-1">{{ errors.first_name[0] }}</p>
                    </div>

                    <!-- Birthday and Age -->
                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Birthday</label>
                        <input type="date" v-model="form.birthday" @change="calculateAge" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.birthday" class="text-red-500 text-xs mt-1">{{ errors.birthday[0] }}</p>
                    </div>

                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Age</label>
                        <input type="number" v-model="form.age" disabled class="mt-1 p-2 border rounded-md w-full" />
                    </div>

                    <!-- Personal Details -->
                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Gender</label>
                        <select v-model="form.gender" class="mt-1 p-2 border rounded-md w-full">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                        <p v-if="errors.gender" class="text-red-500 text-xs mt-1">{{ errors.gender[0] }}</p>
                    </div>

                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Civil Status</label>
                        <select v-model="form.civil_status" class="mt-1 p-2 border rounded-md w-full">
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="widowed">Widowed</option>
                            <option value="divorced">Divorced</option>
                        </select>
                        <p v-if="errors.civil_status" class="text-red-500 text-xs mt-1">{{ errors.civil_status[0] }}</p>
                    </div>

                    <!-- Education and Employment -->
                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Current School Enrollment</label>
                        <input type="text" v-model="form.current_school_enrollment" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.current_school_enrollment" class="text-red-500 text-xs mt-1">{{ errors.current_school_enrollment[0] }}</p>
                    </div>

                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Educational Attainment</label>
                        <input type="text" v-model="form.educational_attainment" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.educational_attainment" class="text-red-500 text-xs mt-1">{{ errors.educational_attainment[0] }}</p>
                    </div>

                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Employment Status</label>
                        <input type="text" v-model="form.employment_status" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.employment_status" class="text-red-500 text-xs mt-1">{{ errors.employment_status[0] }}</p>
                    </div>

                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Occupation</label>
                        <input type="text" v-model="form.occupation" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.occupation" class="text-red-500 text-xs mt-1">{{ errors.occupation[0] }}</p>
                    </div>

                    <!-- Address -->
                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">House Number</label>
                        <input type="text" v-model="form.house_number" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.house_number" class="text-red-500 text-xs mt-1">{{ errors.house_number[0] }}</p>
                    </div>

                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Street Name</label>
                        <input type="text" v-model="form.street_name" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.street_name" class="text-red-500 text-xs mt-1">{{ errors.street_name[0] }}</p>
                    </div>

                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Barangay</label>
                        <input type="text" v-model="form.barangay" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.barangay" class="text-red-500 text-xs mt-1">{{ errors.barangay[0] }}</p>
                    </div>

                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" v-model="form.city" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.city" class="text-red-500 text-xs mt-1">{{ errors.city[0] }}</p>
                    </div>

                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Province</label>
                        <input type="text" v-model="form.province" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.province" class="text-red-500 text-xs mt-1">{{ errors.province[0] }}</p>
                    </div>

                    <!-- Health Information -->
                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Health Status</label>
                        <input type="text" v-model="form.health_status" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.health_status" class="text-red-500 text-xs mt-1">{{ errors.health_status[0] }}</p>
                    </div>

                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Disability Status</label>
                        <input type="text" v-model="form.disability_status" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.disability_status" class="text-red-500 text-xs mt-1">{{ errors.disability_status[0] }}</p>
                    </div>

                    <!-- Health Conditions -->
                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Existing Health Condition</label>
                        <input type="text" v-model="form.existing_health_condition" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.existing_health_condition" class="text-red-500 text-xs mt-1">{{ errors.existing_health_condition[0] }}</p>
                    </div>

                    <!-- Vaccination -->
                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Fully Immunized</label>
                        <select v-model="form.fully_immunized" class="mt-1 p-2 border rounded-md w-full">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                        <p v-if="errors.fully_immunized" class="text-red-500 text-xs mt-1">{{ errors.fully_immunized[0] }}</p>
                    </div>

                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">COVID-19 Vaccination</label>
                        <select v-model="form.covid_19_vaccination" class="mt-1 p-2 border rounded-md w-full">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                        <p v-if="errors.covid_19_vaccination" class="text-red-500 text-xs mt-1">{{ errors.covid_19_vaccination[0] }}</p>
                    </div>

                    <!-- Housing Information -->
                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Housing Type</label>
                        <input type="text" v-model="form.housing_type" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.housing_type" class="text-red-500 text-xs mt-1">{{ errors.housing_type[0] }}</p>
                    </div>

                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Year of Construction</label>
                        <input type="number" v-model="form.year_of_constructed" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.year_of_constructed" class="text-red-500 text-xs mt-1">{{ errors.year_of_constructed[0] }}</p>
                    </div>

                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">How Long Resident Lived</label>
                        <input type="text" v-model="form.resident_lived" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.resident_lived" class="text-red-500 text-xs mt-1">{{ errors.resident_lived[0] }}</p>
                    </div>

                    <!-- Emergency Contact Information -->
                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Mobile Number</label>
                        <input type="text" v-model="form.mobile_number" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.mobile_number" class="text-red-500 text-xs mt-1">{{ errors.mobile_number[0] }}</p>
                    </div>

                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Emergency Contact Name</label>
                        <input type="text" v-model="form.emergency_contact_name" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.emergency_contact_name" class="text-red-500 text-xs mt-1">{{ errors.emergency_contact_name[0] }}</p>
                    </div>

                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Emergency Contact Number</label>
                        <input type="text" v-model="form.emergency_contact_number" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.emergency_contact_number" class="text-red-500 text-xs mt-1">{{ errors.emergency_contact_number[0] }}</p>
                    </div>

                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Relationship to Emergency Contact</label>
                        <input type="text" v-model="form.relationship_to_emergency_contact" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.relationship_to_emergency_contact" class="text-red-500 text-xs mt-1">{{ errors.relationship_to_emergency_contact[0] }}</p>
                    </div>

                    <div class="mb-4 p-1">
                        <label class="block text-sm font-medium text-gray-700">Number of House Members</label>
                        <input type="number" v-model="form.number_of_house_members" class="mt-1 p-2 border rounded-md w-full" />
                        <p v-if="errors.number_of_house_members" class="text-red-500 text-xs mt-1">{{ errors.number_of_house_members[0] }}</p>
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
import Swal from "sweetalert2";
import { ref } from "vue";
import axios from "axios";

// Data initialization for the form
const emits = defineEmits(["transaction_id"]);
const isAddResident = ref(false);
const errors = ref({}); // To store validation errors

const form = useForm({
    date_of_census: '',
    area_of_census_street: '',
    first_name: '',
    middle_name: '',
    last_name: '',
    birthday: '',
    age: '',
    gender: 'male',
    civil_status: 'single',
    current_school_enrollment: '',
    educational_attainment: '',
    employment_status: '',
    occupation: '',
    house_number: '',
    street_name: '',
    barangay: '',
    city: '',
    province: '',
    housing_type: '',
    health_status: '',
    disability_status: '',
    existing_health_condition: '',
    fully_immunized: '',
    covid_19_vaccination: '',
    year_of_constructed: '',
    resident_lived: '',
    mobile_number: '',
    emergency_contact_name: '',
    emergency_contact_number: '',
    relationship_to_emergency_contact: '',
    number_of_house_members: '',
});

const calculateAge = () => {
    if (form.birthday) {
        const birthday = new Date(form.birthday);
        const age = new Date().getFullYear() - birthday.getFullYear();
        form.age = age;
    }
};

const addResident = async () => {
    try {
        const transformedForm = transformToSnakeCase(form);
        await axios.post(route("residents.add"), transformedForm);
        Swal.fire("Success!", "Resident added successfully.", "success");
        form.reset();
        isAddResident.value = false;
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

// Helper to transform camelCase to snake_case
const transformToSnakeCase = (obj) => {
    const newObj = {};
    for (const key in obj) {
        const snakeKey = key.replace(/[A-Z]/g, letter => `_${letter.toLowerCase()}`);
        newObj[snakeKey] = obj[key];
    }
    return newObj;
};
</script>
