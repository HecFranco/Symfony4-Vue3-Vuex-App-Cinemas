<template>
  <div class="Booking__Wrapper" v-if="movie && movie.movie">
    <movie :booking="false" v-on:selectHour="showSeats($event)" :movie="movie"></movie>

    <div class="clearfix"></div>

    <hr />
    <div v-if="booked" class="col-md-offset-2 col-md-8">

      <h1 class="text-center">{{ $t('booking.screen_info') }}</h1>
      <booking-seats :seatsIds="seatsIds" :room="movie.room"></booking-seats>
    </div>
    <pre>{{$data}}</pre>
  </div>
</template>

<script>
  import bookingTypes from '../../types/booking';
  import {mapActions, mapGetters, mapMutations} from 'vuex';
  import Movie from "../Movies/MovieItem";
  import BookingSeats from '../Booking/BookingSeats';
  export default {
    name: 'booking',
    components: {
      Movie, BookingSeats
    },
    mounted () {
      const movieId = this.$route.params.movieId;
      this.fetchMovie(movieId).catch(() => {
          this.$router.back();
      })
    },
    methods: {
      ...mapActions({
        fetchMovie: bookingTypes.actions.fetchMovie
      }),
      ...mapMutations({
        setSelectedHour: bookingTypes.mutations.setSelectedHour
      }),
      showSeats (hour) {
          this.setSelectedHour(hour);
      }
    },
    computed: {
      ...mapGetters({
        movie: bookingTypes.getters.movie,
        booked: bookingTypes.getters.booked,
        seatsIds: bookingTypes.getters.seatsIds,
      })
    }
  }
</script>

<style scoped>
  .Booking__Wrapper {

  }
</style>
