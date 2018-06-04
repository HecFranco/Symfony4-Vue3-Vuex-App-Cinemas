import types from '../types/cinema';
import globalTypes from '../types/global';
import Vue from 'vue';
import Axios from 'axios';

const state = {
  cinemas: [],
  query: {
    search: '',
    rooms: null,
    seats: null
  }
};
const actions = {
  [types.actions.fetchCinemas]: ({commit}) => {
    // start processing
    commit(globalTypes.mutations.startProcessing);
    Axios
      .post('http://127.0.0.1:8000/api/v1/cinemas',
        {headers: { 'Content-Type': 'application/x-www-form-urlencoded' }})
      .then(response => {
        commit(types.mutations.receivedCinemas, {apiResponse: response.data});
        // end processing
        commit(globalTypes.mutations.stopProcessing);
      })
  }
};
const getters = {
  [types.getters.search]: state => state.query.search,
  [types.getters.rooms]: state => state.query.rooms,
  [types.getters.seats]: state => state.query.seats,
  [types.getters.cinemas]: (state) => {
    let cinemas = state.cinemas;
    if(state.query.search) {
      cinemas = cinemas.filter(cinema => cinema.name.toLowerCase().includes(state.query.search))
    }
    if(state.query.rooms) {
      cinemas = cinemas.filter(cinema => cinema.countRooms >= state.query.rooms);
    }
    if(state.query.seats) {
      cinemas = cinemas.filter(cinema => cinema.seatCapacity >= state.query.seats);
    }
    return cinemas;
  }
};
const mutations = {
  [types.mutations.receivedCinemas]: (state, {apiResponse}) => {
    state.cinemas = apiResponse.data;
  },
  [types.mutations.setSearch]: (state, query) => {
    state.query.search = query;
  },
  [types.mutations.setRooms]: (state, rooms) => {
    state.query.rooms = rooms;
  },
  [types.mutations.setSeats]: (state, seats) => {
    state.query.seats = seats;
  },
  [types.mutations.clearFilter]: (state) => {
    state.query = {
      search: '',
      rooms: null,
      seats: null
    }
  }
};

export default {
  state,
  actions,
  getters,
  mutations
};