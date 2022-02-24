<template>
  <Head :title="$t('Welcome')" />

  <div class="flex items-center justify-center p-6 min-h-screen bg-indigo-800">
    <div class="w-full max-w-md">
      <logo class="block mx-auto fill-white" height="120" width="80" />
      <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="register">
        <div class="px-10 py-12">
          <h1 class="text-center text-3xl font-bold">{{ $t('Welcome') }}</h1>
          <div class="mt-6 mx-auto w-24 border-b-2" />
          <text-input v-model="siteForm.name" :error="siteForm.errors.name" required autofocus autocomplete="name" class="mt-10" :label="$t('Name')" type="text" />
          <text-input v-model="siteForm.phone" :error="siteForm.errors.phone" required autocomplete="phone" class="mt-10" :label="$t('Phone')" type="text" />
          <text-input v-model="siteForm.email" :error="siteForm.errors.email" required autocomplete="email" class="mt-10" :label="$t('Email')" type="email" />
          <text-input v-model="siteForm.password" :error="siteForm.errors.password" required class="mt-10" :label="$t('Password')" type="password" autocomplete="new-password" />
          <text-input v-model="siteForm.password_confirmation" :error="siteForm.errors.password_confirmation" required class="mt-10" :label="$t('Password Confirmation')" type="password" autocomplete="new-password" />
        </div>
        <div class="flex px-10 py-4 bg-gray-100 border-t border-gray-100">
          <Link :href="'/login'" class="underline text-sm text-gray-600 hover:text-gray-900 mt-5"> {{ $t('Already registered?') }} </Link>
          <loading-button :loading="siteForm.processing" class="btn-indigo ml-auto" type="submit">{{ $t('register') }} </loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Logo from '@/Shared/Logo'
import TextInput from '@/Shared/TextInput'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  components: {
    Head,
    Link,
    LoadingButton,
    Logo,
    TextInput,
  },
  props: {
    form: Object,
  },

  data() {
    return {
      siteForm: this.$inertia.form({
        name: '',
        phone: '',
        email: '',
        password: '',
        password_confirmation: '',
      }),
    }
  },

  methods: {
    register() {
      this.siteForm.post('/register', {
        onFinish: () => this.form.reset('password', 'password_confirmation'),
      })
    },
  },
}
</script>
