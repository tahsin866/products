<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed } from "vue";


const categories = ref([
  {
    id: 1,
    name: "Smart Phone",
    description:
      "Choose from wide range of smartphones online at best prices.",
    products: "12,548",
    earnings: "$98,784.00",
    image: "https://via.placeholder.com/40",
  },
  {
    id: 2,
    name: "Clothing, Shoes, and Jewellery",
    description:
      "Fashion for a wide selection of clothing, shoes, jewellery and watches.",
    products: "4,689",
    earnings: "$45,627.00",
    image: "https://via.placeholder.com/40",
  },
  {
    id: 3,
    name: "Home and Kitchen",
    description: "Browse through the wide range of Home and kitchen products.",
    products: "12,548",
    earnings: "$98,784.00",
    image: "https://via.placeholder.com/40",
  },
  // Add more sample data as needed
]);

const searchQuery = ref("");

const filteredCategories = computed(() => {
  if (!searchQuery.value) return categories.value;
  return categories.value.filter((category) =>
    category.name.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Card 1 -->
    <div class="bg-white shadow rounded-lg p-4 flex items-center">
      <div class="bg-purple-100 p-3 rounded-full">
        <svg class="w-6 h-6 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 5l3 3m0 0l-3 3m3-3H9m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </div>
      <div class="ml-4">
        <h4 class="text-xl font-semibold text-gray-800">42</h4>
        <p class="text-gray-500 text-sm">On route vehicles</p>
        <p class="text-green-500 text-sm">18.2% than last week</p>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="bg-white shadow rounded-lg p-4 flex items-center">
      <div class="bg-yellow-100 p-3 rounded-full">
        <svg class="w-6 h-6 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3 1.343 3 3 0 1.657-1.343 3-3 3s-3-1.343-3-3c0-1.657 1.343-3 3-3zm0 8c4.418 0 8 1.791 8 4v2H4v-2c0-2.209 3.582-4 8-4z" />
        </svg>
      </div>
      <div class="ml-4">
        <h4 class="text-xl font-semibold text-gray-800">8</h4>
        <p class="text-gray-500 text-sm">Vehicles with errors</p>
        <p class="text-red-500 text-sm">-8.7% than last week</p>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="bg-white shadow rounded-lg p-4 flex items-center">
      <div class="bg-red-100 p-3 rounded-full">
        <svg class="w-6 h-6 text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 005.656 5.656M14.828 9.172a4 4 0 00-5.656 5.656M12 4v1m0 14v1m8-8h1M4 12H3m17.364 6.364l.707-.707M6.343 6.343l-.707-.707m12.728 12.728l.707.707M6.343 17.657l-.707.707" />
        </svg>
      </div>
      <div class="ml-4">
        <h4 class="text-xl font-semibold text-gray-800">27</h4>
        <p class="text-gray-500 text-sm">Deviated from route</p>
        <p class="text-green-500 text-sm">4.3% than last week</p>
      </div>
    </div>

    <!-- Card 4 -->
    <div class="bg-white shadow rounded-lg p-4 flex items-center">
      <div class="bg-blue-100 p-3 rounded-full">
        <svg class="w-6 h-6 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v5h6v-5m-3-4v5m3-9h2a2 2 0 012 2v6a2 2 0 01-2 2h-2m-4 0H9a2 2 0 01-2-2v-6a2 2 0 012-2h2m0 0V5a2 2 0 014 0v4" />
        </svg>
      </div>
      <div class="ml-4">
        <h4 class="text-xl font-semibold text-gray-800">13</h4>
        <p class="text-gray-500 text-sm">Late vehicles</p>
        <p class="text-red-500 text-sm">-2.5% than last week</p>
      </div>
    </div>
  </div>















  <div class="p-6 bg-gray-100 min-h-screen">
    <div class="bg-white shadow rounded-lg p-4">
      <!-- Table Header -->
      <div class="flex justify-between items-center mb-4">
        <input
        density
          type="text"
          v-model="searchQuery"
          placeholder="Search"
          class="px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-purple-500 focus:outline-none w-1/3"
        />
        <div>
          <button

            class="px-4 py-2 bg-gray-100 border border-gray-300 text-gray-600 rounded-lg mr-2 btn-sm"
          >
            Export
          </button>
          <button
            class="px-4 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600"
          >
            + Add Category
          </button>
        </div>
      </div>
      <!-- Table -->
      <table class="table-auto w-full border-collapse border border-gray-200">
        <thead class="bg-gray-100">
          <tr>
            <th class="border border-gray-200 px-4 py-2 text-left">
              <input type="checkbox" />
            </th>
            <th class="border border-gray-200 px-4 py-2 text-left">Categories</th>
            <th class="border border-gray-200 px-4 py-2 text-center">
              Total Products
            </th>
            <th class="border border-gray-200 px-4 py-2 text-center">
              Total Earning
            </th>
            <th class="border border-gray-200 px-4 py-2 text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="category in filteredCategories"
            :key="category.id"
            class="hover:bg-gray-50"
          >
            <td class="border border-gray-200 px-4 py-2 text-center">
              <input type="checkbox" />
            </td>
            <td class="border border-gray-200 px-4 py-2">
              <div class="flex items-center">
                <img
                  :src="category.image"
                  :alt="category.name"
                  class="w-10 h-10 rounded-full mr-3"
                />
                <div>
                  <p class="font-semibold">{{ category.name }}</p>
                  <p class="text-gray-500 text-sm">{{ category.description }}</p>
                </div>
              </div>
            </td>
            <td class="border border-gray-200 px-4 py-2 text-center">
              {{ category.products }}
            </td>
            <td class="border border-gray-200 px-4 py-2 text-center">
              {{ category.earnings }}
            </td>
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
