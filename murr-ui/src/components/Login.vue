<template>
  <div>
    <h1>Login</h1>
    <!-- The form input -->
    <form @submit.prevent="handleSubmit()">
      <div class="form-row">
        <!-- email input box -->
        <div class="form-group col-md-6">
          <label for="username">Email or Phone</label>
          <input id="username" type="text" class="form-control" v-model="resident.username"/>
          <div class="form-row">

            <!-- password input box -->
            <div class="form-group col-md-6">
              <label for="password">Password</label>
              <input id="password" type="password" class="form-control" v-model="resident.password"/>
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
      isBusy: false
    }
  },
  methods: {
    // this method will handle the submit of login information and make the axios request to the api
    handleSubmit () {
      this.isBusy = true
      this.error = ''
      axios.post('https://127.0.0.1:8000/login', {
        username: this.resident.username,
        password: this.resident.password
      })
        .then(response => {
          console.log(document.cookie)
          this.$emit('user-authenticated', response.headers.location)
          this.username = ''
          this.password = ''
        }).catch(error => {
          if (error.response) {
            // this.error = error.response
          } else {
            // this.error = 'Unknown error'
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
