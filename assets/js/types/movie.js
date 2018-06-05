import namespace from '../utils/namespace'

export default namespace('movie', {
  getters: [
    'movies',
    'search',
    'rows',
    'seats',
    'genres',
    'genre',
    'hour'
  ],
  actions: [
    'fetchMovies',
    'fetchGenres'
  ],
  mutations: [
    'receivedMovies',
    'receivedGenres',
    'setSearch',
    'setRow',
    'setSeat',
    'setHour',
    'setGenre',
    'clearFilters'
  ]
})
