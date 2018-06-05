<template>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2 class="text-center">
        {{ $t('cinema.name') }}: {{ cinema.cinema_name }}
      </h2>
    </div>
    <div class="panel-body">
      {{ $t('cinema.address') }}: {{ cinema.cinema_address }}
      <br />
      {{ $t('cinema.telephone') }}: {{ cinema.cinema_phone }}
      <br />
      {{ $t('cinema.capacity') }}: {{ cinema.cinema_seat_capacity }}
    </div>
  </div>
</template>

<script>
  export default {
    name: 'booking-cinema',
    props: {
      cinema: {
        type: Object,
        required: true
      }
    }
  }
</script>
