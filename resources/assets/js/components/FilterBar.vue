<template>
    <div class="filter-bar ui basic segment grid">
      <div class="ui form">
        <div class="inline field">
          <label>Search for:</label>
          <input type="text" v-model="filterText" class="three wide column" @keyup.enter="doFilter" placeholder="name, nickname, or email">
          <button class="btn btn-primary" @click="doFilter">Go</button>
          <button class="btn " @click="resetFilter">Reset</button>
        </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    data () {
      return {
        filterText: ''
      }
    },
    methods: {
      doFilter () {
        this.$events.fire('filter-set', this.filterText)

      },
      resetFilter () {
        this.filterText = '' 
      this.$events.fire('filter-reset')
        
      }
    }
  }
</script>