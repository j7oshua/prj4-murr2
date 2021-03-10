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
        <b-button size="sm" class="mb-2" @click="reDirectToDriverPickup">
            <b-iconstack font-scale="1">
              <b-icon stacked icon="circle" variant="primary"></b-icon>
              <b-icon stacked icon="plus-circle-fill" variant="primary">
              </b-icon>
            </b-iconstack>
            <DriverPickUpForm @finished="confirmFinish" @site-id="1" @site-name="Wascana" @num-bins="4"  v-model="showForm"></DriverPickUpForm>
          </b-button>
      </li>

    </ul>
    </div>
  </div>
</template>

<script>
import DriverPickUp from '@/components/DriverPickUp'

export default {
  name: 'DriverCollection',
  components: { DriverPickUpForm: DriverPickUp },
  props: {
    siteObject: {
      type: Object
    }
  },
  data () {
    return {
      siteId: '',
      siteName: '',
      showForm: false
    }
  },
  methods: {
    reDirectToDriverPickup: function () {
      this.showForm = true
    },
    confirmFinish: function () {
      this.showForm = false
    }
  }
}
</script>

<style scoped>

</style>
