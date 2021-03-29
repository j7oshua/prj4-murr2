import { mount } from '@vue/test-utils'
import AccountInfo from '@/components/AccountInfo'
import { expect } from 'chai'

let wrapper

describe('AccountInfo', () => {
  beforeEach(() => {
    wrapper = mount(AccountInfo, {
      propsData: {
        account: {
          residentID: 1,
          firstName: '',
          lastName: '',
          profilePic: ''
        }
      }
    })
  })

  it('Should successfully updates first name', async () => {
    const inputFirst = wrapper.find('#firstName')
    await inputFirst.setValue('Tom')
    expect(wrapper.find('#validInput').text()).to.equal('Account information has been updated')
  });

  it('Should unsuccessfully update with too long first name', async () => {
    const inputFirst = wrapper.find('#firstName')
    await inputFirst.setValue('f'.repeat(21))
    expect(wrapper.find('#validInput').text()).to.equal('Unable to update account information')
  })

  it('Should unsuccessfully update with too short first name', async () => {
    const inputFirst = wrapper.find('#firstName')
    await inputFirst.setValue('f'.repeat(21))
    expect(wrapper.find('#validInput').text()).to.equal('Unable to update account information')
  })
})
