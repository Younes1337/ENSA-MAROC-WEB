import en from './components/i18n/en.json';
import fr from './components/i18n/fr.json';

import Vue from 'vue';
import VueI18n from 'vue-i18n';
Vue.use(VueI18n);

export default new VueI18n({
    locale: localStorage.getItem('lang') || 'fr',
    fallbackLocale: 'fr',
    messages: {
        fr: fr,
        en: en
    }
});