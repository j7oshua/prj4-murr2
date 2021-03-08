import { shallowMount } from '@vue/test-utils'
import DriverSiteReport from '@/components/DriverPickUp'
import { expect } from 'chai'

let wrapper

describe('DriverPickUp.vue', () => {
  // before each test
  beforeEach(() => {
    // create a new wrapper container for the shallow mount
    wrapper = shallowMount(DriverSiteReport)
  })
})

// we will need to check the post status code and add the "submit" button being clicked
// as well we need to account for the other team on where data goes
// we will need to remove the error messages for improper inputs and move it to be a single message somewhere

/**
   * Title: TestContaminatedFour
   * Purpose: Test a pickup history of only contaminated bins
   * Expected Result: Success
   * Return: return Collections History Form
   *         Message: "Submitted"
   **/
it('Should successfully be valid with all bins contaminated', async () => {
  // look for the collected input box
  const inputCollected = wrapper.find('#collected')
  // set the input value for the collected box to the input '4'
  await inputCollected.setValue('4')
  // this will find the collected input box with the value and check if it equal to '4'
  expect(wrapper.find('#collected').element.value).to.equal('4')
  // this will find the correct input message and check if it is equal to 'Valid bin input'
  expect(wrapper.find('#properCollected').text()).to.equal('Valid bin input')
  // look for the Obstructed input box
  const inputObstructed = wrapper.find('#obstructed')
  // set the input value for the collected box to the input '0'
  await inputObstructed.setValue('0')
  // this will find the obstructed input box with the value and check if it equal to '0'
  expect(wrapper.find('#obstructed').element.value).to.equal('0')
  // this will find the correct input message and check if it is equal to 'Valid bin input'
  expect(wrapper.find('#properObstructed').text()).to.equal('Valid bin input')
  // look for the contaminated input box
  const inputContaminated = wrapper.find('#contaminated')
  // set the input value for the contaminated box to the input '0'
  await inputContaminated.setValue('0')
  // this will find the contaminated input box with the value and check if it equal to '0'
  expect(wrapper.find('#contaminated').element.value).to.equal('0')
  // this will find the correct input message and check if it is equal to 'Valid bin input'
  expect(wrapper.find('#properContaminated').text()).to.equal('Valid bin input')
  // we will need to check the post status code and add the "submit" button being clicked
  // as well we need to account for the other team on where data goes
})

/**
 * Title: TestObstructedFour
 * Purpose: Test a pickup history of only obstructed bins
 * Expected Result: Success
 * Return: return Collections History Form
 *          Message: "Submitted"
 **/
it('Should successfully be valid with all bins obstructed', async () => {
  const inputCollected = wrapper.find('#collected')
  await inputCollected.setValue('0')
  expect(wrapper.find('#collected').element.value).to.equal('0')
  expect(wrapper.find('#properCollected').text()).to.equal('Valid bin input')
  const inputObstructed = wrapper.find('#obstructed')
  await inputObstructed.setValue('4')
  expect(wrapper.find('#obstructed').element.value).to.equal('4')
  expect(wrapper.find('#properObstructed').text()).to.equal('Valid bin input')
  const inputContaminated = wrapper.find('#contaminated')
  await inputContaminated.setValue('0')
  expect(wrapper.find('#contaminated').element.value).to.equal('0')
  expect(wrapper.find('#properContaminated').text()).to.equal('Valid bin input')
})

/**
 * Title: TestCollectedFour
 * Purpose: Test a pickup history of only collected bins
 * Expected Result: Success
 * Return: return Collections History Form
 *          Message: "Submitted"
 **/
