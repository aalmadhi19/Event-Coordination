<template>
  <Head :title="$t('Verify')"    />
  <div class="flex items-center justify-center p-6 min-h-screen bg-indigo-800">
    <div class="w-full max-w-md">
      <logo class="block mx-auto fill-white" height="120" width="80" />
      <form class="mt-8 bg-white rounded-lg shadow-xl overflow-hidden" @submit.prevent="sendAgain">
        <div class="px-10 py-12">
          <h1 class="text-center text-3xl font-bold">{{ $t('Verify Your Email Address') }}</h1>
          <div class="mt-3 mx-auto w-24 border-b-2" />
          <h1 class="text-center mt-3 text-lg font-bold">{{ $t('Before proceeding, please check your email for a verification link.') }}</h1>
        </div>
        <div class="flex px-10 py-4 bg-gray-100 border-t border-gray-100">
          <loading-button :loading="form.processing" class="btn-indigo mr-auto" type="submit"> {{ $t('Send Again') }} </loading-button>
          <Link class="btn-indigo ml-auto" href="/logout" method="delete" as="button"> {{ $t('Logout') }}</Link>
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
  methods: {
    sendAgain() {
      this.form.post('/email/resend')
    },
  },
}
</script>
