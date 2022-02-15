<template>
  <div>
    <Head title="Tickets" />
    <h1 class="mb-8 text-3xl font-bold">My Tickets</h1>
    <div class="flex items-center justify-between mb-6">
      <Link class="btn-indigo" href="/tickets/create">
        <span>Buy</span>
        <span class="hidden md:inline">&nbsp;Ticket !</span>
      </Link>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">ID</th>
          <th class="pb-4 pt-6 px-6">QR Code</th>
          <th class="pb-4 pt-6 px-6" colspan="2">s</th>
        </tr>
        <tr v-for="ticket in tickets" :key="ticket.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            {{ ticket.id }}
          </td>
          <td class="border-t">
            {{ ticket.id }}
          </td>
                <td class="border-t">
            {{ ticket.id }}
          </td>
          <td class="w-px border-t">
            <Link class="flex items-center px-4" :href="`/tickets/${ticket.id}`" tabindex="-1">
              <icon name="show" class="block w-9 h-9 fill-gray-600" />
            </Link>
          </td>

        </tr>
        <tr v-if="tickets.length === 0">
          <td class="px-6 py-4 border-t text-center" colspan="4">No Tickets found.</td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
import { Head , Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import Cards from '@/Shared/Cards'

export default {
  components: {
    Head,
    Link,
    Cards,
  },
  layout: Layout,
  props: {
    tickets: Object,
  },
}
</script>
