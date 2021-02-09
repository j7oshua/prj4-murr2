<template>
  <div id="app">
<<<<<<< HEAD
  <!--  <b-nav pills align="center" class="mb-4">
      <b-nav-item to="/" exact-active-class="active">Home</b-nav-item>
      <b-nav-item to="/login" exact-active-class="active">Login</b-nav-item>
    </b-nav>-->
    <router-view class="container-xl"/>
=======
    <div id="nav">
      <router-link to="/">Points</router-link> |
      <router-link to="/">Education Information</router-link>
    </div>
    <router-view/>
>>>>>>> master
  </div>
</template>

<style>
  #app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
  }

  #nav {
    padding: 30px;
  }

  #nav a {
    font-weight: bold;
    color: #2c3e50;
  }

  #nav a.router-link-exact-active {
    color: #42b983;
  }
</style>
