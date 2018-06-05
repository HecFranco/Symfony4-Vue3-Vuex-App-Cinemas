<template>
  <div id="app">
    <navigation style="position:fixed;width:100%;z-index:10;"></navigation>
    <div v-if="processing">
      <BlockUI :message="$t('messages.processing')"></BlockUI>
    </div>
    <router-view></router-view>
  </div>
</template>

<script>
import globalTypes from "./types/global";
import { mapGetters } from "vuex";

import Navigation from "./components/Navigation.vue";

export default {
  name: "app",
  components: {
    Navigation
  },

  data() {
    return {};
  },
  computed: {
    ...mapGetters({
      processing: globalTypes.getters.processing
    })
  }
};
</script>

<style lang="scss">
@import "../../node_modules/bootstrap/scss/bootstrap.scss";
@import "../../node_modules/bootstrap-vue/dist/bootstrap-vue.css";

body {
  background-color: #36383a !important;
}
.well {
  background-color: #fff !important;
}
.login,
.register,
.movies__wrapper {
  position: relative !important;
  top: 65px !important;
}

#app {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  color: #2c3e50;
}
h1,
h3,
h4,
p {
  color: #fff !important;
}
h2,
a {
  color: #e33a2d !important;
}
th,
td {
  color: #e33a2d !important;
  font-size: 16px;
  font-weight: bold;
  text-align: center;
}
td {
  background-color: #fff;
}
hr {
  border: 1px solid #e33a2d !important;
  width: 100%;
}
.page-link.active {
  background-color: #d24839 !important;
  color: #fff !important;
  border: 1px solid #fff !important;
}

.navbar {
  margin-bottom: 20px;
}
.row {
  margin: 0px;
}
</style>
