<template>
    <Head title="Attend" />

    <Modal :show="loading">
        <div class="text-center p-8">
            Loading...
        </div>
    </Modal>
    <Modal :show="potentialNames.length > 0">
        <div class="p-2 text-xl">
            We found similar users with the name "{{name}}".   Click your name or click "Create new user with name {{name}}" to create a new user with your name.
            <div @click="storeAttendanceFor(name.id)" class="bg-primary text-white p-4 my-2 rounded-md w-full" v-for="name in potentialNames">
                {{name.name}}
            </div>
            <div class="w-full h-[1px] mt-4 bg-gray-300"/>
            <div @click="createNewAndStore" class="bg-green-600 text-white p-4 my-2 mt-4 rounded-md w-full">
                Create new user with name "{{name}}"
            </div>
        </div>

    </Modal>
    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>


            <div>
                <InputLabel for="name" value="Enter your name to log attendance" />
                <TextInput
                    id="name"
                    placeholder="Robin Hood"
                    v-model="name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="name"
                />

            </div>


            <div class="flex items-center justify-end mt-4">


                <PrimaryButton @click="save" class=" justify-center !text-xl w-full" >
                    Save
                </PrimaryButton>
            </div>

    </AuthenticationCard>
</template>
<script setup>
import {Head} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import InputLabel from "@/Components/InputLabel.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import TextInput from "@/Components/TextInput.vue";
import {ref} from "vue";
import Modal from "@/Components/Modal.vue";
const name = ref('')
const potentialNames = ref([])
const loading = ref(false)

const save = () => {

    loading.value = true;
    if (!name.value){
        alert('You must enter your name');
    }
    window.axios.post(route('person.search'), {
        name: name.value
    }).then((res) => {

        if (res.data.length === 0){
            window.axios.post(route('person.store'), {
                name: name.value
            }).then((res) => {
                window.axios.post(route('attendance.store'), {
                    person_id: res.data.id
                }).then(
                    () => {
                        window.location = route('success');
                    }
                )
            })
            return;
        }

        if(res.data.length === 1 && res.data[0].name.toLowerCase() === name.value.toLowerCase()){
            window.axios.post(route('attendance.store'), {
                person_id: res.data[0].id
            }).then(
                () => {
                    window.location = route('success');
                }
            )
            return;
        }

        if (res.data.length > 0){
            loading.value = false;
            potentialNames.value = res.data;

        }

    })
}

const storeAttendanceFor = (id) => {
    loading.value = true;
    window.axios.post(route('attendance.store'), {
        person_id: id
    }).then(
        () => {
            window.location = route('success');
        }
    )
}

const createNewAndStore = () => {
    loading.value = true;
    window.axios.post(route('person.store'), {
        name: name.value
    }).then((res) => {
        window.axios.post(route('attendance.store'), {
            person_id: res.data.id
        }).then(
            () => {
                window.location = route('success');
            }
        )
    })
}

</script>
