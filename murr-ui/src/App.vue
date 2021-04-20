<template>
  <div id="app">
    <b-navbar type="dark" variant="dark">
      <b-navbar-nav>
        <b-nav-item to="/edu">Education Information</b-nav-item>
        <b-nav-item to="/points">Points</b-nav-item>
      <b-nav-item-dropdown class="ml-5">
        <template #button-content>
          <b-icon-person-fill></b-icon-person-fill>
        </template>
        <b-dropdown-item href="#">Profile</b-dropdown-item>
        <b-dropdown-item to="/login" @click="logout()">Sign Out</b-dropdown-item>
      </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-navbar>
    <router-view class="container-xl"/>
  </div>
</template>

<script>

export default {
  data () {
    return {}
  },
  methods: {
    logout () {
      sessionStorage.removeItem('id')
      sessionStorage.removeItem('token')
    }
  }
}
</script>
