<template>
  <div class="card" style="padding-bottom:10px;">
    <div class="col-md-12 col-xs-12">
      <h2 class="text-center" v-html="$t('filter.movie')"></h2>
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
      <label class="control-label" v-html="$t('filter.rows')"></label>
      <select v-model="rows" class="form-control">
        <option v-for="(row, index) in [1,2,3,4,5,6,7,8,9,10,11,12]" :value="row" :key="index">{{ row }}</option>
      </select>

      <hr />

      <label class="control-label" v-html="$t('filter.seats')"></label>
      <select v-model="seats" class="form-control">
        <option v-for="(seat, index) in [10,20,30,40,50,60,70,80,90,100]" :value="seat" :key="index">{{ seat }}</option>
      </select>

      <hr />

      <label class="control-label" v-html="$t('filter.genres')"></label>
      <select v-model="genre" class="form-control">
        <option v-for="(genre, index) in genres" :value="genre.id" :key="index">{{ genre.name }}</option>
      </select>

      <hr/>

      <label class="control-label" v-html="$t('filter.hours')"></label>
      <select v-model="hour" class="form-control">
        <option v-for="(h, index) in hours" :value="h.val" :key="index">{{ h.text }}</option>
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
  import movieTypes from '../../types/movie';
  import {mapActions, mapGetters, mapMutations} from 'vuex';
  export default {
    name: 'movie-filter',
    mounted () {
        this.fetchGenres();
    },
    methods: {
      ...mapActions({
        fetchGenres: movieTypes.actions.fetchGenres
      }),
      ...mapMutations({
        setSearch: movieTypes.mutations.setSearch,
        setRow: movieTypes.mutations.setRow,
        setSeat: movieTypes.mutations.setSeat,
        setHour: movieTypes.mutations.setHour,
        setGenre: movieTypes.mutations.setGenre,
        clearFilter: movieTypes.mutations.clearFilters
      })
    },
    computed: {
      hours () {
          let hours = [], i = 0;
          for(i; i < 24; i++) {
              let hour = i < 10 ? `0${i}` : i;
              hours.push({
                val: i, text: `${hour}:00`
              })
          }
          return hours;
      },
      ...mapGetters({
        query: [movieTypes.getters.search],
        numberOfRows: [movieTypes.getters.rows],
        numberOfSeats: [movieTypes.getters.seats],
        selectedHour: [movieTypes.getters.hour],
        genres: [movieTypes.getters.genres],
        selectedGenre: [movieTypes.getters.genre]
      }),
      hour: {
        get () {
          return this.selectedHour;
        },
        set (value) {
          this.setHour(value);
        }
      },
      search: {
        get () {
          return this.query;
        },
        set (value) {
          this.setSearch(value);
        }
      },
      rows: {
        get () {
          return this.numberOfRows;
        },
        set (value) {
          this.setRow(value);
        }
      },
      seats: {
        get () {
          return this.numberOfSeats;
        },
        set (value) {
          this.setSeat(value);
        }
      },
      genre: {
        get () {
          return this.selectedGenre;
        },
        set (value) {
          this.setGenre(value);
        }
      }
    }
  }
</script>

<style scoped>
  .MovieFilter__Wrapper h2 {
    margin-top: 0 !important;
  }
</style>
