<template>
  <div>
    <div>
      <h1>CollectionSite</h1>
    </div>
    <div>
      <!-- this need to be change to a list -->
    <ul id="listOfSites">
      <li v-for="item in items" :key="item.message">
        {{siteId}} {{siteName}}

        <!-- need the on click to redirct -->
        <button v-on:click="reDirectToDriverPickup">
          <DriverPickUpModal @site-id="1" @site-name="Wascana" @num-bins="4" ></DriverPickUpModal>
        </button>
      </li>

    </ul>
    </div>

    <!-- do a modal -->

  </div>
</template>

<script>
import DriverPickUp from '@/components/DriverPickUp'

export default {
  name: 'DriverCollection',
  components: { DriverPickUpModal: DriverPickUp },
  props: {
    siteObject: {
      type: Object
    }
  },
  data () {
    return {
      siteId: '',
      siteName: ''
    }
  }
}
</script>

<style scoped>

</style>
