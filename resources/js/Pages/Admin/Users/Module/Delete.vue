<template>
    <div>
        <button
            @click.prevent="confirmDelete()"
            class="px-3 py-2 bg-red-500 text-nowrap font-bold mb-4 text-md float-end text-white rounded shadow"
        >
            <i class="fa fa-trash"></i> Delete
        </button>
    </div>
</template>

<script setup>
import Swal from "sweetalert2";
import axios from "axios";

const props = defineProps({
    id: Number, // Census ID to delete
});

const emits = defineEmits(["transaction_id"]);

const confirmDelete = async () => {
    Swal.fire({
        title: "Are you sure?",
        text: "This will permanently delete the user!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                await axios.delete(route("users.delete", { id: props.id }));
                Swal.fire("Deleted!", "User has been deleted.", "success");
                emits("transaction_id", Math.random()); // Refresh data
            } catch (error) {
                Swal.fire("Error!", error.response?.data?.message || "Something went wrong.", "error");
            }
        }
    });
};
</script>
