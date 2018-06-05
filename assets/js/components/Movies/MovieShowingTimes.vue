<template>
  <div class="MovieShowingTimes__Wrapper">
    <label>{{ $t('movie_showing_times.name') }}</label>
    <div v-if="showing_times.length > 0">
      <span
        @click="$emit('selectHour', showing_time.hour_to_show)"
        class="badge badge-danger"
        v-for="(showing_time, index) in showing_times" :key="index"
      >
        {{ showing_time.hour_to_show }}
      </span>
    </div>
    <div v-else>
        <span class="badge badge-error">
          {{ $t('movie_showing_times.empty') }}
        </span>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'movie-showing-times',
    props: {
      showing_times: {
          type: Array
      }
    }
  }
</script>

<style scoped>
  .badge-danger {
    background-color: #b94a48;
  }
  .badge-danger:hover {
    background-color: #953b39;
  }
  label {
    color: #fff;
  }
</style>
