<template>
  <div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-green-500 rounded-xl shadow-lg p-6">
      <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
        <div class="flex items-center space-x-3">
          <div class="bg-white/20 p-2 rounded-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
          </div>
          <div>
            <h2 class="text-xl font-bold text-white">Menu Items</h2>
            <p class="text-blue-100 text-sm">Manage your restaurant menu items</p>
          </div>
        </div>
        <div class="text-white">
          <span class="text-sm bg-white/20 px-3 py-1 rounded-full">
            {{ totalItems }} items across {{ categories.length }} categories
          </span>
        </div>
      </div>
    </div>

    <!-- Search Bar -->
    <div class="relative">
      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
      </div>
      <input
        v-model="search"
        type="text"
        placeholder="Search menu items by name..."
        class="w-full pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
      />
    </div>

    <!-- Add Item Form -->
    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
      <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        <span>Add New Menu Item</span>
      </h3>
      
      <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <!-- Category Select -->
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
          </div>
          <select
            v-model="form.category_id"
            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none appearance-none"
            :class="{ 'border-red-300': form.category_id === '' && formSubmitted }"
          >
            <option value="" disabled>Select Category</option>
            <option
              v-for="c in categoriesDropdown"
              :key="c.id"
              :value="c.id"
            >
              {{ c.name }}
            </option>
          </select>
        </div>

        <!-- Item Name -->
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
          </div>
          <input
            v-model="form.item_name"
            placeholder="Item Name"
            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
            :class="{ 'border-red-300': !form.item_name && formSubmitted }"
          />
        </div>

        <!-- Price -->
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <input
            v-model="form.price"
            type="number"
            placeholder="Price"
            min="0"
            step="0.01"
            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
            :class="{ 'border-red-300': !form.price && formSubmitted }"
          />
        </div>

        <!-- Tax Percentage -->
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
          </div>
          <input
            v-model="form.tax_percentage"
            type="number"
            placeholder="Tax %"
            min="0"
            max="100"
            step="0.1"
            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
            :class="{ 'border-red-300': !form.tax_percentage && formSubmitted }"
          />
        </div>

        <!-- Add Button -->
        <button
          @click="addItem"
          :disabled="isAdding"
          class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 flex items-center justify-center space-x-2 disabled:opacity-50 disabled:cursor-not-allowed"
        >
          <svg v-if="!isAdding" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
          </svg>
          <svg v-if="isAdding" class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          <span>{{ isAdding ? 'Adding...' : 'Add Item' }}</span>
        </button>
      </div>
      
      <!-- Form Validation Error -->
      <div v-if="formSubmitted && !isFormValid" class="mt-4 p-3 bg-red-50 border border-red-200 rounded-lg flex items-start">
        <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
        <p class="text-red-700 text-sm">Please fill in all required fields</p>
      </div>
    </div>

    <!-- Items by Category -->
    <div v-if="categories.length === 0 && !loading" class="text-center py-12 bg-white rounded-xl shadow-lg">
      <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
      </div>
      <p class="text-gray-500 mb-2">No menu items found</p>
      <p class="text-gray-400 text-sm">Start by adding your first menu item above</p>
    </div>

    <div v-else class="space-y-6">
      <div v-for="cat in categories" :key="cat.id" class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100">
        <!-- Category Header -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6">
          <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
              <div class="bg-white/20 p-2 rounded-lg">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
              </div>
              <h3 class="text-lg font-bold text-white">{{ cat.name }}</h3>
            </div>
            <span class="text-blue-100 bg-white/20 px-3 py-1 rounded-full text-sm font-medium">
              {{ cat.menu_items?.length || 0 }} items
            </span>
          </div>
        </div>

        <!-- Items List -->
        <div class="p-6">
          <div v-if="cat.menu_items && cat.menu_items.length" class="space-y-4">
            <div
              v-for="item in cat.menu_items"
              :key="item.id"
              class="group border border-gray-200 rounded-xl p-5 hover:border-blue-300 hover:shadow-md transition-all duration-300"
            >
              <div class="flex items-center justify-between">
                <div class="flex-1">
                  <div class="flex items-start justify-between">
                    <div>
                      <h4 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">
                        {{ item.item_name }}
                      </h4>
                      <div class="flex items-center space-x-4 mt-2">
                        <span class="inline-flex items-center space-x-1 text-sm text-gray-600">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                          </svg>
                          <span>Base: <span class="font-medium">{{ item.price }} ETB</span></span>
                        </span>
                        <span class="inline-flex items-center space-x-1 text-sm text-gray-600">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                          </svg>
                          <span>Tax: <span class="font-medium">{{ item.tax_percentage }}%</span></span>
                        </span>
                        <span class="inline-flex items-center space-x-1 text-sm text-green-600 font-semibold">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"></path>
                          </svg>
                          <span>Final: {{ item.final_price }} ETB</span>
                        </span>
                      </div>
                    </div>
                    <div class="flex items-center space-x-2 ml-4">
                      <!-- Edit Button (Optional) -->
                      <button class="text-blue-600 hover:text-blue-800 p-2 rounded-full hover:bg-blue-50 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                      </button>
                      <!-- Delete Button -->
                      <button
                        @click="deleteItem(item.id)"
                        class="text-red-600 hover:text-red-800 p-2 rounded-full hover:bg-red-50 transition-colors"
                        :disabled="isDeleting[item.id]"
                      >
                        <svg v-if="!isDeleting[item.id]" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        <svg v-if="isDeleting[item.id]" class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                      </button>
                    </div>
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
            <p class="text-gray-400">No items in this category</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Loading State -->
    <div v-if="loading" class="space-y-6">
      <div v-for="i in 3" :key="i" class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6">
          <div class="h-6 w-48 bg-white/20 rounded animate-pulse"></div>
        </div>
        <div class="p-6 space-y-4">
          <div v-for="j in 3" :key="j" class="border border-gray-200 rounded-xl p-5">
            <div class="space-y-3">
              <div class="h-5 w-64 bg-gray-200 rounded animate-pulse"></div>
              <div class="flex space-x-4">
                <div class="h-4 w-32 bg-gray-100 rounded animate-pulse"></div>
                <div class="h-4 w-24 bg-gray-100 rounded animate-pulse"></div>
                <div class="h-4 w-28 bg-gray-100 rounded animate-pulse"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch, nextTick, computed } from "vue";
