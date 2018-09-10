<template>
  <datepicker placeholder="European Format ('d-m-Y')" :config="{ dateFormat: 'd-m-Y', static: true }"></datepicker>
</template>

<script>
import Datepicker from 'vue-bulma-datepicker';

export default {
  components: {
    Datepicker
  }
}
</script>