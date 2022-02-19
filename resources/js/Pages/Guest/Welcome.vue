<template>
  <Head title="Welcome" />

  <div class="flex items-center justify-center p-6 min-h-screen bg-indigo-800">
    <div class="w-full max-w-md">
      <logo class="block mx-auto fill-white" height="120" width="80" />
      <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="register">
        <div class="px-10 py-12">
          <h1 class="text-center text-3xl font-bold">Welcome</h1>
          <div class="mt-6 mx-auto w-24 border-b-2" />
          <text-input v-model="form.name" :error="form.errors.name" required autofocus autocomplete="name" class="mt-10" label="Name" type="text" />
          <text-input v-model="form.phone" :error="form.errors.phone" required autocomplete="phone" class="mt-10" label="Phone" type="text" />
          <text-input v-model="form.email" :error="form.errors.email" required autocomplete="email" class="mt-10" label="Email" type="email" />
          <text-input v-model="form.password" :error="form.errors.password" required class="mt-10" label="Password" type="password" autocomplete="new-password" />
          <text-input v-model="form.password_confirmation" :error="form.errors.password_confirmation" required class="mt-10" label="Password Confirmation" type="password" autocomplete="new-password"/>
        </div>
        <div class="flex px-10 py-4 bg-gray-100 border-t border-gray-100">
          <Link :href="'/login'" class="underline text-sm text-gray-600 hover:text-gray-900 mt-5"> Already registered? </Link>
          <loading-button :loading="form.processing" class="btn-indigo ml-auto" type="submit">Register</loading-button>
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
  data() {
    return {
      form: this.$inertia.form({
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
      this.form.post('/register', {
        onFinish: () => this.form.reset('password', 'password_confirmation'),
      })
    },
  },
}
</script>
