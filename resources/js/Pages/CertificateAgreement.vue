<template>
    <div

    style="font-family: 'Merriweather','SolaimanLipi',sans-serif;"

    class="min-h-screen bg-gradient-to-b from-blue-50 to-gray-100 py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-xl p-10">
        <h2 class="text-2xl font-bold mb-6">সনদ সংক্রান্ত গুরুত্বপূর্ণ তথ্য</h2>

        <div class="space-y-4 text-gray-700">
          <div class="p-4 bg-gray-50 rounded-lg">
            <h3 class="font-semibold mb-2">সনদ প্রাপ্তির নিয়মাবলী:</h3>
            <ul class="list-disc list-inside space-y-2">
              <li>সনদ তৈরি হওয়ার পর মাদরাসায় পাঠিয়ে দেওয়া হয়</li>
              <li>সাময়িক সনদ উত্তোলনের জন্য প্রয়োজনীয় কাগজপত্র:
                <ul class="list-disc list-inside ml-4">
                  <li>প্রবেশপত্রের মূল কপি ও ফটোকপি</li>
                  <li>জাতীয় পরিচয়পত্র/জন্ম নিবন্ধন সনদের ফটোকপি</li>
                </ul>
              </li>
              <!-- Add other rules here -->
            </ul>
          </div>

          <div class="p-4 bg-gray-50 rounded-lg">
            <h3 class="font-semibold mb-2">ফি সংক্রান্ত তথ্য:</h3>
            <ul class="list-disc list-inside">
              <li>মূল সনদের জন্য কোন ফি নেই</li>
              <li>সাময়িক সনদ, সংশোধনী সনদ, ডুপ্লিকেট সনদ: ১০০ টাকা</li>

            </ul>
          </div>

          <div class="mt-8">
            <label class="flex items-center space-x-3">
              <input
                type="checkbox"
                v-model="agreed"
                class="h-5 w-5 text-blue-600 rounded"
              />
              <span class="text-gray-700">আমি উপরোক্ত সকল তথ্য পড়েছি এবং সম্মত</span>
            </label>
          </div>

          <div class="mt-6">
            <button
              @click="proceedToApplication"
              :disabled="!agreed"
              class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50"
            >
          এগিয়ে যাই
            </button>
          </div>
        </div>
      </div>
    </div>
  </template>

  <script setup>
  import { ref } from 'vue'

  const agreed = ref(false)
  const emit = defineEmits(['proceed'])

  const proceedToApplication = () => {
    if (agreed.value) {
      emit('proceed')
    }
  }
  </script>
