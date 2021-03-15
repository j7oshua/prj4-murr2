<template>

</template>

<script>
  import ResidentMixin from '../mixins/resident-mixin'
export default {
  name: 'Login',
  mixins: [ResidentMixin],
  data () {
    return {
      resident: {
        email: '',
        phone: '',
        password: ''
      },
      url: '/points/'
    }
  },
  methods: {
    getLoginInfo: function () {

    },
    isLoggedIn: function () {

    }
  }
}
</script>

<style scoped>

</style>
