<template>
  <div class="BookingLast__Wrapper">
    <div v-if="booking" class="well">

      <booking-cinema :cinema="booking.movie_showing_time.movie_showing.cinema"></booking-cinema>
      <booking-last-info :booking="booking"></booking-last-info>

    </div>
  </div>
</template>

<script>
  import bookingTypes from '../../types/booking';
  import {mapActions, mapGetters, mapMutations} from 'vuex';
  import BookingCinema from "./BookingCinema";
  import BookingLastInfo from "./BookingLastInfo";
  export default {
    components: {
      BookingLastInfo,
      BookingCinema},
    name: 'booking-last',
    mounted () {
      this.lastBooking();
    },
    methods: {
      ...mapActions({
        lastBooking: bookingTypes.actions.lastBooking
      })
    },
    computed: {
      ...mapGetters({
        booking: bookingTypes.getters.lastBooking
      })
    }
  }
</script>
