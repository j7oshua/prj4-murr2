<template>
  <div>
    <h1>Login</h1>
    <!-- The form input -->
    <form @submit.prevent="login()">
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
import axios from 'axios'
export default {
  name: 'Login',
  mixins: [ResidentMixin],
  data () {
    return {
      resident: {
        username: '',
        password: ''
      },
      url: '/login',
      isBusy: false
    }
  },
  methods: {
    handleSubmit () {
      this.isBusy = true
      this.error = ''
      axios.post('/login', {
        username: this.username,
        password: this.password
      })
        .then(response => {
          this.username = ''
          this.password = ''
        }).catch(error => {
          if (error.response.data.error) {
            this.error = error.response.data.error
          } else {
            this.error = 'Unknown error'
          }
        }).finally(() => {
          this.isBusy = false
        })
    },
    mounted () {
      this.handleSubmit()
    }
  }
}
</script>

<style scoped>

</style>
