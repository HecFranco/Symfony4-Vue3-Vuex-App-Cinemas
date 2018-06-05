import types from '../types/booking';
import globalTypes from '../types/global';
import Vue from 'vue';

const state = {
  movie: {},
  my_bookings: null,
  selected_hour: null,
  movie_showing_times_id: null,
  lastBooking: null
};

const actions = {
  [types.actions.processReservation]: ({commit, state}, seats) => {
    commit(globalTypes.mutations.startProcessing);
    return new Promise((resolve, reject) => {
      Vue.http.post('booking', {
        seats,
        movie_showing_times_id: state.movie_showing_times_id
      })
        .then(booking => {
          resolve(booking.data);
        })
        .catch(error => {
          reject(error);
        })
        .finally(() => {
          commit(globalTypes.mutations.stopProcessing);
        })
    })
  },
  [types.actions.fetchMovie]: ({commit}, movieId) => {
    commit(globalTypes.mutations.startProcessing);
    return new Promise((resolve, reject) => {
      Vue.http.get(`movies/${movieId}/byMovie`).then(movie => {
        commit(types.mutations.receivedMovie, {apiResponse: movie});
        resolve(movie.data);
      })
        .catch(error => {
          reject(error);
        })
        .finally(() => {
          commit(globalTypes.mutations.stopProcessing);
        })
    });
  },
  [types.actions.lastBooking]: ({commit}) => {
    commit(globalTypes.mutations.startProcessing);
    return new Promise((resolve, reject) => {
      Vue.http.get('bookings/last').then(booking => {
        commit(types.mutations.receivedLastBooking, {apiResponse: booking});
        resolve(booking.data);
      })
        .catch(error => {
          reject(error);
        })
        .finally(() => {
          commit(globalTypes.mutations.stopProcessing);
        })
    })
  },
  [types.actions.fetchMyBookings]: ({commit}) => {
    commit(globalTypes.mutations.startProcessing);
    return new Promise((resolve, reject) => {
      Vue.http.get('bookings/all').then(bookings => {
        commit(types.mutations.setMyBookings, {apiResponse: bookings});
        resolve(bookings);
      })
        .catch(error => {
          reject(error);
        })
        .finally(() => {
          commit(globalTypes.mutations.stopProcessing);
        })
    })
  }
};

const getters = {
  [types.getters.movie]: state => state.movie,
  [types.getters.booked]: (state) => {
    if(state.selected_hour) {
      return getBooked(state);
    }
  },
  [types.getters.seatsIds]: (state) => {
    let booked = getBooked(state);
    let seats = [];
    if(booked.length) {
      booked.forEach(b => {
        if(b.seats.length) {
          b.seats.forEach(seat => {
            seats.push(seat.seat_number);
          })
        }
      })
    }
    return seats;
  },
  [types.getters.lastBooking]: (state) => {
    if(state.lastBooking) {
      return state.lastBooking.bookings[0];
    }
  },
  [types.getters.formattedBookings]: (state) => {
    let bookings = [];
    if(state.my_bookings && state.my_bookings.length) {
      state.my_bookings.map(booking => {
        bookings.push({
          id: booking.id,
          movie: booking.movie_showing_time.movie_showing.movie.movie_name,
          seats: booking.__meta__.seats_count,
          date: booking.booking_made_date,
          hour: booking.movie_showing_time.hour_to_show
        })
      });
    }
    return bookings;
  }
};

const mutations = {
  [types.mutations.receivedMovie]: (state, {apiResponse}) => {
    state.movie = apiResponse.data;
  },
  [types.mutations.setSelectedHour]: (state, hour) => {
    state.selected_hour = hour;
    state.movie_showing_times_id = state.movie.movie_showing_times.filter(movie => movie.hour_to_show === hour)[0].movie_showing_id;
  },
  [types.mutations.receivedLastBooking]: (state, {apiResponse}) => {
    state.lastBooking = apiResponse.body.data;
  },
  [types.mutations.setMyBookings]: (state, {apiResponse}) => {
    state.my_bookings = apiResponse.body.data.bookings;
  }
};

function getBooked (state) {
  if(state.movie.movie_showing_times) {
    const booked = state.movie.movie_showing_times.filter(
      movie_showing_time => movie_showing_time.hour_to_show === state.selected_hour
    );
    if(booked && booked[0] && booked[0].hasOwnProperty('bookings')) {
      return booked[0].bookings;
    }
  }
  return [];
}

export default {
  state,
  actions,
  getters,
  mutations
};