import axios from "../axios";

const categories = ref([]);
const categoriesDropdown = ref([]);
const search = ref("");
const loading = ref(false);
const isAdding = ref(false);
const formSubmitted = ref(false);
const isDeleting = ref({});

const form = ref({
  category_id: "",
  item_name: "",
  price: "",
  tax_percentage: "",
});

const totalItems = computed(() => {
  return categories.value.reduce((total, cat) => 
    total + (cat.menu_items?.length || 0), 0
  );
});

const isFormValid = computed(() => {
  return form.value.category_id && 
         form.value.item_name && 
         form.value.price && 
         form.value.tax_percentage;
});

const loadItems = async () => {
  try {
    loading.value = true;
    const res = await axios.get("/menu-items", {
      params: { search: search.value },
    });

    // Force reactive update
    categories.value = [...res.data];
    await nextTick();
  } catch (error) {
    console.error('Error loading items:', error);
  } finally {
    loading.value = false;
  }
};

const loadCategories = async () => {
  try {
    const res = await axios.get("/categories");
    categoriesDropdown.value = [...res.data];
  } catch (error) {
    console.error('Error loading categories:', error);
  }
};

const addItem = async () => {
  formSubmitted.value = true;
  
  if (!isFormValid.value) {
    return;
  }

  try {
    isAdding.value = true;
    await axios.post("/menu-items", form.value);

    // Reset form
    form.value = {
      category_id: "",
      item_name: "",
      price: "",
      tax_percentage: "",
    };
    formSubmitted.value = false;

    // Reload items
    await loadItems();
  } catch (error) {
    console.error('Error adding item:', error);
  } finally {
    isAdding.value = false;
  }
};

const deleteItem = async (id) => {
  if (!confirm('Are you sure you want to delete this menu item?')) {
    return;
  }

  try {
    isDeleting.value[id] = true;
    await axios.delete(`/menu-items/${id}`);
    await loadItems();
  } catch (error) {
    console.error('Error deleting item:', error);
  } finally {
    isDeleting.value[id] = false;
  }
};

watch(search, () => {
  loadItems();
});

onMounted(() => {
  loadItems();
  loadCategories();
});
</script>