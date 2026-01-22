<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 to-green-500 shadow-lg">
      <div class="max-w-6xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
          <div class="flex items-center space-x-3">
            <div class="bg-white/20 p-2 rounded-lg">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
              </svg>
            </div>
            <div>
              <h1 v-if="!loading && !error" class="text-2xl sm:text-3xl font-bold text-white">{{ businessName }}</h1>
              <div v-else class="h-8 w-48 bg-white/20 rounded animate-pulse"></div>
            </div>
          </div>
          
          <div class="flex items-center space-x-4">
            <div class="hidden sm:flex items-center space-x-2 bg-white/10 px-4 py-2 rounded-lg">
              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
              <span class="text-white text-sm">Addis Ababa, Ethiopia</span>
            </div>
            <div class="text-white/90 text-sm">
              Last Updated: {{ formattedDate }}
            </div>
          </div>
        </div>
      </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
      <!-- Loading State -->
      <div v-if="loading" class="space-y-8">
        <div class="text-center py-12">
          <div class="inline-flex items-center justify-center space-x-3">
            <svg class="animate-spin h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-xl font-medium text-gray-600">Loading menu...</span>
          </div>
        </div>
        
        <!-- Skeleton Loaders -->
        <div class="space-y-6">
          <div v-for="i in 3" :key="i" class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-4">
              <div class="h-6 w-48 bg-white/20 rounded animate-pulse"></div>
            </div>
            <div class="p-6 space-y-4">
              <div v-for="j in 4" :key="j" class="flex items-center justify-between">
                <div class="space-y-2">
                  <div class="h-4 w-64 bg-gray-200 rounded animate-pulse"></div>
                  <div class="h-3 w-32 bg-gray-100 rounded animate-pulse"></div>
                </div>
                <div class="h-6 w-16 bg-gray-200 rounded animate-pulse"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Error State -->
      <div v-if="error && !loading" class="bg-white rounded-2xl shadow-lg p-8 text-center">
        <div class="w-16 h-16 mx-auto mb-4 bg-red-100 rounded-full flex items-center justify-center">
          <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Menu Not Found</h2>
        <p class="text-gray-600 mb-6">The menu you're looking for doesn't exist or is no longer available.</p>
        <router-link 
          to="/" 
          class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-green-500 text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5"
        >
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
          </svg>
          Return to Home
        </router-link>
      </div>

      <!-- Menu Content -->
      <div v-if="!loading && !error" class="space-y-8">
        <!-- Menu Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-500 text-sm font-medium">Total Categories</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ categories.length }}</p>
              </div>
              <div class="bg-blue-50 p-3 rounded-full">
                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
              </div>
            </div>
          </div>
          
          <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-500 text-sm font-medium">Total Items</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ totalItems }}</p>
              </div>
              <div class="bg-green-50 p-3 rounded-full">
                <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
              </div>
            </div>
          </div>
          
          <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-500 text-sm font-medium">Avg. Price</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ averagePrice }} ETB</p>
              </div>
              <div class="bg-purple-50 p-3 rounded-full">
                <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
            </div>
          </div>
        </div>

        <!-- Categories -->
        <div class="space-y-6">
          <div v-for="cat in categories" :key="cat.id" class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6">
              <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                  <div class="bg-white/20 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                  </div>
                  <h2 class="text-xl font-bold text-white">{{ cat.name }}</h2>
                </div>
                <span class="text-blue-100 bg-white/20 px-3 py-1 rounded-full text-sm font-medium">
                  {{ cat.menu_items.length }} items
                </span>
              </div>
            </div>
            
            <div class="p-6">
              <div v-if="cat.menu_items.length">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div
                    v-for="item in cat.menu_items"
                    :key="item.id"
                    class="border border-gray-200 rounded-xl p-5 hover:border-blue-300 hover:shadow-md transition-all duration-300 group"
                  >
                    <div class="flex justify-between items-start mb-3">
                      <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">
                          {{ item.item_name }}
                        </h3>
                        <p v-if="item.description" class="text-gray-600 text-sm mt-1">
                          {{ item.description }}
                        </p>
                      </div>
                      <span class="text-lg font-bold text-green-600 ml-4">
                        {{ item.final_price }} ETB
                      </span>
                    </div>
                    
                    <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                      <span class="inline-flex items-center space-x-1 text-sm text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span>Tax: {{ item.tax_percentage }}%</span>
                      </span>
                      
                      <div v-if="item.is_available" class="inline-flex items-center space-x-1 text-sm text-green-600 bg-green-50 px-3 py-1 rounded-full">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span>Available</span>
                      </div>
                      <div v-else class="inline-flex items-center space-x-1 text-sm text-red-600 bg-red-50 px-3 py-1 rounded-full">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                        <span>Out of Stock</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div v-else class="text-center py-8">
                <div class="w-12 h-12 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                  <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                  </svg>
                </div>
                <p class="text-gray-400">No items available in this category</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer Note -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
          <div class="flex items-center space-x-3">
            <div class="bg-green-50 p-3 rounded-full">
              <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
              </svg>
            </div>
            <div>
              <p class="font-medium text-gray-800">All prices include {{ getAverageTax() }}% average tax</p>
              <p class="text-sm text-gray-600 mt-1">Prices are in Ethiopian Birr (ETB). Menu is updated regularly.</p>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-blue-600 to-green-500 mt-12 py-8">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
          <div class="text-center md:text-left">
            <p class="text-white font-medium">{{ businessName }}</p>
            <p class="text-blue-100 text-sm">Digital Menu • Powered by Digital Menu Pro</p>
          </div>
          <div class="text-center md:text-right">
            <p class="text-white text-sm">© {{ currentYear }} All rights reserved</p>
            <p class="text-blue-100 text-sm">Contact: +251 900 000 000</p>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from "vue";
import { useRoute } from "vue-router";
import axios from "../axios";

const route = useRoute();
const slug = route.params.slug;

const businessName = ref("");
const categories = ref([]);
const loading = ref(true);
const error = ref(null);

const currentYear = new Date().getFullYear();
const formattedDate = computed(() => {
  return new Date().toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
});

const totalItems = computed(() => {
  return categories.value.reduce((total, cat) => total + cat.menu_items.length, 0);
});

const averagePrice = computed(() => {
  if (totalItems.value === 0) return '0.00';
  const total = categories.value.reduce((totalPrice, cat) => {
    return totalPrice + cat.menu_items.reduce((catTotal, item) => 
      catTotal + parseFloat(item.final_price || 0), 0
    );
  }, 0);
  return (total / totalItems.value).toFixed(2);
});

const getAverageTax = () => {
  if (totalItems.value === 0) return 0;
  const totalTax = categories.value.reduce((total, cat) => {
    return total + cat.menu_items.reduce((catTotal, item) => 
      catTotal + parseFloat(item.tax_percentage || 0), 0
    );
  }, 0);
  return (totalTax / totalItems.value).toFixed(1);
};

const loadMenu = async () => {
  try {
    loading.value = true;
    const res = await axios.get(`/public-menu/${slug}`);
    businessName.value = res.data.business_name;
    categories.value = res.data.categories;
  } catch (err) {
    error.value = "Menu not found or is no longer available";
    console.error('Error loading menu:', err);
  } finally {
    loading.value = false;
  }
};

onMounted(loadMenu);
</script>