<template>
  <div class="row" id="cinemas">
    <div class="col-md-3 col-xs-12" id="filters" style="margin-top:70px; position:fixed">
      <cinema-filter></cinema-filter>      
    </div>      
    <!--
    <div v-if="cinemas.data.length > 0" class="row" id="cinemas" >
    -->
    <div class="col-md-9 col-xs-12 ml-auto" 
      style="margin-top:60px;"
    >
      <div class="row">
        <div 
          v-for="(cinema, index) in cinemas" 
          :key="index" 
          class="col-lg-4 col-md-6 col-xs-12" 
          style="padding:0px;"
        >
          <cinema-item :cinema="cinema" :key="index" style="margin:10px;"></cinema-item>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import cinemaTypes from "../../types/cinema";
import { mapGetters } from "vuex";
import CinemaItem from "./CinemaItem";
import CinemaFilter from "./CinemaFilter";

export default {
  name: "cinema-list",
  components: {
    CinemaItem,
    CinemaFilter
  },
  mounted() {
    this.$store.dispatch(cinemaTypes.actions.fetchCinemas);
  },
  computed: {
    ...mapGetters({
      cinemas: cinemaTypes.getters.cinemas
    })
  }
};
</script>