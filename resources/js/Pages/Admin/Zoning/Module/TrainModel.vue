<template>
    <div>
        <button
            @click.prevent="trainModel()"
            class="px-3 py-2 bg-purple-800 font-bold text-nowrap rounded text-md float-center text-white shadow"
        >
            <i class="fa fa-robot"></i> Train Model
        </button>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import axios from "axios";

const trainModel = async () => {
    // Show a confirmation dialog
    Swal.fire({
        title: "Are you sure?",
        text: "You are about to train the machine learning model. This may take some time.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, train the model!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true,
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const response = await axios.get(route("zoning.train"));
                console.log(response);
                if (response.data) {
                   const data = response.data.original;

                   Swal.fire({
                        title: "Success!",
                        html: `
                            <p>${data.message}</p>
                            <ul>
                                <li><strong>Samples Count:</strong> ${data.training_details.samples_count}</li>
                                <li><strong>Features Count:</strong> ${data.training_details.features_count}</li>
                            </ul>
                        `,
                        icon: "success",
                    });

                    // Optionally refresh data or trigger another action here
                    emits('transaction_id', Math.random());
                } else {
                    throw new Error("Failed to train the model");
                }
            } catch (error) {
                console.error("Error training model:", error);
                Swal.fire({
                    title: "Error",
                    text: error.response.data.message,
                    icon: "error",
                });
            }
        }
    });
};
</script>
