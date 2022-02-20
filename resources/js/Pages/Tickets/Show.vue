<template>
  <div>
    <Head title="Tickets" />
    <div class="flex justify-start mb-8 max-w-3xl">
      <h1 class="text-3xl font-bold">
        <Link class="text-indigo-400 hover:text-indigo-600" href="/tickets">Tickets</Link>
        <span class="text-indigo-400 font-medium">/</span>
        {{ ticket.id }}
      </h1>
    </div>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <fieldset :disabled="true">
        <form>
          <div class="flex flex-wrap -mb-8 -mr-6 p-8">
            <text-input v-model="ticket.id" class="pb-8 pr-6 w-full lg:w-1/2" label="ID" />
            <text-input v-model="ticket.user.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Name" />
            <text-input v-model="ticket.user.phone" class="pb-8 pr-6 w-full lg:w-1/2" label="Phone" />
            <label class="form-label">QR Code:</label>
            <Link class="flex items-center p-2 mt-4" :href="`/tickets/download/${ticket.id}`" tabindex="-1">
              <Image width="120" height="80" :src="'/' + ticket.qr_path" />
            </Link>
          </div>
        </form>
      </fieldset>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import FileInput from '@/Shared/FileInput'
import LoadingButton from '@/Shared/LoadingButton'
import Image from '@/Shared/Image'
import Icon from '@/Shared/Icon'

export default {
  components: {
    FileInput,
    Head,
    Link,
    LoadingButton,
    TextInput,
    Image,
    Icon,
  },
  layout: Layout,
  props: {
    ticket: Object,
  },
}
</script>
