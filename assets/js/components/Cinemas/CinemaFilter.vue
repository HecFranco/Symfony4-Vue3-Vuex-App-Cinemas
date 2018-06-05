<template>
  <div class="card" style="padding-bottom:10px;">
    <div class="col-md-12 col-xs-12">
      <h2 class="text-center" v-html="$t('filter.cinema')"></h2>
      <label 
        class="control-label" 
        v-html="$t('filter.search')"
      ></label>
      <input
        v-model="search"
        class="form-control"
        :placeholder="$t('filter.search')"
      />
      <hr />
      <label class="control-label" v-html="$t('filter.rooms')"></label>
      <select v-model="rooms" class="form-control">
        <option v-for="(room, index) in [1,5,10,15,20,25,30]" :value="room" :key="index">{{ room }}</option>
      </select>
      <hr />
      <label class="control-label" v-html="$t('filter.seats')"></label>
      <select v-model="seats" class="form-control">
        <option v-for="(seat, index) in [100,200,300,400,500,600,700,800,900,1000]" :value="seat" :key="index">{{ seat }}</option>
      </select>
      <hr />
      <button
        class="btn btn-block btn-warning"
        @click="clearFilter"
      >
        {{ $t('filter.clear') }}
      </button>

    </div>
  </div>
</template>

<script>
  import {mapGetters, mapMutations} from 'vuex';
  import cinemaTypes from '../../types/cinema';

  export default {
    name: 'cinema-filter',
    data () {
      return {}
    },
    methods: {
      ...mapMutations({
        setSearch: cinemaTypes.mutations.setSearch,
        setRooms: cinemaTypes.mutations.setRooms,
        setSeats: cinemaTypes.mutations.setSeats,
        clearFilter: cinemaTypes.mutations.clearFilter
      })
    },
    computed: {
      ...mapGetters({
        query: cinemaTypes.getters.search,
        numberOfRooms: cinemaTypes.getters.rooms,
        numberOfSeats: cinemaTypes.getters.seats
      }),
      search: {
        get () {
          return this.query;
        },
        set (value) {
          this.setSearch(value);
        }
      },
      rooms: {
        get () {
          return this.numberOfRooms;
        },
        set (value) {
          this.setRooms(value);
        }
      },
      seats: {
        get () {
          return this.numberOfSeats;
        },
        set (value) {
          this.setSeats(value);
        }
      },
    }
  }
</script>

<style scoped>
  .Filter__Wrapper h2 {
    margin-top: 0 !important;
  }
</style>
