<template>
    <Head title="Attend" />

    <AuthenticationCard >
        <div class=" w-full bg-primary text-white p-4 rounded-md text-center text-xl">
            Your attendance has been logged for  {{today}}
        </div>
    </AuthenticationCard>
</template>
<script setup>
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Head} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import TextInput from "@/Components/TextInput.vue";
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = mm + '/' + dd + '/' + yyyy;
</script>
