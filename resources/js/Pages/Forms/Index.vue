<template>
  <div>
    <Head :title="$t('Forms')" />
    <h1 class="mb-8 text-3xl font-bold">{{ $t('Forms') }}</h1>
    <!-- <div class="flex items-center justify-between mb-6">
      <search-filter v-model="form.search" class="mr-4 w-full max-w-md" @reset="reset">
        <label class="block text-gray-700"> {{ $t('Role') }} :</label>
        <select v-model="form.role" class="form-select mt-1 w-full">
          <option :value="null" />
          <option value="Admin">{{ $t('Admin') }}</option>
          <option value="User">{{ $t('User') }}</option>
        </select>
        <label class="block mt-4 text-gray-700"> {{ $t('Trashed') }} :</label>
        <select v-model="form.trashed" class="form-select mt-1 w-full">
          <option :value="null" />
          <option value="with">{{ $t('With Trashed') }}</option>
          <option value="only">{{ $t('Only Trashed') }}</option>
        </select>
      </search-filter>
      <Link class="btn-indigo" href="/users/create">
        <span> {{ $t('Create') }} </span>
        <span class="hidden md:inline">&nbsp; {{ $t('User') }} </span>
      </Link>
    </div> -->
    <div class="bg-white rounded-md shadow overflow-x-auto">
      <table class="w-full whitespace-nowrap">
        <tr class="text-left font-bold">
          <th class="pb-4 pt-6 px-6">{{ $t('Id') }}</th>
          <th class="pb-4 pt-6 px-6" colspan="2">{{ $t('Title') }}</th>
        </tr>
        <tr v-for="form in forms" :key="form.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
          <td class="border-t">
            <Link class="flex items-center px-6 py-4 focus:text-indigo-500" :href="`/forms/${form.id}`">
              {{ form.id }}
            </Link>
          </td>
          <td class="border-t">
            <Link class="flex items-center px-6 py-4" :href="`/forms/${form.id}`" tabindex="-1">
              {{ form.title }}
            </Link>
          </td>
          <td class="w-px border-t">
            <Link class="flex items-center px-4" :href="`/forms/${form.id}`" tabindex="-1">
              <icon name="cheveron-right" class="block w-9 h-9 fill-gray-600" />
            </Link>
          </td>
        </tr>
        <tr v-if="forms.length === 0">
          <td class="px-6 py-4 border-t" colspan="4">{{ $t('No forms found.') }}</td>
        </tr>
      </table>
    </div>
    <!-- <Pagination class="mt-6" :links="users.links" /> -->
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import Image from '@/Shared/Image'
import TextInput from '@/Shared/TextInput'
import FileInput from '@/Shared/FileInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'

export default {
  components: {
    FileInput,
    Head,
    Link,
    Image,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
  },
  layout: Layout,

  props: {
    forms: Object,
  },
}
</script>
