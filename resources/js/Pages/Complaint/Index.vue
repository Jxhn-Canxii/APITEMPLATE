<template>
  <Head title="Barangay Complaints"/>
  <GuestLayout>
   <div class="flex justify-center items-center min-h-screen px-4 py-8">
            <!-- Login Form Container -->
        <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-center mb-4">
                <ApplicationLogo class="h-16 w-16 text-gray-500" />
            </div>

            <form @submit.prevent="submitComplaint">
            <!-- Complaint Category Selection -->
            <div class="mb-4">
                <label for="complaint_type" class="block text-sm font-semibold">Complaint Type</label>
                <select v-model="form.complaint_type" id="complaint_type" class="mt-1 w-full border-gray-300 rounded-md p-2">
                <option value="">Select Complaint Type</option>
                <option value="trash">Trash Disposal</option>
                <option value="water">Water Supply</option>
                <option value="health">Health Services</option>
                <option value="road">Road Conditions</option>
                <option value="security">Security</option>
                </select>
            </div>

            <!-- Complaint Description -->
            <div class="mb-4">
                <label for="description" class="block text-sm font-semibold">Complaint Description</label>
                <textarea
                v-model="form.description"
                id="description"
                rows="4"
                class="mt-1 w-full border-gray-300 rounded-md p-2"
                placeholder="Describe your complaint"
                required
                ></textarea>
            </div>

            <!-- AI Suggestion Section -->
            <div v-if="suggestion" class="mb-4">
                <p class="font-semibold">AI Suggestion:</p>
                <p>{{ suggestion }}</p>
            </div>

            <!-- Submit Button -->
            <div class="mt-4 text-center">
                <button type="submit" :disabled="isSubmitting" class="bg-emerald-600 text-white py-2 px-4 rounded-lg">
                Submit Complaint
                </button>
            </div>
            </form>

            <!-- Complaint Status Tracking -->
            <div v-if="complaints.length" class="mt-6">
            <h3 class="text-lg font-semibold">Complaint Status</h3>
            <ul>
                <li v-for="(complaint, index) in complaints" :key="index" class="border-b p-2">
                <strong>Complaint ID:</strong> {{ complaint.id }} <br />
                <strong>Status:</strong> {{ complaint.status }}
                </li>
            </ul>
            </div>
        </div>
    </div>
  </GuestLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import { ref,watch } from 'vue';
import GuestLayout from "@/Layouts/GuestLayout.vue"
import ApplicationLogo from '@/Components/ApplicationLogo.vue';


const form = ref({
  complaint_type: '',
  description: '',
});

const complaints = ref([]);
const suggestion = ref(null);
const isSubmitting = ref(false);

// Sample data for AI recommendations (simulated)
const recommendations = {
  trash: 'Please contact the Barangay Environmental Office for trash disposal.',
  water: 'Please contact the Barangay Water Services for water supply issues.',
  health: 'Contact the Barangay Health Center for medical services.',
  road: 'Contact the Public Works Department for road conditions.',
  security: 'Please contact the Barangay Security Office for safety concerns.',
};

// Function to simulate AI suggestion based on complaint type
const generateAIDrivenSuggestion = () => {
  suggestion.value = recommendations[form.value.complaint_type] || null;
};

// Function to handle complaint submission
const submitComplaint = () => {
  isSubmitting.value = true;
  
  // Simulating complaint submission (could be replaced with an API call)
  const newComplaint = {
    id: complaints.value.length + 1, // Unique ID for each complaint
    type: form.value.complaint_type,
    description: form.value.description,
    status: 'Submitted',
  };
  
  complaints.value.push(newComplaint);
  
  // Clear form
  form.value.complaint_type = '';
  form.value.description = '';
  
  // Clear AI suggestion after submission
  suggestion.value = null;

  isSubmitting.value = false;
};

// Watch for changes in complaint type to trigger AI suggestion
watch(() => form.value.complaint_type, generateAIDrivenSuggestion);
</script>
