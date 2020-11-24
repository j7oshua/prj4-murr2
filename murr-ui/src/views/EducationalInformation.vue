<template>
  <div>
    <img src="../assets/recycling.png" alt="Recycling Logo" width="200">
    <h1>Why Recycle?</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent dui augue, hendrerit et nisl vel, egestas vulputate quam.

      Aliquam feugiat arcu sed augue scelerisque, vitae hendrerit mi facilisis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
    </p>
    <div>
      <b-button v-b-toggle.collapse-1>Acceptable Items <b-icon icon="arrow-down"></b-icon></b-button>
      <b-collapse id="collapse-1" class="mt-2">
        <b-card>
          <ul>
            <li>Lorem ipsum dolor sit amet, consectetur</li>
            <li>Praesent dui augue, hendrerit</li>
            <li>Aliquam feugiat arcu sed augue scelerisque</li>
            <li>Orci varius natoque</li>
            <li>Vestibulum vulputate</li>
            <li>Maecenas egestas leo sed </li>
          </ul>
        </b-card>
      </b-collapse>
    </div>
    <div>
      <b-button v-b-toggle.collapse-2>Unacceptable Items <b-icon icon="arrow-down"></b-icon></b-button>
      <b-collapse id="collapse-2" class="mt-2">
        <b-card>
          <ul>
            <li>Lorem ipsum dolor sit amet, consectetur</li>
            <li>Praesent dui augue, hendrerit</li>
            <li>Aliquam feugiat arcu sed augue scelerisque</li>
            <li>Orci varius natoque</li>
            <li>Vestibulum vulputate</li>
            <li>Maecenas egestas leo sed </li>
          </ul>
        </b-card>
      </b-collapse>
    </div>
  </div>
</template>

<script>
export default {
  name: 'EducationalInformation'
}
</script>

<style scoped>

</style>
