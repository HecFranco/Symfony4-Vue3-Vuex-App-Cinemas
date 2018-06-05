<template>
  <div class="MovieGenres__Wrapper">
    <label>{{ $t('genre.name') }}</label>
    <div v-if="genres">
      <span class="badge badge-info" v-for="(genre, index) in genres" :key="index">
        {{ genre.name }}
      </span>
    </div>
    <div v-else>
      <span class="badge badge-error">{{ $t('genre.empty') }}</span>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'movie-genres',
    props: {
      genres: {
        type: Array
      }
    }
  }
</script>

<style scoped>
  .badge-info {
    background-color: #3a87ad;
  }
  .badge-info:hover {
    background-color: #2d6987;
  }

  .badge-error {
    background-color: #b94a48;
  }
  .badge-error:hover {
    background-color: #953b39;
  }
  label {
    color: #fff;
  }
</style>
