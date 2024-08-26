<template>
    <Head title="Attend" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>


            <div>
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>


            <div class="flex items-center justify-end mt-4">


                <PrimaryButton @click="save" class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </PrimaryButton>
            </div>

    </AuthenticationCard>
</template>
<script setup>
import {Head, Link, useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Checkbox from "@/Components/Checkbox.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import TextInput from "@/Components/TextInput.vue";
const form = useForm({
    name: ''
})

const save = () => {
    if (!form.name){
        alert('You must enter your name');
    }
    window.axios.post(route('person.search'), {
        name: form.name
    }).then((res) => console.log(res))
}

</script>
