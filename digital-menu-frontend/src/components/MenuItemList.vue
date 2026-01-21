<template>
  <div>
    <h2 class="text-xl font-bold mb-2">Menu Items</h2>
    <form @submit.prevent="addItem" class="mb-4 grid grid-cols-5 gap-2">
      <input v-model="newItem.item_name" type="text" placeholder="Item Name" class="border p-2 rounded" />
      <input v-model="newItem.price" type="number" placeholder="Price" class="border p-2 rounded" />
      <input v-model="newItem.tax_percentage" type="number" placeholder="Tax %" class="border p-2 rounded" />
      <select v-model="newItem.category_id" class="border p-2 rounded">
        <option v-for="cat in categories" :value="cat.id" :key="cat.id">{{ cat.name }}</option>
      </select>
      <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Add</button>
    </form>

    <ul>
      <li v-for="item in items" :key="item.id" class="border p-2 mb-2 flex justify-between">
        <span>{{ item.item_name }} ({{ item.category.name }}) - ${{ item.final_price }}</span>
        <button @click="deleteItem(item.id)" class="bg-red-500 text-white px-2 rounded">Delete</button>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import api from '../axios';

const categories = ref([]);
const items = ref([]);
const newItem = ref({
  item_name: '',
  price: 0,
  tax_percentage: 0,
  category_id: null,
});

const fetchCategories = async () => {
  const res = await api.get('/categories');
  categories.value = res.data;
};

const fetchItems = async () => {
  const res = await api.get('/menu-items');
  items.value = res.data;
};

const addItem = async () => {
  await api.post('/menu-items', newItem.value);
  newItem.value = { item_name: '', price: 0, tax_percentage: 0, category_id: null };
  fetchItems();
};

const deleteItem = async (id) => {
  await api.delete(`/menu-items/${id}`);
  fetchItems();
};

onMounted(() => {
  fetchCategories();
  fetchItems();
});
</script>
