<script setup>
import { ref, onMounted, watch } from "vue";
import axios from "../axios";

/* =========================
   STATE
========================= */
const categories = ref([]);           // categories with menu_items
const categoriesDropdown = ref([]);   // categories for select
const search = ref("");

const form = ref({
  category_id: null,
  item_name: "",
  price: "",
  tax_percentage: ""
});

/* =========================
   LOAD MENU ITEMS
========================= */
const loadItems = async () => {
  try {
    const res = await axios.get("/menu-items", {
      params: { search: search.value }
    });
    categories.value = res.data;
  } catch (err) {
    console.error("Failed to load items", err);
  }
};

/* =========================
   LOAD CATEGORIES
========================= */
const loadCategories = async () => {
  try {
    const res = await axios.get("/categories");
    categoriesDropdown.value = res.data;
  } catch (err) {
    console.error("Failed to load categories", err);
  }
};

/* =========================
   ADD MENU ITEM
========================= */
const addItem = async () => {
  if (!form.value.category_id) {
    alert("Please select a category");
    return;
  }

  try {
    await axios.post("/menu-items", {
      category_id: form.value.category_id,
      item_name: form.value.item_name,
      price: Number(form.value.price),
      tax_percentage: Number(form.value.tax_percentage || 0)
    });

    // reset form
    form.value = {
      category_id: null,
      item_name: "",
      price: "",
      tax_percentage: ""
    };

    loadItems();
  } catch (err) {
    console.error(err);
    alert(err.response?.data?.message || "Failed to add item");
  }
};

/* =========================
   DELETE MENU ITEM
========================= */
const deleteItem = async (id) => {
  if (!confirm("Delete this menu item?")) return;

  try {
    await axios.delete(`/menu-items/${id}`);
    loadItems();
  } catch (err) {
    console.error(err);
    alert("Failed to delete item");
  }
};

/* =========================
   WATCH SEARCH
========================= */
watch(search, () => {
  loadItems();
});

/* =========================
   ON MOUNT
========================= */
onMounted(() => {
  loadCategories();
  loadItems();
});
</script>

<template>
  <div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Menu Items Management</h1>

    <!-- ADD ITEM FORM -->
    <div class="grid grid-cols-5 gap-3 mb-6">
      <select
        v-model.number="form.category_id"
        class="border p-2 rounded"
      >
        <option disabled value="">Select Category</option>
        <option
          v-for="cat in categoriesDropdown"
          :key="cat.id"
          :value="cat.id"
        >
          {{ cat.name }}
        </option>
      </select>

      <input
        v-model="form.item_name"
        placeholder="Item name"
        class="border p-2 rounded"
      />

      <input
        v-model="form.price"
        type="number"
        placeholder="Price"
        class="border p-2 rounded"
      />

      <input
        v-model="form.tax_percentage"
        type="number"
        placeholder="Tax %"
        class="border p-2 rounded"
      />

      <button
        @click="addItem"
        class="bg-green-600 text-white px-4 rounded hover:bg-green-700"
      >
        Add
      </button>
    </div>

    <!-- SEARCH -->
    <input
      v-model="search"
      placeholder="Search items..."
      class="border p-2 rounded w-full mb-6"
    />

    <!-- MENU ITEMS -->
    <div v-for="cat in categories" :key="cat.id" class="mb-8">
      <h2 class="text-xl font-semibold mb-3">
        {{ cat.name }}
      </h2>

      <div v-if="cat.menu_items.length" class="space-y-2">
        <div
          v-for="item in cat.menu_items"
          :key="item.id"
          class="flex justify-between items-center border p-3 rounded"
        >
          <div>
            <p class="font-medium">{{ item.item_name }}</p>
            <p class="text-sm text-gray-500">
              Price: {{ item.price }} ETB |
              Tax: {{ item.tax_percentage }}% |
              Final: {{ item.final_price }} ETB
            </p>
          </div>

          <button
            @click="deleteItem(item.id)"
            class="text-red-600 hover:underline"
          >
            Delete
          </button>
        </div>
      </div>

      <p v-else class="text-gray-400 text-sm">
        No items in this category
      </p>
    </div>
  </div>
</template>
