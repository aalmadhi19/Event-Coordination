<template>
  <div>
    <Head :title="$t('Management')" />
    <h1 class="mb-8 text-3xl font-bold">
      <Link class="text-indigo-400 hover:text-indigo-600" href="/management"> {{ $t('Management') }}</Link>
    </h1>
    <div class="max-w-3xl bg-white rounded-md shadow overflow-hidden">
      <form @submit.prevent="store">
        <div class="flex flex-wrap -mb-8 -mr-6 p-8">
          <text-input v-model="form.name" :error="form.errors.name" class="pb-8 pr-6 w-full lg:w-1/2" label="Name" />
          <select-input v-model="form.type" :error="form.errors.type" class="pb-8 pr-6 w-full lg:w-1/2" label="Type">
            <option disabled value="">{{ $t('Please select one') }}</option>
            <option v-for="type in types" :key="type.id" :value="type">{{ type }}</option>
          </select-input>

          <text-input v-if="form.type == 'css'" v-model="form.selector" :error="form.errors.selector" class="pb-8 pr-6 w-full lg:w-1/2" label="Selector" />
          <text-input v-if="form.type == 'css'" v-model="form.property" :error="form.errors.property" class="pb-8 pr-6 w-full lg:w-1/2" label="Property" />
          <text-input v-if="form.type == 'css'" v-model="form.value" :error="form.errors.value" class="pb-8 pr-6 w-full lg:w-1/2" label="Value" />

          <select-input v-if="form.type == 'font'" v-model="form.value" :error="form.errors.value" class="pb-8 pr-6 w-full lg:w-1/2" label="Value">
            <option disabled value="">{{ $t('Please select one') }}</option>
            <option v-for="font in fonts" :key="font.id" :value="font">{{ font.family }}</option>
          </select-input>

          <select-input v-if="form.type == 'forms'" v-model="form.value" :error="form.errors.value" class="pb-8 pr-6 w-full lg:w-1/2" :label="$t('Forms Source')">
            <option disabled value="">{{ $t('Please select one') }}</option>
            <option value="jotform">{{ $t('Jot Form') }}</option>
            <option value="site">{{ $t('Site') }}</option>
          </select-input>

          <file-input v-if="form.type == 'logo'" v-model="form.value" :error="form.errors.value" class="pb-8 pr-6 w-full lg:w-1/2" type="file" accept="image/*" label="Photo" />

          <MapInput v-if="form.type == 'map'" v-model="form.value" :error="form.errors.value" />
        </div>
        <div class="flex items-center justify-end px-8 py-4 bg-gray-50 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo" type="submit">{{ $t('Create Setting') }}</loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import FileInput from '@/Shared/FileInput'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import MapInput from '@/Shared/MapInput'

export default {
  components: {
    FileInput,
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    MapInput,
  },
  layout: Layout,
  remember: 'form',
  props: {
    types: Object,
    fonts: Object,
  },
  data() {
    return {
      form: this.$inertia.form({
        name: '',
        type: '',
        selector: '',
        property: '',
        value: '',
      }),
    }
  },

  methods: {
    store() {
      this.form.post('/management')
    },
  },
}
</script>
