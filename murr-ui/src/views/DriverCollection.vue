<template>
  <div>
    <div>
      <h1>Collection Site Form</h1>
<!--    </div>-->
<!--    <div v-if="!showForm">-->
<!--      &lt;!&ndash; this is a hard-coded site, for route story this is where the list of sites would be displayed &ndash;&gt;-->
<!--    </div>-->
<!--    <div>-->
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
        empty-text="Failure to connect"
      >
        <template #cell(PickUp)="row" >
          <b-button variant="outline-primary" size="sm" class="mb-2 p-2" @click="reDirectToDriverPickup(row.item)">
            <b-icon icon="plus-circle-fill" variant="primary"></b-icon>
          </b-button>
        </template>
        <template #emptyfiltered>
          <p class="border border-danger text-danger">No site found with that criteria</p>
        </template>
      </b-table>
        <b-col>
          <b-pagination
            v-model="currentPage"
            :per-page="PerPage"
            align="center"
            small
            :total-rows="totalItems"
            ></b-pagination>
        </b-col>
    </div>
    </div>
    <div>
      <DriverPickUp @finished="confirmFinish" :site-object="siteObject" :show-form="showForm"></DriverPickUp>
<!--      <b-alert :show="true"><pre>{{$data}}</pre></b-alert>-->
<!--      <b-alert :show="true"><pre>{{siteObject.id}}</pre></b-alert>-->
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
        type: Object
      },
      item: [{}],
      fields: [{ key: 'siteName', label: 'Site Name' }, { key: 'id', label: 'Site ID' }, { key: 'numBins', label: 'Bins' }, { key: 'PickUp', Label: 'PickUp' }],
      filter: '',
      filterOn: [],
      PerPage: 10,
      showForm: false,
      isBusy: false,
      currentPage: 1,
      totalItems: 0
    }
  },
  methods: {
    reDirectToDriverPickup: function (item) {
      this.siteObject.id = item.id
      this.siteObject.numBins = item.numBins
      this.siteObject.siteName = item.siteName

      this.showForm = true
    },
    confirmFinish: function (event) {
      this.showForm = false
    },
    getSites: function (ctx) {
      // const filter = ctx.filter ? ctx.filter : ''
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

<style scoped>

</style>
