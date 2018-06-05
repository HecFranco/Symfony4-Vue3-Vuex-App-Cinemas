<template>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <font-awesome-icon icon="language"></font-awesome-icon>
      <!-- {{ $t('navigation.language') }} -->
      ({{ currentLanguage }}) <span class="caret"></span>
    </a>

    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
      <a class="dropdown-item" href="#" 
        v-for="(language, index) in languages" :key="index"
        @click.prevent="updateLanguage(language.value)"
      >
        {{ language.label }}
      </a>
    </div>
  </li>
</template>

<script>
  import globalTypes from '../types/global';
  import {mapActions} from 'vuex';
  export default {
    name: 'language-selector',
    data () {
      return {
        selected_language: 'es',
        languages: [
          { value: 'es', label: 'Español' },
          { value: 'en', label: 'Inglés' },
        ]
      }
    },
    methods: {
      ...mapActions({
        setLanguage: globalTypes.actions.changeLanguage
      }),
      updateLanguage (language) {
        this.selected_language = language;
        this.setLanguage(this.selected_language);
        this.$i18n.locale = this.selected_language;
      }
    },
    computed: {
      currentLanguage () {
        return this.languages.filter(language => language.value === this.selected_language)[0].label;
      }
    }
  }
</script>
