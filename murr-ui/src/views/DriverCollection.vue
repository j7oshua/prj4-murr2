<template>
  <div>
    <div>
      <h1>Collection Site Form</h1>
    </div>
    <div v-if="!showForm">
      <!-- this is a hard-coded site, for route story this is where the list of sites would be displayed -->
    </div>
    <div>
      <!-- this is th filter input box -->
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
            <!-- clear button at the end of the search input -->
            <b-input-group-append>
              <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
            </b-input-group-append>
          </b-input-group>
        </b-form-group>
      </b-col>
      <b-table
        id="my-table"
        :busy.sync="isBusy"
        :items="getSites"
        :fields="fields"
        :filter="filter"
        :filter-included-fields="filterOn"
        :current-page="currentPage"

      >
        <b-thead head-variant="dark">
          <b-tr>
            <b-th colspan="4">Site Name</b-th>
            <b-th colspan="1">SiteID</b-th>
            <b-th colspan="2">Bins</b-th>
            <b-th colspan="2">Pickup</b-th>
          </b-tr>
        </b-thead>

        <template #cell(siteObject)="row">
          {{ row.value.siteName }} {{ row.value.siteId }} {{row.value.numBins}}
        </template>
        <template #cell(actions)="row"> <!-- seems this need to have a used row for select and it seems this is suck on action for some reason -->
          <p>PickUp</p>
          <b-button size="sm" class="mb-2 p-2" @click="row.reDirectToDriverPickup">
            <b-icon icon="plus-circle-fill" variant="primary"></b-icon>
          </b-button>
        </template>
        <template #row-details="row"> <!-- seems like it is missing something in order to appear on the table. -->
          <b-card>
            <ul>
              <li v-for="(key, value) in row.item" :key="key">{{key}}: {{value}}</li>
            </ul>
          </b-card>
        </template>
        <template v-slot:emptyfiltered>
          <p class="border border-danger ">No site found with that criteria</p>
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
      item: [{
        siteObject: {
          siteName: 'Wascana',
          id: 1,
          numBins: 5
        }
      }],
      fields: [{ key: 'siteName', label: 'Site Name' }, { key: 'id', label: 'Site ID' }, { key: 'numBins', label: 'Bins' }, { key: 'Pick Up', Label: 'Pick Up' }],
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
      const promise = this.axios.get(this.SITE_API_URL + ctx.siteName)

      // Must return a promise that resolves to an array of items
      return promise.then(resp => {
        // Pluck the array of items off our axios response
        const items = resp.data.items
        // Must return an array of items or an empty array if an error occurred
        return items || []
      })
    }
  }
}
</script>

<style scoped>

</style>
