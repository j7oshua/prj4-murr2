<template>
  <div>
    <div>
      <h1>CollectionSite</h1>
    </div>
    <div>
      <!-- this need to be change to a list -->
    <ul id="listOfSites">
     <!--<li v-for="item in items" :key="item.message">-->
        <!--{{siteId}} {{siteName}} -->
        site1 Wascana
        <!-- need the on click to redirct -->
        <b-button size="sm" class="mb-2" @click="reDirectToDriverPickup">
            <b-iconstack font-scale="1">
              <b-icon stacked icon="plus-circle-fill" variant="primary">
              </b-icon>
            </b-iconstack>
          </b-button>
      <!--</li>-->

    </ul>
      <DriverPickUpForm @finished="confirmFinish" :site-object="siteObject" :show-form="showForm"></DriverPickUpForm>
    </div>
  </div>
</template>

<script>
import DriverPickUp from '@/components/DriverPickUp'

export default {
  name: 'DriverCollection',
  components: { DriverPickUpForm: DriverPickUp },
  data () {
    return {
      siteObject: {
        id: 1,
        siteName: 'Wascana',
        numBins: 4
      },
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
