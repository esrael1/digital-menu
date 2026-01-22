<template>
  <div class="space-y-6">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-green-500 rounded-xl shadow-lg p-6">
      <div class="flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
        <div class="flex items-center space-x-3">
          <div class="bg-white/20 p-2 rounded-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
          </div>
          <div>
            <h2 class="text-xl font-bold text-white">Categories</h2>
            <p class="text-blue-100 text-sm">Organize your menu into categories</p>
          </div>
        </div>
        <div class="text-white">
          <span class="text-sm bg-white/20 px-3 py-1 rounded-full">
            {{ categories.length }} categories
          </span>
        </div>
      </div>
    </div>

    <!-- Add Category Form -->
    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
      <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center space-x-2">
        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        <span>Add New Category</span>
      </h3>
      
      <form @submit.prevent="addCategory" class="flex flex-col sm:flex-row gap-4">
        <div class="flex-1 relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
          </div>
          <input
            v-model="newCategory.name"
            type="text"
            placeholder="Enter category name (e.g., Appetizers, Main Course, Desserts)"
            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all outline-none"
            :class="{ 'border-red-300': formSubmitted && !newCategory.name }"
          />
        </div>
        
        <button
          type="submit"
          :disabled="isAdding"
          class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 flex items-center justify-center space-x-2 min-w-[120px] disabled:opacity-50 disabled:cursor-not-allowed"
        >
          <svg v-if="!isAdding" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
          </svg>
          <svg v-if="isAdding" class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          <span>{{ isAdding ? 'Adding...' : 'Add Category' }}</span>
        </button>
      </form>
      
      <!-- Form Validation Error -->
      <div v-if="formSubmitted && !newCategory.name" class="mt-4 p-3 bg-red-50 border border-red-200 rounded-lg flex items-start">
        <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
        <p class="text-red-700 text-sm">Please enter a category name</p>
      </div>
    </div>

    <!-- Categories List -->
    <div v-if="categories.length === 0 && !loading" class="text-center py-12 bg-white rounded-xl shadow-lg">
      <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
        </svg>
      </div>
      <p class="text-gray-500 mb-2">No categories yet</p>
      <p class="text-gray-400 text-sm">Create your first category to organize menu items</p>
    </div>

    <div v-else class="space-y-4">
      <div
        v-for="category in categories"
        :key="category.id"
        class="group bg-white border border-gray-200 rounded-xl p-6 hover:border-blue-300 hover:shadow-md transition-all duration-300"
      >
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-4">
            <div class="bg-blue-50 p-3 rounded-full">
              <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
              </svg>
            </div>
            <div>
              <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">
                {{ category.name }}
              </h3>
              <p class="text-sm text-gray-500 mt-1">
                Created {{ formatDate(category.created_at) }}
              </p>
            </div>
          </div>
          
          <div class="flex items-center space-x-3">
            <!-- Edit Button (Optional) -->
            <button 
              @click="editCategory(category)"
              class="text-blue-600 hover:text-blue-800 p-2 rounded-full hover:bg-blue-50 transition-colors"
              :disabled="isDeleting[category.id]"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
              </svg>
            </button>
            
            <!-- Delete Button -->
            <button
              @click="deleteCategory(category.id)"
              class="text-red-600 hover:text-red-800 p-2 rounded-full hover:bg-red-50 transition-colors"
              :disabled="isDeleting[category.id]"
            >
              <svg v-if="!isDeleting[category.id]" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
              </svg>
              <svg v-if="isDeleting[category.id]" class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
              </svg>
            </button>
          </div>
        </div>
        
        <!-- Category Stats -->
        <div v-if="category.menu_items_count !== undefined" class="mt-4 pt-4 border-t border-gray-100">
          <div class="flex items-center space-x-6">
            <span class="inline-flex items-center space-x-1 text-sm text-gray-600">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
              </svg>
              <span>{{ category.menu_items_count || 0 }} menu items</span>
            </span>
            
            <span v-if="category.last_updated" class="inline-flex items-center space-x-1 text-sm text-gray-600">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <span>Updated {{ formatRelativeTime(category.last_updated) }}</span>
            </span>
          </div>
        </div>
      </div>
    </div>

    <!-- Loading State -->
    <div v-if="loading" class="space-y-4">
      <div v-for="i in 3" :key="i" class="bg-white border border-gray-200 rounded-xl p-6">
        <div class="flex items-center justify-between">
          <div class="flex items-center space-x-4">
            <div class="bg-gray-200 p-3 rounded-full animate-pulse">
              <div class="w-5 h-5"></div>
            </div>
            <div class="space-y-2">
              <div class="h-5 w-48 bg-gray-200 rounded animate-pulse"></div>
              <div class="h-3 w-32 bg-gray-100 rounded animate-pulse"></div>
            </div>
          </div>
          <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gray-200 rounded-full animate-pulse"></div>
            <div class="w-10 h-10 bg-gray-200 rounded-full animate-pulse"></div>
          </div>
        </div>
      </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div v-if="categoryToDelete" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
      <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6">
        <div class="w-12 h-12 mx-auto mb-4 bg-red-100 rounded-full flex items-center justify-center">
          <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.998-.833-2.732 0L4.346 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
          </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-800 text-center mb-2">Delete Category?</h3>
        <p class="text-gray-600 text-center mb-6">
          Are you sure you want to delete "<span class="font-semibold">{{ categoryToDelete.name }}</span>"?
          <span v-if="categoryToDelete.menu_items_count > 0" class="block mt-2 text-red-600 text-sm">
            This category contains {{ categoryToDelete.menu_items_count }} menu item(s) that will also be deleted.
          </span>
        </p>
        <div class="flex space-x-3">
          <button
            @click="cancelDelete"
            class="flex-1 py-3 px-4 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors"
            :disabled="isDeleting[categoryToDelete.id]"
          >
            Cancel
          </button>
          <button
            @click="confirmDelete"
            class="flex-1 py-3 px-4 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-medium rounded-lg transition-all duration-300 flex items-center justify-center space-x-2"
            :disabled="isDeleting[categoryToDelete.id]"
          >
            <svg v-if="isDeleting[categoryToDelete.id]" class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>{{ isDeleting[categoryToDelete.id] ? 'Deleting...' : 'Delete Category' }}</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../axios';

