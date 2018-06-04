import namespace from '../utils/namespace'

export default namespace('auth', {
  getters: [
    'user',
    'logged'
  ],
  actions: [
    'login',
    'register',
    'logout',
    'updateProfile'
  ],
  mutations: [
    'setUser',
    'setLogged'
  ]
});