it('Should successfully be valid with all bins collected', async () => {
  const inputCollected = wrapper.find('#collected')
  await inputCollected.setValue('0')
  expect(wrapper.find('#collected').element.value).to.equal('0')
  expect(wrapper.find('#properCollected').text()).to.equal('Valid bin input')
  const inputObstructed = wrapper.find('#obstructed')
  await inputObstructed.setValue('0')
  expect(wrapper.find('#obstructed').element.value).to.equal('0')
  expect(wrapper.find('#properObstructed').text()).to.equal('Valid bin input')
  const inputContaminated = wrapper.find('#contaminated')
  await inputContaminated.setValue('4')
  expect(wrapper.find('#contaminated').element.value).to.equal('4')
  expect(wrapper.find('#properContaminated').text()).to.equal('Valid bin input')
})

/**
* Title: TestCollectedObstructedContaminated
 * Purpose: Test a pickup history of all bin types
 * Expected Result: Success
 * Return: return Collections History Form
 *          Message: "Submitted"
**/
it('Should successfully be valid with all bins types', async () => {
  const inputCollected = wrapper.find('#collected')
  await inputCollected.setValue('2')
  expect(wrapper.find('#collected').element.value).to.equal('2')
  expect(wrapper.find('#properCollected').text()).to.equal('Valid bin input')
  const inputObstructed = wrapper.find('#obstructed')
  await inputObstructed.setValue('1')
  expect(wrapper.find('#obstructed').element.value).to.equal('1')
  expect(wrapper.find('#properObstructed').text()).to.equal('Valid bin input')
  const inputContaminated = wrapper.find('#contaminated')
  await inputContaminated.setValue('1')
  expect(wrapper.find('#contaminated').element.value).to.equal('1')
  expect(wrapper.find('#properContaminated').text()).to.equal('Valid bin input')
})

/**
 * Title: TestCollectedContaminatedFour
 * Purpose: Test a pickup history of only collected and contaminated bins
 * Expected Result: Success
 * Return: return Collections History Form
 *          Message: "Submitted"
 **/
it('Should successfully be valid with all bins collected and contaminated', async () => {
  const inputCollected = wrapper.find('#collected')
  await inputCollected.setValue('2')
  expect(wrapper.find('#collected').element.value).to.equal('2')
  expect(wrapper.find('#properCollected').text()).to.equal('Valid bin input')
  const inputObstructed = wrapper.find('#obstructed')
  await inputObstructed.setValue('0')
  expect(wrapper.find('#obstructed').element.value).to.equal('0')
  expect(wrapper.find('#properObstructed').text()).to.equal('Valid bin input')
  const inputContaminated = wrapper.find('#contaminated')
  await inputContaminated.setValue('2')
  expect(wrapper.find('#contaminated').element.value).to.equal('2')
  expect(wrapper.find('#properContaminated').text()).to.equal('Valid bin input')
})

/**
 * Title: TestContaminatedObstructed
 * Purpose: Test a pickup history of only contaminated and obstructed bins
 * Expected Result: Success
 * Return: return Collections History Form
 *          Message: "Submitted"
 **/
it('Should successfully be valid with all bins contaminated and obstructed', async () => {
  const inputCollected = wrapper.find('#collected')
  await inputCollected.setValue('0')
  expect(wrapper.find('#collected').element.value).to.equal('0')
  expect(wrapper.find('#properCollected').text()).to.equal('Valid bin input')
  const inputObstructed = wrapper.find('#obstructed')
  await inputObstructed.setValue('2')
  expect(wrapper.find('#obstructed').element.value).to.equal('2')
  expect(wrapper.find('#properObstructed').text()).to.equal('Valid bin input')
  const inputContaminated = wrapper.find('#contaminated')
  await inputContaminated.setValue('2')
  expect(wrapper.find('#contaminated').element.value).to.equal('2')
  expect(wrapper.find('#properContaminated').text()).to.equal('Valid bin input')
})

/**
 * Title: TestMissingBinError
 * Purpose: This test will test if the driver inputs a total of bins less than the
 *          number of bins associated to a site
 * Expected Result: Failure
 * Return: Error Message description: "Error - Invalid number of containers".
 **/
