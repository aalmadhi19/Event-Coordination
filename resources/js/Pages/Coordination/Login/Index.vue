<template>
  <div>
    <Head title="Login Gate" />
    <h1 class="mb-8 text-3xl font-bold">Login Gate</h1>
    <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
        <label class="block text-gray-700">Status:</label>
        <select v-model="form.status" class="form-select mt-1 w-full">
          <option value="none">None</option>
          <option value="in">In</option>
          <option value="out">Out</option>
        </select>
      </search-filter>
      <div class="w-50 h-20">
        <qrcode-stream @decode="onDecode" @init="onInit" />
      </div>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">Id</th>
          <th class="pb-4 pt-6 px-6">Name</th>
          <th class="pb-4 pt-6 px-6" colspan="2">Status</th>
        </tr>
        <tr v-for="ticket in tickets.data" :key="ticket.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/tickets/${ticket.id}`" tabindex="-1">
              {{ ticket.id }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/tickets/${ticket.id}`" tabindex="-1">
              {{ ticket.user.name }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/tickets/${ticket.id}`" tabindex="-1">
              {{ ticket.status }}
            </Link>
          </td>
          <td class="w-px border-t">
            <Link class="flex items-center px-4" :href="`/tickets/${ticket.id}`" tabindex="-1">
              <icon name="cheveron-right" class="block w-9 h-9 fill-gray-600" />
            </Link>
          </td>
        </tr>
        <tr v-if="tickets.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">No tickets found.</td>
        </tr>
      </table>
    </div>
    <Pagination class="mt-6" :links="tickets.links" />
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
import Pagination from '@/Shared/Pagination'
import { QrcodeStream, QrcodeDropZone, QrcodeCapture } from 'vue3-qrcode-reader'

export default {
  components: {
    Head,
    Icon,
    Link,
    SearchFilter,
    QrcodeStream,
    QrcodeDropZone,
    QrcodeCapture,
    Pagination,
  },
  layout: Layout,
  props: {
    filters: Object,
    tickets: Object,
  },
  data() {
    return {
      form: {
        search: this.filters.search,
        status: this.filters.status,
      },
    }
  },
  watch: {
    form: {
      deep: true,
      handler: throttle(function () {
        this.$inertia.get('/coordinate/login/', pickBy(this.form), { preserveState: true })
      }, 150),
    },
  },
  methods: {
    onDecode(result) {
      this.$inertia.post('/coordinate/login/read', {
        code: result,
      })
      var audio = new Audio('/assets/beep.mp3')
      audio.play()
    },

    async onInit(promise) {
      try {
        await promise
      } catch (error) {
        if (error.name === 'NotAllowedError') {
          this.error = 'ERROR: you need to grant camera access permission'
        } else if (error.name === 'NotFoundError') {
          this.error = 'ERROR: no camera on this device'
        } else if (error.name === 'NotSupportedError') {
          this.error = 'ERROR: secure context required (HTTPS, localhost)'
        } else if (error.name === 'NotReadableError') {
          this.error = 'ERROR: is the camera already in use?'
        } else if (error.name === 'OverconstrainedError') {
          this.error = 'ERROR: installed cameras are not suitable'
        } else if (error.name === 'StreamApiNotSupportedError') {
          this.error = 'ERROR: Stream API is not supported in this browser'
        } else if (error.name === 'InsecureContextError') {
          this.error = 'ERROR: Camera access is only permitted in secure context. Use HTTPS or localhost rather than HTTP.'
        } else {
          this.error = `ERROR: Camera error (${error.name})`
        }
      }
    },

    reset() {
      this.form = mapValues(this.form, () => null)
    },
  },
}
</script>
