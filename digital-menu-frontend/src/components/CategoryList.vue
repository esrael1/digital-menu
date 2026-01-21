<template>
  <div>
    <h2 class="text-xl font-bold mb-2">Categories</h2>
    <form @submit.prevent="addCategory" class="mb-4 flex gap-2">
      <input v-model="newCategory.name" type="text" placeholder="Category Name" class="border p-2 rounded" />
      <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Add</button>
    </form>
    <ul>
      <li v-for="category in categories" :key="category.id" class="flex justify-between border p-2 mb-2">
        <span>{{ category.name }}</span>
        <button @click="deleteCategory(category.id)" class="bg-red-500 text-white px-2 rounded">Delete</button>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../axios';

const categories = ref([]);
const newCategory = ref({ name: '' });

const fetchCategories = async () => {
  const res = await api.get('/categories');
  categories.value = res.data;
};

const addCategory = async () => {
  await api.post('/categories', newCategory.value);
  newCategory.value.name = '';
  fetchCategories();
};

const deleteCategory = async (id) => {
  await api.delete(`/categories/${id}`);
  fetchCategories();
};

onMounted(fetchCategories);
</script>
