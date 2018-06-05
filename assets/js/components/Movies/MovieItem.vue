<template>
  <div class="card" style="background:#181d23;">
    <div class="col-md-12 col-xs-12">
      <!--<router-link 
      > -->
        <img 
          :src="'../assets/screenshot_movies/'+movie.screenshot" 
          class="card-img-top" 
          alt="Card image cap"
        />
      <!--</router-link>-->
      <!--
      <button
        v-if="canBooking && booking"
        @click="$emit('startReservation', movie.id)"
        class="btn btn-warning btn-block"
      >
        {{ $t('movie.reservation') }}
      </button>-->
    </div>

    <div class="card-body">
      <h2 class="card-title">
        <!--<router-link>-->
          {{ $t('movie.name') }}: {{ movie.name }}
        <!--</router-link>-->
      </h2>
      <p class="card-text">{{ $t('movie.director') }}: {{ movie.director }}</p>
      <p class="card-text">{{ $t('movie.synopsis') }}: {{ movie.synopsis }}</p>
      <p class="card-text">{{ $t('movie.room_number') }}: {{ movie.number }}</p>
      <p class="card-text">{{ $t('movie.room_rows') }}: {{ movie.rows }}</p>
      <p class="card-text">{{ $t('movie.room_seats') }}: {{ movie.seats }}</p>
      <div class="col-md-12">
        <movie-genres :genres="movie.genres"></movie-genres>
      </div>

      <div class="col-md-12">
        <!--
        <movie-showing-times
          v-on:selectHour="$emit('selectHour', $event)"
          :showing_times="movie.movie_showing_times"
        ></movie-showing-times>
        -->
      </div>
    </div>
  </div>
</template>

<script>
  import MovieGenres from "./MovieGenres";
  // import MovieShowingTimes from "./MovieShowingTimes";
  export default {
    components: {
      // MovieShowingTimes,
      MovieGenres
    },
    name: 'movie',
    props: {
      movie: {
        type: Object,
        required: true
      },
      booking: {
        type: Boolean,
        required: true
      }
    },
    computed: {
      /*
      canBooking () {
        return this.movie.movie_showing_times.length > 0;
      }
      */
    }
  }
</script>

<style scoped>
  .MovieItem__Wrapper {
    background: #181D23 !important;
    padding: 10px;
  }
  .MovieItem__Wrapper h2 {
    margin-top: 0;
  }
</style>
