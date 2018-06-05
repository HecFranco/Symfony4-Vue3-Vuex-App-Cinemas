<template>
  <div class="BookingLastInfo__Wrapper">
    <h2 class="text-center">
      {{ $t('movie.name') }}:
      {{ booking.movie_showing_time.movie_showing.movie.movie_name }}
    </h2>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h2>{{ $t('booking.date') }}: {{ booking.booking_made_date }}</h2>
      </div>
      <div class="panel-body">
        {{ $t('booking.seats') }}: {{ booking.booking_seat_count }}
        <ul>
          <li v-for="(seat, index) in booking.seats" :key="index">
            {{ $t('booking.row') }}: {{ seat.seat_row }},
            {{ $t('booking.seat') }}: {{ seat.seat_number }}
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'booking-last-info',
    props: {
      booking: {
        type: Object,
        required: true
      }
    }
  }
</script>
