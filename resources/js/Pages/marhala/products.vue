<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
  students: Array,  // Define the prop to receive students data
});

</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <div class="p-6 bg-gray-100 min-h-screen">
            <div class="bg-white shadow rounded-lg p-4">
                <div class="my-5">
                    <button

            class="px-4 py-2 bg-gray-100 border border-gray-300 text-gray-600 rounded-lg mr-2 btn-sm"
          >
            Export
          </button>
                </div>
                <div class="flex justify-between items-center mb-4">

                    <div class="grid grid-cols-4 gap-4 w-full">
                        <!-- Search and Filters -->
                        <select
                            @change="handleYearChange"
                            v-model="selectedYear"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-purple-500 focus:outline-none"
                        >
                            <option value="">Select Year</option>
                            <option v-for="year in years" :key="year" :value="year">
                                {{ year }}
                            </option>
                        </select>
                        <input
                            type="text"
                            style="font-family: 'Merriweather','SolaimanLipi',sans-serif;"
                            v-model="searchName"
                            placeholder="ইলহাক লিখুন"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-purple-500 focus:outline-none"
                        />
                        <input
                            type="text"
                            v-model="searchRegistration1"
                            placeholder="Search by Registration"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-purple-500 focus:outline-none"
                        />
                        <input
                            type="text"
                            v-model="searchRegistration2"
                            placeholder="Search by Registration"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-purple-500 focus:outline-none"
                        />
                    </div>
                </div>

                <!-- Data Table -->
                <table style="font-family: 'Merriweather','SolaimanLipi',sans-serif;" class="table-auto w-full border-collapse border border-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border border-gray-200 px-4 py-2 text-left">
                                <input type="checkbox" />
                            </th>
                            <th class="border border-gray-200 px-4 py-2 text-left">নাম</th>
                            <th class="border border-gray-200 px-4 py-2 text-center">পিতার নাম</th>
                            <th class="border border-gray-200 px-4 py-2 text-center">মাদরাসার  নাম</th>
                            <th class="border border-gray-200 px-4 py-2 text-center">ক্লাস</th>
                            <th class="border border-gray-200 px-4 py-2 text-center">জন্মতারিখ</th>
                            <th class="border border-gray-200 px-4 py-2 text-center">রোল</th>
                            <th class="border border-gray-200 px-4 py-2 text-center">রেজিস্ট্রেশন</th>
                            <th class="border border-gray-200 px-4 py-2 text-center">একশন</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="student in students" :key="student.id" class="hover:bg-gray-50">
                            <td class="border border-gray-200 px-4 py-2 text-center">
                                <input type="checkbox" />
                            </td>
                            <td class="border border-gray-200 px-4 py-2">{{ student.Name }}</td>
                            <td class="border border-gray-200 px-4 py-2 text-center">{{ student.Father }}</td>
                            <td class="border border-gray-200 px-4 py-2 text-center">{{ student.Madrasha }}</td>
                            <td class="border border-gray-200 px-4 py-2 text-center">{{ student.Class }}</td>
                            <td class="border border-gray-200 px-4 py-2 text-center">{{ student.DateofBirth }}</td>
                            <td class="border border-gray-200 px-4 py-2 text-center">{{ student.Roll }}</td>
                            <td class="border border-gray-200 px-4 py-2 text-center">{{ student.reg_id }}</td>
                            <td class="border border-gray-200 px-4 py-2 text-center">
                                <button class="text-purple-500 hover:underline">Edit</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
