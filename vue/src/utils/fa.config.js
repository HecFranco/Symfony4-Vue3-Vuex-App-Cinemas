// Font-awesome Vue configuration
import Vue from 'vue';
import fontawesome from '@fortawesome/fontawesome';
import FontAwesomeIcon from '@fortawesome/vue-fontawesome';
import {
  faSpinner,
  faAngleLeft,
  faAngleRight,
} from '@fortawesome/fontawesome-free-solid';

fontawesome.library.add(
  faSpinner,
  faAngleLeft,
  faAngleRight,
);

Vue.component('font-awesome-icon', FontAwesomeIcon); // registered globally