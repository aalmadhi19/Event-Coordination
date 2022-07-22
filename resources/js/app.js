import { createI18n } from "vue-i18n";
import localeMessages from "./vue-i18n-locales.generated";

import { createApp, h } from 'vue'
import { InertiaProgress } from '@inertiajs/progress'
import { createInertiaApp } from '@inertiajs/inertia-vue3'

window.axios = require('axios');
const i18n = createI18n(/*...*/)

InertiaProgress.init()

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  title: title => title ? `${title} - Event-Coordination ` : 'Event-Coordination',
  setup({ el, App, props, plugin }) {
     const i18n = createI18n({
            locale: props.initialPage.props.locale, // user locale by props
            fallbackLocale: "en", // set fallback locale
            messages: localeMessages, // set locale messages
        });
        return createApp({ render: () => h(App, props) })
        .use(plugin)
        .use(i18n)
        .mount(el);
  },
})