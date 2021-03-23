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
        password: '',
        apiToken: ''
      },
      url: '/points/',
      isBusy: false
    }
  },
  methods: {
    getLoginInfo: function () {
      this.isBusy = true;
      this.axios
        .get('/resident', {
          email: this.email,
          password: this.password
        })
        .then(response => {
          console.log(response.data);
          this.$emit('user-authenticated', this.apiToken);
          this.email = '';
          this.password = '';
        }).catch(error => {
        console.log(error.response.data);
      }).finally(() => {
        this.isBusy = false;
      })
    },
    isLoggedIn: function () {

    }
  },
  mounted () {
    this.getLoginInfo();
  }
}
</script>

<style scoped>

</style>
