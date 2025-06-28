<template>
  <!-- Sidebar Toggle Button -->
  <button @click="isSidebarOpen = !isSidebarOpen"
          :class="isSidebarOpen ? 'bg-red-700' : 'bg-lime-700'"
          class="fixed top-2 left-2 z-40 p-2 text-white rounded-md lg:hidden">
    <i class="fa" :class="isSidebarOpen ? 'fa-times' : 'fa-home'"></i>
  </button>

  <!-- Sidebar Overlay (for mobile view) -->
  <div v-if="isSidebarOpen"
       @click="isSidebarOpen = false"
       class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity lg:hidden">
  </div>

  <!-- Sidebar Content -->
  <div :class="isSidebarOpen ? 'translate-x-0' : '-translate-x-full'"
       class="fixed inset-y-0 left-0 z-30 w-64 bg-emerald-900 transition-transform duration-300 transform lg:translate-x-0 lg:static lg:inset-0">
    <div class="flex flex-col justify-center items-center p-3">
        <img 
            src='/image/logo.jpg'
            alt="Logo" 
            class="w-16 h-16 rounded-full border-4 border-gray-600"
        />
        <p class="text-xl text-white">Brgy. San Agustin</p>
        <p hidden>{{ sessionRole = $page.props.auth.user.role }}</p>
    </div>

    <!-- Navigation Links -->
    <nav class="mt-5">
      <!-- Dashboard -->
      <p class="px-4 text-xs text-gray-400 uppercase mt-4">Dashboard</p>
      <nav-link :href="route('dashboard.index')" :active="route().current('dashboard.index')">
        <template #icon>
          <i class="fa fa-tachometer"></i>
        </template>
        Dashboard
      </nav-link>

      <!-- Permit Processing Section -->
      <p class="px-4 text-xs text-gray-400 uppercase mt-4">Permit Processing</p>
      <nav-link :href="route('zoning.index')" :active="route().current('zoning.index')">
        <template #icon>
          <i class="fa fa-file-contract"></i>
        </template>
        Permit Processing
      </nav-link>

      <!-- Barangay Management Section (Visible only for non-role 3 users) -->
      <p class="px-4 text-xs text-gray-400 uppercase mt-4">Barangay Management</p>
      <nav-link v-if="sessionRole != 3" :href="route('landmarks.index')" :active="route().current('landmarks.index')">
        <template #icon>
          <i class="fa fa-landmark"></i>
        </template>
        Landmarks
      </nav-link>
      <nav-link v-if="sessionRole != 3"  :href="route('barangay.census.index')" :active="route().current('barangay.census.index')">
        <template #icon>
          <i class="fa fa-chart-line"></i>
        </template>
        Census
      </nav-link>
      <nav-link v-if="sessionRole != 3"  :href="route('residents.index')" :active="route().current('residents.index')">
        <template #icon>
          <i class="fa fa-users"></i>
        </template>
        Residents
      </nav-link>
      <nav-link :href="route('maps.index')" :active="route().current('maps.index')">
        <template #icon>
          <i class="fa fa-map"></i>
        </template>
        Zonal Map
      </nav-link>

      <!-- System Logs Section -->
      <p class="px-4 text-xs text-gray-400 uppercase mt-4">System</p>
      <nav-link v-if="sessionRole != 3" :href="route('rules.index')" :active="route().current('rules.index')">
        <template #icon>
          <i class="fa fa-list"></i>
        </template>
        Rules
      </nav-link>
      <nav-link v-if="sessionRole == 1" :href="route('users.index')" :active="route().current('users.index')">
        <template #icon>
          <i class="fa fa-users"></i>
        </template>
        Users
      </nav-link>
      <nav-link :href="route('logs.index')" :active="route().current('logs.index')">
        <template #icon>
          <i class="fa fa-history"></i>
        </template>
        User Logs
      </nav-link>
    </nav>
  </div>
</template>

<script setup>
import { ref } from "vue";
import NavLink from "@/Components/NavLink.vue";

// Sidebar state (default: closed)
const isSidebarOpen = ref(false);
const sessionRole = ref(0);

const logOut = async () => {
    try {
        const response = axios.get(route('logout'));
        if (response) {
            localStorage.clear();
            sessionStore.clearSession();
            location.reload();
        }
    } catch (error) {
        console.error('Error logging out:', error);
    }
};
</script>

<style scoped>
/* Ensure smooth sliding effect */
.transition-transform {
  transition: transform 0.3s ease-in-out;
}
</style>
