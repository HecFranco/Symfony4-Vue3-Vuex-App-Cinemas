<template>
  <div class="card" style="background:#181d23;">
    <div class="col-md-12 col-xs-12">
      <router-link 
        :to="{name: 'cinema', params: {name_url: cinema.nameUrl}}"
      >
        <img 
          :src="'./assets/screenshot_cinemas/'+cinema.screenshot" 
          class="card-img-top" 
          alt="Card image cap"
        />
      </router-link>
    </div>
    <div class="card-body">
      <h2 class="card-title">
        <router-link :to="{name: 'cinema', params: {name_url: cinema.nameUrl}}" class="card-link" style="line-height: 1; max-height: 2;">
          <!-- {{ $t('cinema.name') }}: -->
          {{ cinema.name }}
        </router-link>
      </h2>
      <p class="card-text">{{ $t('cinema.address') }}: </p>
      <p class="card-text" style="line-height: 1; max-height: 2; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">{{ cinema.address }}</p>
      <p class="card-text">{{ $t('cinema.details') }}: {{ cinema.details }}</p>
      <p class="card-text">{{ $t('cinema.telephone') }}: {{ cinema.phone }}</p>
      <p class="card-text">{{ $t('cinema.seats') }}: {{ cinema.seatCapacity }}</p>
      <p class="card-text">{{ $t('cinema.rooms') }}: {{ cinema.countRooms }}</p>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'cinema-item',
    props: {
      cinema: {
        type: Object,
        required: true
      }
    }
  }
</script>

<style scoped>
  .CinemaItem__Wrapper {
    background: #181D23 !important;
    padding: 10px;
  }
  .CinemaItem__Wrapper h2 {
    margin-top: 0;
  }
</style>