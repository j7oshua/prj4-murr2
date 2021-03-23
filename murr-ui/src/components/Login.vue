<template>
  <div>
    <h1>Login</h1>
    <!-- The form input -->
    <form @submit.prevent="getLoginInfo()">
      <div class="form-row">
        <!-- email input box -->
        <div class="form-group col-md-6">
          <label for="username">Email or Phone</label>
          <input id="username" type="text" class="form-control" v-model.trim="resident.username.$model"/>
      <div class="form-row">

        <!-- password input box -->
        <div class="form-group col-md-6">
          <label for="password">Password</label>
          <input id="password" type="password" class="form-control" v-model.trim="resident.password.$model"/>
          </div>
        </div>
      </div>
      </div>
      <button type="submit" class="btn btn-success">Submit</button>
    </form>
  </div>
</template>

<script>
import ResidentMixin from '../mixins/resident-mixin'
export default {
  name: 'Login',
  mixins: [ResidentMixin],
  data () {
    return {
      resident: {
        username: '',
        password: '',
        apiToken: ''
      },
      url: '/points/',
      isBusy: false
    }
  },
  methods: {
    getLoginInfo: function () {
      this.isBusy = true
      if (this.userName !== '' && this.password !== '') {
        this.axios.get(this.RESIDENT_POINTS_URL, {
          params: {
            userName: this.userName,
            password: this.password
          }
        })
          .then(function (response) {
            // localStorage.setItem('id', JSON.stringify(response.data[0]))
            // localStorage.setItem('username', this.resident.userName)
            alert('Successfully Logged in')
          })
          .catch(function () {
            alert('User name and/or Password incorrect')
          })
          .finally(() => {
            this.isBusy(false)
          })
      } else {
        alert('Please enter username & password')
        this.isBusy(false)
      }
    },
    isLoggedIn: function () {

    }
  },
  mounted () {
    this.getLoginInfo()
  }
}
</script>

<style scoped>

</style>
