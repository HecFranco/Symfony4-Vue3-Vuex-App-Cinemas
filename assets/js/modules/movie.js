import types from '../types/movie';
import globalTypes from '../types/global';
import Vue from 'vue';
import Axios from 'axios';

const state = {
  cinemaInfo: {},
  genres: [],
  query: {
    search: '',
    rows: null,
    seats: null,
    hour: null,
    genre: null
  }
};

const actions = {
  [types.actions.fetchMovies]: ({commit}, nameUrl) => {
    commit(globalTypes.mutations.startProcessing);
    Axios
      .get(`http://127.0.0.1:8000/api/v1/movies/${nameUrl}/byCinema`,
      {headers: { 'Content-Type': 'application/x-www-form-urlencoded' }})
      .then(response => {
        commit(types.mutations.receivedMovies, {apiResponse: response.data});
        // end processing
        commit(globalTypes.mutations.stopProcessing);
      })
  },
  [types.actions.fetchGenres]: ({commit}) => {
    commit(globalTypes.mutations.startProcessing);
    Axios
      .post('http://127.0.0.1:8000/api/v1/genres',
      {headers: { 'Content-Type': 'application/x-www-form-urlencoded' }})
      .then(response => {
        commit(types.mutations.receivedGenres, {apiResponse: response.data});
        // end processing
        commit(globalTypes.mutations.stopProcessing);
      })
  }
};

const getters = {
  [types.getters.movies]: (state) => {
    let movies = state.cinemaInfo;
    /*
    if(state.query.search) {
      movies = movies.filter(movie => movie.name.toLowerCase().includes(state.query.search))
    }
    if(state.query.rows) {
      movies = movies.filter(movie => movie.rows >= state.query.rows)
    }
    if(state.query.seats) {
      movies = movies.filter(movie => movie.seats >= state.query.seats)
    }
    if(state.query.genre) {
      movies = movies.filter(movie => movie.genres.some(genre => genre.pivot.genre_id === state.query.genre))
    }
    if(state.query.hour) {
      movies = movies.filter(movie => movie.movie_showing_times.some(movie_showing_time => {
        const arrayHour = movie_showing_time.hour_to_show.split(':');
        return parseInt(arrayHour[0]) === state.query.hour;
      }))
    }
    */
    return movies;
  },
  /*
  [types.getters.genres]: state => state.genres,
  [types.getters.genre]: state => state.query.genre,
  [types.getters.search]: state => state.query.search,
  [types.getters.rows]: state => state.query.rows,
  [types.getters.seats]: state => state.query.seats,
  [types.getters.hour]: state => state.query.hour,
  */
};

const mutations = {
  [types.mutations.receivedMovies]: (state, {apiResponse}) => {
    state.cinemaInfo = apiResponse.data;
  },
  [types.mutations.receivedGenres]: (state, {apiResponse}) => {
    state.genres = apiResponse.data;
  },
  /*
  [types.mutations.setSearch]: (state, query) => {
    state.query.search = query;
  },
  [types.mutations.setGenre]: (state, genre) => {
    state.query.genre = genre;
  },
  [types.mutations.setSeat]: (state, seats) => {
    state.query.seats = seats;
  },
  [types.mutations.setRow]: (state, rows) => {
    state.query.rows = rows;
  },
  [types.mutations.setHour]: (state, hour) => {
    state.query.hour = hour;
  },
  [types.mutations.clearFilters]: (state) => {
    state.query = {
      search: '',
      rows: null,
      seats: null,
      hour: null,
      genre: null
    };
  }
  */
};

export default {
  state,
  getters,
  actions,
  mutations
};
