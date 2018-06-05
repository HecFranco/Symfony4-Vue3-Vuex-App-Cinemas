<template>
  <div class="BookingSeats__Wrapper">
    <table class="table">
      <tr v-for="(row, index) in room.room_rows" :key="index">
        <td
          align="center"
          v-for="(seat, index) in seatsPerRow"
          v-bind:class="{
            booked: seatsIds.includes(currentSeat(row, seat)),
            selected: pending_booked.indexOf(`${row}-${currentSeat(row, seat)}`) > -1
          }"
          @click="selectSeat(row, currentSeat(row, seat), seat)"
          :key="index"
        >
          {{ currentSeat(row, seat) }}
        </td>
      </tr>
    </table>

    <div v-if="pending_booked.length">

      <hr />

      <button class="btn btn-warning btn-block" @click="processBooked">
        {{ $t('booking.process_book') }}
      </button>

      <hr />

    </div>
  </div>
</template>

<script>
  import {mapActions} from 'vuex';
  import types from '../../types/booking';
  export default {
    name: 'booking-seats',
    props: {
      room: {
        type: Object,
        required: true
      },
      seatsIds: {
        type: Array
      }
    },
    data () {
      return {
          pending_booked: []
      }
    },
    methods: {
      ...mapActions({
        processReservation: types.actions.processReservation,
      }),
      processBooked () {
        this.processReservation(this.pending_booked).then(() => {
          this.$router.push({ name: 'booking-last'});
        })
      },
      currentSeat (row, seat) {
        return row === 1 ? seat : parseInt(((row -1) * 10)) + parseInt(seat);
      },
      selectSeat (row, currentSeat, seat) {
        if(this.seatsIds.includes(this.currentSeat(row, seat))) return;

        const booked = `${row}-${currentSeat}`;
        if(this.pending_booked.indexOf(booked) > -1) {
          this.pending_booked.splice(this.pending_booked.indexOf(booked), 1);
        } else {
          this.pending_booked.push(booked);
        }
      }
    },
    computed: {
        seatsPerRow () {
          return this.room.room_seats / this.room.room_rows;
        }
    }
  }
</script>

<style scoped>
  .BookingSeats__Wrapper td {
    background: green;
    width: 50px;
    height: 50px;
    border: 1px solid #fff;
  }

  .booked {
    background: darkred !important;
    width: 50px;
    height: 50px;
    border: 1px solid #fff;
  }

  .selected {
    background: orange !important;
    width: 50px;
    height: 50px;
    border: 1px solid #fff;
    color: #fff;
  }
  td {
    color: #fff !important;
  }
</style>
