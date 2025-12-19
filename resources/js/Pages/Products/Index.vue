<template>
  <div>
    <Head title="Products" />
    <h1 class="mb-8 text-3xl font-bold">Products</h1>

    <div class="flex items-center justify-between mb-6">
      <div class="flex items-center w-full max-w-xl">
        <search-filter v-model="form.search" class="mr-4 w-full" @reset="reset">
          <label class="block text-gray-700">Category:</label>
          <select v-model="form.category" class="form-select mt-1 w-full">
            <option :value="null">All</option>
            <option v-for="c in categories" :key="c.id" :value="c.id">{{ c.name }}</option>
          </select>
        </search-filter>
        <select v-model="form.sort" class="form-select ml-4">
          <option :value="null">Sort</option>
          <option value="price_asc">Price ↑</option>
          <option value="price_desc">Price ↓</option>
        </select>
      </div>
      <Link class="btn-indigo" href="/products/create">Create Product</Link>
    </div>

    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <thead>
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6">Name</th>
            <th class="pb-4 pt-6 px-6">Price</th>
            <th class="pb-4 pt-6 px-6">Category</th>
            <th class="pb-4 pt-6 px-6">Active</th>
            <th class="pb-4 pt-6 px-6" colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products.data" :key="product.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/products/${product.id}/edit`">{{ product.name }}</Link>
            </td>
            <td class="border-t px-6 py-4">€{{ product.price }}</td>
            <td class="border-t px-6 py-4">{{ product.category || '-' }}</td>
            <td class="border-t px-6 py-4">
              <span v-if="product.is_active" class="text-green-600">Yes</span>
              <span v-else class="text-gray-500">No</span>
            </td>
            <td class="w-px border-t">
              <Link class="flex items-center px-4" :href="`/products/${product.id}/edit`" tabindex="-1">
                <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
              </Link>
            </td>
          </tr>
          <tr v-if="products.data.length === 0">
            <td class="px-6 py-4 border-t" colspan="5">No products found.</td>
          </tr>
        </tbody>
      </table>
    </div>
    <pagination class="mt-6" :links="products.links" />
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import Layout from '@/Shared/Layout.vue'
import Pagination from '@/Shared/Pagination.vue'
import SearchFilter from '@/Shared/SearchFilter.vue'
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'

export default {
  components: { Head, Link, Pagination, SearchFilter },
  layout: Layout,
  props: {
    filters: Object,
    products: Object,
    categories: Array,
  },
  data() {
    return {
      categories: this.categories || [],
      form: {
        search: this.filters.search,
        category: this.filters.category,
        sort: this.filters.sort,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/products', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
  },
}
</script>
