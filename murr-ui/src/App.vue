<template>
  <div id="app">
    <b-navbar>
      <b-navbar-nav>
        <b-nav-item to="/edu">Education Information</b-nav-item>
        <b-nav-item to="/points/:id">Points</b-nav-item>
      </b-navbar-nav>
    </b-navbar>
    <router-view class="container-xl"/>
  </div>
</template>
