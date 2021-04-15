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
        :items="getSites"
        :fields="fields"
        id="my-table"
        :busy.sync="isBusy"
        :filter="filter"
        :filter-included-fields="filterOn"
        :per-page="PerPage"
      >
        <template #cell(PickUp)="row" :row-hovered="isHovered">
          <b-button size="sm" class="mb-2 p-2" @click="reDirectToDriverPickup(row.item)">
            <b-icon icon="plus-circle-fill" variant="primary"></b-icon>
          </b-button>
        </template>
        <template v-slot:emptyfiltered>
          <p class="border border-danger ">No site found with that criteria</p>
        </template>
      </b-table>
    </div>
    </div>
    <div>
      <DriverPickUp @finished="confirmFinish" :site-object="siteObject" :show-form="showForm"></DriverPickUp>
<!--      <b-alert :show="true"><pre>{{$data}}</pre></b-alert>-->
      <b-alert :show="true"><pre>{{siteObject.id}}</pre></b-alert>
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
      item: [{
      //   siteName: 'Wascana',
      //   id: 1,
      //   numBins: 5
      // }, {
      //   siteName: 'Wascana2',
      //   id: 1,
      //   numBins: 5
      }],
      fields: [{ key: 'siteName', label: 'Site Name' }, { key: 'id', label: 'Site ID' }, { key: 'numBins', label: 'Bins' }, { key: 'PickUp', Label: 'PickUp' }],
      filter: '',
      filterOn: [],
      PerPage: 10,
      showForm: false,
      isBusy: false,
      hoveredRow: {}
    }
  },
  methods: {
    reDirectToDriverPickup: function (item) {
      this.siteObject.id = this.item.id
      this.siteObject.numBins = this.item.numBins
      this.siteObject.siteName = this.item.siteName

      this.showForm = true
    },
    confirmFinish: function (event) {
      this.showForm = false
    },
    getSites: function (ctx) {
      // const filter = ctx.filter ? ctx.filter : ''
      const promise = this.axios.get(this.SITE_API_URL + '&siteName=' + ctx.filter)

      // Must return a promise that resolves to an array of items
      return promise.then(resp => {
        // Pluck the array of items off our axios response
        const items = resp.data['hydra:member']

        // Must return an array of items or an empty array if an error occurred
        return items || []
      })
    },
    isHovered: function (item) {
      return item === this.hoveredRow
    },
    rowHovered: function (item) {
      this.hoveredRow = item
    }
  },
  created () {
    this.siteObject.id = row.item.id
    this.siteObject.siteName = row.item.siteName
    this.siteObject.numBins = row.item.numBins
  }
}
</script>

<style scoped>

</style>
