<template>
  <div>
<!--    shows a loading icon for when the page is loading in-->
    <b-overlay
      :show="busy"
      rounded
      opacity="0.6"
      spinner-small
      spinner-variant="secondary"
    >
      <div>
        <h1>Collection Site Form</h1>
        <!-- this is th filter input box -->
        <div v-if="!showForm">
          <b-col lg="6" class="my-1">
            <b-form-group
              label="Filter"
              label-for="filter-input"
              label-cols-sm="3"
              label-align-sm="right"
              label-size="sm"
              class="mb-0"
            >
<!--              the filter input box-->
              <b-input-group size="sm">
                <b-form-input
                  id="filter-input"
                  v-model="filter"
                  type="search"
                  placeholder="Type to Search"
                  debounce="500"
                ></b-form-input>
                <!-- clear button at the end of the search input -->
                <b-input-group-append>
                  <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
                </b-input-group-append>
              </b-input-group>
            </b-form-group>
          </b-col>
<!--          tables that shows the list of sites-->
          <b-table
            head-variant="dark"
            :items="getSites"
            :fields="fields"
            id="my-table"
            :busy.sync="isBusy"
            :filter="filter"
            :filter-included-fields="filterOn"
            :per-page="PerPage"
            :current-page="currentPage"
            show-empty
          >
            <!-- this is the pickup button, switches to the DriverPickUp component -->
            <template #cell(PickUp)="row" >
              <b-button variant="outline-primary" size="sm" class="mb-2 p-2" @click="reDirectToDriverPickup(row.item)" :disabled="busy">
                <b-icon icon="plus-circle-fill" variant="primary"></b-icon>
              </b-button>
            </template>
<!--            slot for if no site exists within the database, variant are set to red to match the theme -->
            <template #emptyfiltered>
              <p id="test2" class="border border-danger text-danger">No site found with those criteria</p>
            </template>
            <template #empty>
              <p id="test" class="border border-danger text-danger">No sites to display</p>
            </template>
          </b-table>
          <b-col>
            <!-- Page selection bar -->
            <b-pagination
              v-model="currentPage"
              :per-page="PerPage"
              align="center"
              small
              :total-rows="totalItems"
            ></b-pagination>
          </b-col>
        </div>
        <div>
<!--          shows the DriverPickup Component-->
          <DriverPickUp @finished="confirmFinish" :site-object="siteObject" :show-form="showForm"></DriverPickUp>
        </div>
      </div>
    </b-overlay>
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
        type: Object
      },
      item: [{}],
      fields: [{ key: 'siteName', label: 'Site Name' }, { key: 'id', label: 'Site ID' }, { key: 'numBins', label: 'Bins' }, { key: 'PickUp', Label: 'PickUp' }],
      filter: '',
      filterOn: [],
      PerPage: 10,
      showForm: false,
      busy: false,
      isBusy: false,
      currentPage: 1,
      totalItems: 0,
      timeout: null
    }
  },
  beforeRemove () {
    this.clearTimeout()
  },
  methods: {
    // this resets the timeout for the overlay
    clearTimeout () {
      if (this.timeout) {
        clearTimeout(this.timeout)
        this.timeout = null
      }
    },
    // sets the timeout for the overlay
    setTimeout (callback) {
      this.clearTimeout()
      this.timeout = setTimeout(() => {
        this.clearTimeout()
        callback()
      }, 200)
    },
    // this redirects to the DriverPickup component, activates the overlay and setup the site object for the form
    reDirectToDriverPickup: function (item) {
      this.siteObject.id = item.id
      this.siteObject.numBins = item.numBins
      this.siteObject.siteName = item.siteName
      this.busy = true
      this.setTimeout(() => {
        this.busy = false
        this.showForm = true
      })
    },
    // sets the event to reshow DriverCollection View
    confirmFinish: function (event) {
      this.showForm = false
    },
    // Gets all the site information from the Database
    // It also sets the overlay to show the site are loading in
    getSites: function (ctx) {
      this.busy = true
      this.setTimeout(() => {
        this.busy = false
      })
      const promise = this.axios.get(this.SITE_API_URL + '&siteName=' + ctx.filter + '&page=' + ctx.currentPage)

      // Must return a promise that resolves to an array of items
      return promise.then(resp => {
        // Pluck the array of items off our axios response
        const items = resp.data['hydra:member']
        this.totalItems = resp.data['hydra:totalItems']
        console.log(resp.data)
        // Must return an array of items or an empty array if an error occurred
        return items || []
      })
    }
  }
}
</script>
