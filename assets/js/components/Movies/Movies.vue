<template>
  <div class="row" id="movies">
    <div class="col-md-3 col-xs-12" id="filters">
      <movie-filter></movie-filter>
    </div>
    <!--
      <div v-if="movies && movies.length > 0">
    -->
    <div class="col-md-9 col-xs-12 ml-auto" id="list-items">
      <div class="row" v-if="movies">
        <div 
          v-for="(movie, index) in movies" 
          :key="index"
          class="movie col-lg-4 col-md-6 col-xs-12" 
          style="padding:0px 10px;"
        >
          <movie
            :movie="movie"
            :booking="true"
            v-on:startReservation="reservation($event)"
            :key="index"
          ></movie>
        </div>
      </div>
      <div v-else class="alert alert-danger">
        {{ $t('movie.empty') }}
      </div>
    </div>
  </div>
</template>

<script>
  import {mapActions, mapGetters} from 'vuex';
  import moviesTypes from '../../types/movie';
  import Movie from "./MovieItem";
  import MovieFilter from "./MovieFilter";
  export default {
    components: {
      MovieFilter,
      Movie},
    name: 'movie-list',
    mounted () {
        const nameUrl = this.$route.params.name_url;
        this.fetchMovies(nameUrl);
    },
    methods: {
      ...mapActions({
        fetchMovies: moviesTypes.actions.fetchMovies
      }),
      reservation (movieId) {
        this.$router.push({name: 'booking', params: {movieId: movieId}});
      }
    },
    computed: {
      ...mapGetters({
        movies: moviesTypes.getters.movies
      })
    }
  }
</script>

<style scoped>
.movie{
 margin-bottom: 10px;
}
</style>
