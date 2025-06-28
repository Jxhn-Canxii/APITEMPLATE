<template>
    <header class="flex items-center justify-between border-b-2 border-emerald-300 bg-emerald-900 px-4 py-1">
       
        <!-- Logo and title -->
        <div class="flex justify-start items-center space-x-1">
            <!-- Mobile menu toggle button -->
            <button @click.prevent="$page.props.showingMobileMenu = !$page.props.showingMobileMenu" class="text-gray-500 focus:outline-none lg:hidden mr-2">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <div class="">
                <p class="">
                    <h2 class="text-md md:text-xl font-semibold text-start text-white">{{ $page.props.auth.user.name }}</h2>
                    <small class="text-slate-200">{{ roleFormatter($page.props.auth.user.role) }}</small>
                </p>
            </div>
        </div>
        <div class="flex justify-end items-center space-x-1">
            <!-- Logout button -->
            <button @click.prevent="logOut()" class=" text-left text-white border p-2 rounded hover:bg-red-300" :href="route('logout')" method="post" as="button">
                <i class="fa fa-power-off text-red-500"></i> Logout
            </button>
        </div>
    </header>
</template>

<script setup>
import { ref } from 'vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import { roleFormatter } from "@/Utility/Formatter.js";
import axios from "axios";
import Swal from "sweetalert2";

const logOut = async () => {
    try {
        const confirmLogout = await Swal.fire({
            title: "Are you sure?",
            text: "You will be logged out of your account.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, log me out"
        });

        if (!confirmLogout.isConfirmed) return; // Exit if user cancels

        // Send logout request
        const response = await axios.post(route('logout'),{id: 0});
        if (response) {
            // clear all storage
            localStorage.clear();
            sessionStorage.clear();

            // Show success message
            await Swal.fire({
                title: "Logged Out",
                text: "You have been successfully logged out.",
                icon: "success",
                timer: 2000,
                showConfirmButton: false
            });

            // Reload the page to reflect changes
            location.reload();
        }
    } catch (error) {
        console.error("Error logging out:", error);
        Swal.fire("Error", "Something went wrong. Please try again!", "error");
    }
};

</script>
<style scoped>
.trapezoid {
  clip-path: polygon(0% 20%, 100% 0%, 100% 80%, 0% 100%);
}
</style>
