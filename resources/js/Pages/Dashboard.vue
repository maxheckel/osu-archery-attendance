<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
const props = defineProps({
    attendances: Array
})

const attendancesByDate = new Map();
props.attendances.forEach((attendance) => {
    const day = new Date(attendance.created_at *1000).toLocaleString().split(', ')[0];
    if (!attendancesByDate.has(day)){
        attendancesByDate.set(day, [])
    }
    const current = attendancesByDate.get(day)
    current.push(attendance);
    attendancesByDate.set(day, current);
})
console.log(attendancesByDate)
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white p-4 overflow-hidden shadow-xl sm:rounded-lg">
                    <div v-for="(day) in attendancesByDate.keys()">
                        <b class="text-lg font-bold">{{day}}</b>
                        <div v-for="attended in attendancesByDate.get(day)">
                            {{attended.person.name}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
