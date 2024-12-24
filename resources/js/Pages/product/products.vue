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



  <div class="p-6 bg-gray-100 min-h-screen">
    <div class="bg-white shadow rounded-lg p-4">
      <!-- Table Header -->
      <div class="flex justify-between items-center mb-4">
        <input
          type="text"
          v-model="searchQuery"
          placeholder="Search"
          class="px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-purple-500 focus:outline-none w-1/3"
        />
        <div>
          <button
            class="px-4 py-2 bg-gray-100 border border-gray-300 text-gray-600 rounded-lg mr-2"
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
