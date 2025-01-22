<template>
    <div class="container mx-auto p-6">
      <div class="search-form bg-white p-6 rounded-lg shadow-md">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <!-- Year Dropdown -->
          <select
            v-model="form.years"
            class="form-select rounded-md border-gray-300"
          >
            <option value="">Select Year</option>
            <option v-for="year in availableYears" :key="year" :value="year">
              {{ year }}
            </option>
          </select>

          <!-- Roll Number Input -->
          <input
            v-model="form.Roll"
            type="text"
            placeholder="Enter Roll Number"
            class="form-input rounded-md border-gray-300"
          />

          <!-- Registration ID Input -->
          <input
            v-model="form.reg_id"
            type="text"
            placeholder="Enter Registration ID"
            class="form-input rounded-md border-gray-300"
          />
        </div>

        <div class="mt-4">
          <button
            @click="search"
            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"
          >
            Search Results
          </button>
        </div>
      </div>

      <!-- Results Section -->
      <div v-if="searchResults.length" class="mt-6">
        <div class="bg-white rounded-lg shadow-md overflow-x-auto">
          <table class="min-w-full">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Father's Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">School Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Roll</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reg ID</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              <tr v-for="result in searchResults" :key="result.id">
                <td class="px-6 py-4">{{ result.student.name }}</td>
                <td class="px-6 py-4">{{ result.student.father_name }}</td>
                <td class="px-6 py-4">{{ result.student.school_name }}</td>
                <td class="px-6 py-4">{{ result.Roll }}</td>
                <td class="px-6 py-4">{{ result.reg_id }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </template>

  <script setup>
  import { ref } from 'vue'
  import { router } from '@inertiajs/vue3'

  const props = defineProps({
    availableYears: Array,
    searchResults: Array
  })

  const form = ref({
    years: '',
    Roll: '',
    reg_id: ''
  })

  const search = () => {
    router.get('/find_result/studentResultFind', form.value)
  }
  </script>
