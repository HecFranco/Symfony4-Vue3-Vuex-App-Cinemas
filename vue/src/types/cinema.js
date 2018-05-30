import namespace from '../utils/namespace';

export default namespace('cinema', {
  getters: [
    'cinemas',
    'search',
    'rooms',
    'seats'
  ],
  actions: [
    'fetchCinemas'
  ],
  mutations: [
    'receivedCinemas',
    'setSearch',
    'setRooms',
    'setSeats',
    'clearFilter'
  ]
})
