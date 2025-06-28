<template>
    <Head title="Register" />

    <GuestLayout>
       
      <div class="flex justify-center items-center min-h-screen px-4 py-8">
            <!-- Login Form Container -->
            <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
                <!-- Logo Section -->
                <div class="flex items-center justify-center">
                    <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
                </div>
                <form @submit.prevent="submit">
                
                    <!-- Name Input -->
                    <div class="mb-4">
                        <InputLabel for="name" value="Name" />
                        <TextInput 
                            id="name" 
                            type="text" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
                            v-model="form.name" 
                            required 
                            autofocus 
                            autocomplete="name" 
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <!-- Email Input -->
                    <div class="mb-4">
                        <InputLabel for="email" value="Email" />
                        <TextInput 
                            id="email" 
                            type="email" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
                            v-model="form.email" 
                            required 
                            autocomplete="username" 
                        />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <!-- Password Input -->
                    <div class="mb-4">
                        <InputLabel for="password" value="Password" />
                        <TextInput 
                            id="password" 
                            type="password" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
                            v-model="form.password" 
                            required 
                            autocomplete="new-password" 
                        />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <!-- Password Confirmation Input -->
                    <div class="mb-4">
                        <InputLabel for="password_confirmation" value="Confirm Password" />
                        <TextInput 
                            id="password_confirmation" 
                            type="password" 
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" 
                            v-model="form.password_confirmation" 
                            required 
                            autocomplete="new-password" 
                        />
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>

                    <!-- Submit Button Section -->
                    <div class="mt-6">
                        <PrimaryButton 
                            class="w-full py-3 bg-emerald-600 text-white rounded-md" 
                            :class="{ 'opacity-25': form.processing }" 
                            :disabled="form.processing"
                        >
                            Register
                        </PrimaryButton>
                    </div>

                    <!-- Link to Login Page -->
                    <div class="mt-4 text-center">
                        <Link :href="route('login')" class="text-sm text-gray-600 hover:text-gray-900">
                            Already registered? Login here
                        </Link>
                    </div>
                </form>
            </div>
        </div>
    </GuestLayout>
</template>

<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<style scoped>
/* Form container */
.max-w-md {
    max-width: 500px;
    margin: auto;
}

/* Form button styling */
.primary-button {
    background-color: #38a169; /* Emerald background */
    color: white;
    border-radius: 0.375rem;
    padding: 1rem;
}

.primary-button:disabled {
    opacity: 0.5;
}

/* Input field styling */
input[type="text"], input[type="email"], input[type="password"] {
    border: 1px solid #d1d5db;
    border-radius: 0.375rem;
    padding: 0.75rem;
    font-size: 1rem;
    width: 100%;
}

input:focus {
    outline: none;
    border-color: #38a169;
}

input.error {
    border-color: #f56565;
}

/* Add spacing between form fields */
.mb-4 {
    margin-bottom: 1rem;
}

.text-sm {
    font-size: 0.875rem;
}
</style>
