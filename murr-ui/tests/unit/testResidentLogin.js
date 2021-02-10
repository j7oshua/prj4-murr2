import nock from 'nock'
import { expect } from 'chai'
import ResidentLogin from '../../src/components/ResidentLogin'
import { mount } from '@vue/test-utils'


describe('ResidentLogin.vue', () => {
  // Correct login information will move to the next page
  it('Resident with correct login credentials', async () => {
    const loginInfo = 'test@email.com'
    const password = 'password'
    const request = nock('http://localhost:3000/login')
      .get(`/login?login-info=${loginInfo}&password=${password}`)
      .reply(200)
    const wrapper = mount(ResidentLogin)
    expect(request).contains

    expect(wrapper.attributes('loginInfo').to.be(loginInfo))
    // expect(wrapper.text()).to.include('Points :') // if you at home page
    // you will need to check the home page path

      Vue.use(VueRouter)
      const router = new VueRouter({
        routes: [
          { path: '/totest/:id', name: 'totest', component: ResidentLogin },
          { path: '/wherever', name: 'another_component', component: { render: h => '-' } }
        ]
      })
      const vm = new Vue({
        el: document.createElement('div'),
        router: router,
        render: h => h('router-view')
      })
      router.get({ name: 'totest', params: { id: 123 } })
      Vue.nextTick(() => {
        console.log('html:', vm.$el)
        expect(vm.$el.querySelector('h2').textContent).to.equal('Fred Bloggs')
        done()
      })

  })

  // Incorrect login information will have a error message
  it('Resident with wrong login credentials', async () => {
    const loginInfo = 'testemail.com'
    const password = 'password'
    const request = nock('http://localhost:3000/login')
      .get(`/login?login-info=${loginInfo}&password=${password}`)
      .reply(404)
    const wrapper = mount(ResidentLogin)
    expect(wrapper.attributes('loginInfo').to.be(loginInfo))
    const msg = 'Login failed. Please try again.'
    expect(wrapper.text()).to.include(msg) // if you get the error message
  })
})
