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
            <Image width="120" height="80" :src="'/' + ticket.qr_path" />
            <a :href="`/tickets/download/${ticket.id}`" class="text-indigo-400 hover:text-indigo-600">Download</a>
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

export default {
  components: {
    FileInput,
    Head,
    Link,
    LoadingButton,
    TextInput,
    Image,
  },
  layout: Layout,
  props: {
    ticket: Object,
  },
}
</script>
