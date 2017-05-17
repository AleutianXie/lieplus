<template>
<div class="container">
<div class="row">
  <h1>Hello Vue {{ msg }}</h1>
    <ul>
      <li v-for="item in items">
        {{ item.sn }}
      </li>
    </ul>
        </div>
</div>
</template>

<style scoped>
@import "~bootstrap-editable/css/bootstrap-editable.css";


</style>
<script>

require('datatables')
require('datatables-bootstrap')

require('bootstrap-editable')

export default {
  data() {
    return {
    }
  },
  props: ['msg', 'resumes'],
  computed: {
    items() {
        return JSON.parse(this.resumes)
    }
  }
}
</script>