it('Should display error when container number of containers is less than 4', async () => {
  // look for the collected input box
  const inputCollected = wrapper.find('#collected')
  // this will set the input to '1'
  await inputCollected.setValue('1')
  // this will find the collected input box with the value and check if it equal to '1'
  expect(wrapper.find('#collected').element.value).to.equal('1')
  // this will find the correct input message and check if it is equal to 'Invalid bin input'
  expect(wrapper.find('#improperCollected').text()).to.equal('Error - Invalid number of bins')
  // look for the obstructed input box
  const inputObstructed = wrapper.find('#obstructed')
  // this will set the input to '1'
  await inputObstructed.setValue('1')
  // this will find the obstructed input box with the value and check if it equal to '1'
  expect(wrapper.find('#obstructed').element.value).to.equal('1')
  // this will find the correct input message and check if it is equal to 'Invalid bin input'
  expect(wrapper.find('#improperObstructed').text()).to.equal('Error - Invalid number of bins')
  // look for the contaminated input box
  const inputContaminated = wrapper.find('#contaminated')
  // this will set the input to '1'
  await inputContaminated.setValue('1')
  // this will find the contaminated input box with the value and check if it equal to '1'
  expect(wrapper.find('#contaminated').element.value).to.equal('1')
  // this will find the correct input message and check if it is equal to 'Invalid bin input'
  expect(wrapper.find('#improperContaminated').text()).to.equal('Error - Invalid number of bins')
})

/**
 * Title: TestMaxBinError
 * Purpose: This test will test if the driver inputs a total of bins
 *          more than the number of bins associated to a site
 * Expected Result: Failure
 * Return: Error Message description: "Error - Invalid number of containers".
 **/
it('Should display error when container number of containers is more than 4', async () => {
  const inputCollected = wrapper.find('#collected')
  await inputCollected.setValue('2')
  expect(wrapper.find('#collected').element.value).to.equal('2')
  expect(wrapper.find('#improperCollected').text()).to.equal('Error - Invalid number of bins')
  const inputObstructed = wrapper.find('#obstructed')
  await inputObstructed.setValue('2')
  expect(wrapper.find('#obstructed').element.value).to.equal('2')
  expect(wrapper.find('#improperObstructed').text()).to.equal('Error - Invalid number of bins')
  const inputContaminated = wrapper.find('#contaminated')
  await inputContaminated.setValue('2')
  expect(wrapper.find('#contaminated').element.value).to.equal('2')
  expect(wrapper.find('#improperContaminated').text()).to.equal('Error - Invalid number of bins')
})

/**
 * Title: TestNullBinError
 * Purpose: This test will test if the driver inputs null bins
 * Expected Result: Failure
 * Return: Error Message description: "Error - Invalid, Bin number amount required".
 **/
it('Should display error when container number of containers is null', async () => {
  expect(wrapper.find('#improperCollected').text()).to.equal('Error - Invalid. Bin number amount required.')
  expect(wrapper.find('#improperObstructed').text()).to.equal('Error - Invalid. Bin number amount required.')
  expect(wrapper.find('#improperContaminated').text()).to.equal('Error - Invalid. Bin number amount required.')
})

/**
 * Title: TestNoSiteShown
 * Purpose: This test will test if there is no site
 * Expected Result: Failure
 * Return: Error Message description: "Error -No Site Exist".
 **/
it('Should display error when report has no assigned site', async () => {
  expect(wrapper.find('#improperContaminated').text()).to.equal('Error - No site exists.')
})

/**
 * Title: TestLoadPageError
 * Purpose: This test will test failure for page to load
 * Expected Result: Failure
 * Return: Error Message description: "Error - Invalid Page/ Not Found".
 **/
it('Should display error when page is unable to load', async () => {
  expect(wrapper.find('#improperContaminated').text()).to.equal('Error - Invalid Page/Not Found.')
})
