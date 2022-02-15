<template>
  <div>
    <Head title="Login" />
    <h1 class="mb-8 text-3xl font-bold">Attendees</h1>
    <div class="flex items-center justify-between mb-6">
      <!-- <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
        <label class="block text-gray-700">Role:</label>
        <select v-model="form.role" class="form-select mt-1 w-full">
          <option :value="null" />
          <option value="admin">Admin</option>
          <option value="user">User</option>
        </select>
        <label class="block mt-4 text-gray-700">Trashed:</label>
        <select v-model="form.trashed" class="form-select mt-1 w-full">
          <option :value="null" />
          <option value="with">With Trashed</option>
          <option value="only">Only Trashed</option>
        </select>
      </search-filter> -->
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Id</th>
          <th class="pb-4 pt-6 px-6">Name</th>
          <th class="pb-4 pt-6 px-6">Ticket</th>
          <th class="pb-4 pt-6 px-6" colspan="2">Status</th>
        </tr>
        <tr v-for="attendee in current_attendees" :key="attendee.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            {{ attendee.id }}
          </td>
          <td class="border-t">
            {{ attendee.name }}
          </td>
          <td class="border-t">
            {{ attendee.ticket }}
          </td>
          <td class="border-t">
            {{ attendee.status }}
          </td>
        </tr>
        <tr v-if="current_attendees.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No attendees found.</td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'
import pickBy from 'lodash/pickBy'
import Layout from '@/Shared/Layout'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
import SearchFilter from '@/Shared/SearchFilter'

export default {
  components: {
    Head,
    Icon,
    Link,
    SearchFilter,
  },
  layout: Layout,
  props: {
    current_attendees: Object,
  },

}
</script>
