<template>
  <div>
    <Head :title="$t('Forms')" />
    <div class="flex justify-start mb-8 max-w-3xl">
      <h1 class="text-3xl font-bold">
        <Link class="text-indigo-400 hover:text-indigo-600" href="/forms"> {{ $t('Forms') }}</Link>
        <span class="text-indigo-400 font-medium">/</span>
        {{ form.id }}
      </h1>
    </div>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <fieldset :disabled="true">
        <form>
          <div class="flex flex-wrap -mb-8 -mr-6 p-8">
            <text-input v-model="form.id" class="pb-8 pr-6 w-full lg:w-1/2" :label="$t('Id')" />
            <text-input v-model="form.title" class="pb-8 pr-6 w-full lg:w-1/2" :label="$t('title')" />
            <text-input v-model="form.status" class="pb-8 pr-6 w-full lg:w-1/2" :label="$t('status')" />
            <text-input v-model="form.new" class="pb-8 pr-6 w-full lg:w-1/2" :label="$t('new')" />
            <text-input v-model="form.count" class="pb-8 pr-6 w-full lg:w-1/2" :label="$t('count')" />
            <text-input v-model="form.last_submission" class="pb-8 pr-6 w-full lg:w-1/2" :label="$t('last_submission')" />
            <text-input v-model="form.url" class="pb-8 pr-6 w-full lg:w-1/2" :label="$t('url')" />
          </div>
        </form>
      </fieldset>
    </div>
    <div class="flex justify-start mb-8 mt-10 max-w-3xl">
      <h1 class="text-3xl font-bold">
        <Link class="text-indigo-400 hover:text-indigo-600"> {{ $t('Submissions') }}</Link>
      </h1>
    </div>
    <div class="bg-white rounded-md shadow overflow-x-auto ">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">{{ $t('Id') }}</th>
          <th class="pb-4 pt-6 px-6" colspan="2">{{ $t('Time') }}</th>
        </tr>
        <tr v-for="submission in submissions" :key="submission.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/forms/submission/${submission.id}`">
              {{ submission.id }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/forms/submission/${submission.id}`" tabindex="-1">
              {{ submission.created_at }}
            </Link>
          </td>
          <td class="w-px border-t">
            <Link class="flex items-center px-4" :href="`/forms/submission/${submission.id}`" tabindex="-1">
              <icon name="cheveron-right" class="block w-9 h-9 fill-gray-600" />
            </Link>
          </td>
        </tr>
        <!-- <tr v-if="submission.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">{{ $t('No submissions found.') }}</td>
        </tr> -->
      </table>
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
    form: Object,
    submissions: Object,
  },
}
</script>
