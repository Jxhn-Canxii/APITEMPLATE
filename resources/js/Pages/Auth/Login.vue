<template>
    <Head title="Login" />
    <!-- Insert Login Form into the Layout -->
    <GuestLayout>
        <div class="flex justify-center items-center min-h-screen px-4 py-8">
            <!-- Login Form Container -->
            <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-center">
                    <ApplicationLogo class="h-16 w-16 text-gray-500" />
                </div>

                <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
                    {{ status }}
                </div>

                <form @submit.prevent="login">
                    <!-- Email Input -->
                    <div>
                        <InputLabel for="email" value="Email" />
                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <!-- Password Input -->
                    <div class="mt-3">
                        <InputLabel for="password" value="Password" />
                        <div class="relative flex w-full">
                            <TextInput
                                id="password"
                                :type="form.show ? 'text' : 'password'"
                                class="block w-full py-2 pr-10 shadow border-3 border-solid border-gray-200 rounded-l"
                                v-model="form.password"
                                required
                                placeholder="Input password"
                                autocomplete="current-password"
                            />
                            <button @click.prevent="togglePasswordVisibility" type="button" class="absolute font-extrabold text-lime-500 inset-y-0 right-0 px-4 rounded-r shadow">
                                <i :class="form.show ? 'fa fa-eye' : 'fa fa-eye-slash'"></i>
                            </button>
                        </div>
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <!-- Registration Link -->
                    <div class="mt-4 flex justify-end">
                        <Link :href="route('register')" class="text-sm text-gray-600 underline hover:text-gray-900">
                            No Account? Click here to register
                        </Link>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <PrimaryButton class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Log in
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </GuestLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';


// Define props
defineProps({
    status: String,
});

// Form data
const form = useForm({
    email: '',
    password: '',
    show: false,
});

// Login method
const login = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password'); // Reset password field after login
        },
    });
};

// Toggle password visibility
const togglePasswordVisibility = () => {
    form.show = !form.show;
};
</script>

<style scoped>
/* Ensure the content is centered within the page */
body {
    background-color: #f7fafc;
}

button i {
    transition: all 0.3s ease;
}

button:hover i {
    transform: scale(1.1);
}
</style>
