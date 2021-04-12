<template>
  <div>
    <div>
      <h1>Collection Site Form</h1>
    </div>
    <div v-if="!showForm">
      <!-- this is a hard-coded site, for route story this is where the list of sites would be displayed -->
       <h2> <!-- here is where code would go fot the site list -->
        <!-- the button will redirect to the DriverPickUp.vue component -->
        <b-button size="sm" class="mb-2 p-2" @click="reDirectToDriverPickup">
              <b-icon icon="plus-circle-fill" variant="primary"></b-icon>
        </b-button></h2>
    </div>
    <div>
        <b-col lg="6" class="my-1">
          <b-form-group
            label="Filter"
            label-for="filter-input"
            label-cols-sm="3"
            label-align-sm="right"
            label-size="sm"
            class="mb-0"
          >
            <b-input-group size="sm">
              <b-form-input
                id="filter-input"
                v-model="filter"
                type="search"
                placeholder="Type to Search"
              ></b-form-input>

              <b-input-group-append>
                <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
              </b-input-group-append>
            </b-input-group>
          </b-form-group>
        </b-col>
      <b-table
        id="my-table"
        :busy.sync="isBusy"
        :items="myProvider"
        :fields="fields"
        :filter="filter"
        :filter-included-fields="filterOn"
        :current-page="currentPage"

      >
        <b-thead head-variant="dark">
          <b-tr>
            <b-th colspan="1">SiteID</b-th>
            <b-th colspan="4">Site Name</b-th>
            <b-th colspan="2">Pickup</b-th>
          </b-tr>
        </b-thead>
<!--        <b-tbody>-->
<!--          <b-tr>-->
<!--            <b-th rowspan="1">Site 1</b-th>-->
<!--            <b-th rowspan="4">Site Name</b-th>-->
<!--            <b-th rowspan="1">Pick Up</b-th>-->
<!--            <b-th rowspan="1">Button</b-th>-->
<!--          </b-tr>-->
<!--        </b-tbody>-->
        <template #cell(name)="row">
          {{ row.value.first }} {{ row.value.last }}
        </template>
        <template #cell(actions)="row">
          PickUp
          <b-button size="sm" @click="info(row.item, row.index, $event.target)" class="mr-1">
            +
          </b-button>
        </template>
      </b-table>
    </div>
    <div>
      <DriverPickUp @finished="confirmFinish" :site-object="siteObject" :show-form="showForm"></DriverPickUp>
    </div>
  </div>
</template>

<script>

import DriverPickUp from '@/components/DriverPickUp'
export default {
  name: 'DriverCollection',
  components: { DriverPickUp },
  data () {
    return {
      siteObject: {
        id: 1,
        siteName: 'Wascana',
        numBins: 5
      },
      showForm: false,
      isBusy: false
    }
  },
  methods: {
    reDirectToDriverPickup: function () {
      this.showForm = true
    },
    confirmFinish: function (event) {
      this.showForm = false
    },
    getSites: function (ctx) {
      const promise = this.axios.get(this.SITE_API_URL + ctx)

      // Must return a promise that resolves to an array of items
      return promise.then(data => {
        // Pluck the array of items off our axios response
        const items = data.items
        // Must return an array of items or an empty array if an error occurred
        return items || []
      })
    }
  }
}
</script>

<style scoped>

</style>