const categories = ref([]);
const newCategory = ref({ name: '' });
const loading = ref(false);
const isAdding = ref(false);
const formSubmitted = ref(false);
const isDeleting = ref({});
const categoryToDelete = ref(null);

const formatDate = (dateString) => {
  if (!dateString) return '';
  const date = new Date(dateString);
  return date.toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'short',
    day: 'numeric'
  });
};

const formatRelativeTime = (dateString) => {
  if (!dateString) return '';
  const date = new Date(dateString);
  const now = new Date();
  const diffMs = now - date;
  const diffMins = Math.floor(diffMs / 60000);
  const diffHours = Math.floor(diffMs / 3600000);
  const diffDays = Math.floor(diffMs / 86400000);

  if (diffMins < 1) return 'just now';
  if (diffMins < 60) return `${diffMins} minute${diffMins > 1 ? 's' : ''} ago`;
  if (diffHours < 24) return `${diffHours} hour${diffHours > 1 ? 's' : ''} ago`;
  if (diffDays < 7) return `${diffDays} day${diffDays > 1 ? 's' : ''} ago`;
  return formatDate(dateString);
};

const fetchCategories = async () => {
  try {
    loading.value = true;
    const res = await api.get('/categories');
    // Add menu items count to each category
    categories.value = res.data.map(category => ({
      ...category,
      menu_items_count: category.menu_items?.length || 0
    }));
  } catch (error) {
    console.error('Error fetching categories:', error);
  } finally {
    loading.value = false;
  }
};

const addCategory = async () => {
  formSubmitted.value = true;
  
  if (!newCategory.value.name.trim()) {
    return;
  }

  try {
    isAdding.value = true;
    await api.post('/categories', { name: newCategory.value.name.trim() });
    
    newCategory.value.name = '';
    formSubmitted.value = false;
    
    await fetchCategories();
  } catch (error) {
    console.error('Error adding category:', error);
  } finally {
    isAdding.value = false;
  }
};

const editCategory = (category) => {
  // For future implementation - could open edit modal
  const newName = prompt('Edit category name:', category.name);
  if (newName && newName.trim() !== category.name) {
    // Call API to update category
    console.log('Would update category:', category.id, 'to:', newName);
  }
};

const deleteCategory = async (id) => {
  const category = categories.value.find(c => c.id === id);
  if (!category) return;
  
  categoryToDelete.value = category;
};

const confirmDelete = async () => {
  if (!categoryToDelete.value) return;

  try {
    isDeleting.value[categoryToDelete.value.id] = true;
    await api.delete(`/categories/${categoryToDelete.value.id}`);
    await fetchCategories();
    categoryToDelete.value = null;
  } catch (error) {
    console.error('Error deleting category:', error);
  } finally {
    isDeleting.value[categoryToDelete.value?.id] = false;
  }
};

const cancelDelete = () => {
  categoryToDelete.value = null;
};

onMounted(fetchCategories);
</script>