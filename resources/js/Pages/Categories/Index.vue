<template>
  <div>
    <Head title="Categories" />
    <h1 class="mb-8 text-3xl font-bold">Categories</h1>
    <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
        <label class="block text-gray-700">Trashed:</label>
        <select v-model="form.trashed" class="form-select mt-1 w-full">
          <option :value="null" />
          <option value="with">With Trashed</option>
          <option value="only">Only Trashed</option>
        </select>
      </search-filter>
      <Link class="btn-indigo" href="/categories/create">
        <span>Create</span>
        <span class="hidden md:inline">&nbsp;Category</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <thead>
          <tr class="text-left font-bold">
            <th class="pb-4 pt-6 px-6">Name</th>
            <th class="pb-4 pt-6 px-6">Slug</th>
            <th class="pb-4 pt-6 px-6">Products</th>
            <th class="pb-4 pt-6 px-6">Active</th>
            <th class="pb-4 pt-6 px-6" colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="category in categories.data" :key="category.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
            <td class="border-t">
              <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/categories/${category.id}/edit`">
                {{ category.name }}
                <icon v-if="category.deleted_at" name="trash" class="shrink-0 ml-2 w-3 h-3 fill-gray-400" />
              </Link>
            </td>
            <td class="border-t">
              <Link class="flex items-center px-6 py-4" :href="`/categories/${category.id}/edit`" tabindex="-1">
                {{ category.slug }}
              </Link>
            </td>
            <td class="border-t px-6 py-4">
              <span class="text-gray-700">{{ category.products_count ?? 0 }}</span>
            </td>
            <td class="border-t px-6 py-4">
              <span v-if="category.is_active" class="text-green-600">Yes</span>
              <span v-else class="text-gray-500">No</span>
            </td>
            <td class="w-px border-t">
              <Link class="flex items-center px-4" :href="`/categories/${category.id}/edit`" tabindex="-1">
                <icon name="cheveron-right" class="block w-6 h-6 fill-gray-400" />
              </Link>
            </td>
          </tr>
          <tr v-if="categories.data.length === 0">
            <td class="px-6 py-4 border-t" colspan="5">No categories found.</td>
          </tr>
        </tbody>
      </table>
    </div>
    <pagination class="mt-6" :links="categories.links" />
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/vue3'
import Icon from '@/Shared/Icon.vue'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout.vue'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import Pagination from '@/Shared/Pagination.vue'
import SearchFilter from '@/Shared/SearchFilter.vue'

export default {
  components: {
    Head,
    Icon,
    Link,
    Pagination,
    SearchFilter,
  },
  layout: Layout,
  props: {
    filters: Object,
    categories: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        trashed: this.filters.trashed,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/categories', pickBy(this.form), { preserveState: true })
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
