<template>
  <div class="col-md-12">
    <h1 class="text-center" v-html="$t('booking.list')"></h1>
    <div v-if="formattedBookings">
      <v-client-table name="bookingsTable" :columns="columns" :data="formattedBookings" :options="options">
      </v-client-table>
    </div>
  </div>
</template>

<script>
  import {mapGetters} from 'vuex';
  import bookingTypes from '../../types/booking';
  export default {
    name: 'bookings',
    data () {
      return {
        columns: ['id', 'movie', 'seats', 'date', 'hour'],
        options: {
          filterByColumn: true,
          perPage: 2,
          perPageValues: [5, 10, 15, 20],
          headings: {
            id: 'ID',
            movie: this.$t('movie.name'),
            seats: this.$t('booking.seats'),
            date: this.$t('booking.date'),
            hour: this.$t('booking.hour')
          }
        }
      }
    },
    mounted () {
      this.$store.dispatch(bookingTypes.actions.fetchMyBookings).then(() => {})
    },
    computed: {
      ...mapGetters({
        formattedBookings: bookingTypes.getters.formattedBookings
      })
    }
  }
</script>

<style>
  th, td {
    color: #fff;
  }
</style>
