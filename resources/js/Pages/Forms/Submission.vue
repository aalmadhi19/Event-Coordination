<template>
  <div>
    <Head :title="$t('Forms')" />
    <div class="flex justify-start mb-8 max-w-3xl">
      <h1 class="text-3xl font-bold">
        <Link class="text-indigo-400 hover:text-indigo-600" href="/submissions"> {{ $t('Forms') }}</Link>
        <span class="text-indigo-400 font-medium">/</span>
        {{ submission.id }}
      </h1>
    </div>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <fieldset :disabled="true">
        <form>
          <div class="flex flex-wrap -mb-8 -mr-6 p-8">
            <text-input v-model="submission.id" class="pb-8 pr-6 w-full lg:w-1/2" :label="$t('Id')" />
            <text-input v-model="submission.title" class="pb-8 pr-6 w-full lg:w-1/2" :label="$t('title')" />
            <text-input v-model="submission.status" class="pb-8 pr-6 w-full lg:w-1/2" :label="$t('status')" />
            <text-input v-model="submission.new" class="pb-8 pr-6 w-full lg:w-1/2" :label="$t('new')" />
            <text-input v-model="submission.count" class="pb-8 pr-6 w-full lg:w-1/2" :label="$t('count')" />
            <text-input v-model="submission.last_submission" class="pb-8 pr-6 w-full lg:w-1/2" :label="$t('last_submission')" />
            <text-input v-model="submission.url" class="pb-8 pr-6 w-full lg:w-1/2" :label="$t('url')" />
          </div>
        </form>
      </fieldset>
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
    submission: Object,
  },
}
</script>
