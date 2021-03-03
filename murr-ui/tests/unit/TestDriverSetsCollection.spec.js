import { shallowMount } from '@vue/test-utils'
import DriverSiteReport from '@/components/DriverSiteReport'
import { expect } from 'chai'

let wrapper

describe('DriverSiteReport.vue', () => {
  beforeEach(() => {
    wrapper = shallowMount(DriverSiteReport)
  })
})
// before each test

// create a new wrapper container for the shallow mount

/**
   * Title: TestContaminatedFour
   * Purpose: Test a pickup history of only contaminated bins
   * Expected Result: Success
   * Return: return Collections History Form
   *         Message: "Submitted"
   **/
it('Should successfully be valid with all bins contaminated', async () => {
  const inputCollected = wrapper.find('#collected')
  await inputCollected.setValue('4')
  expect(wrapper.find('#collected').element.value).to.equal('4')
  expect(wrapper.find('#properCollected').text()).to.equal('Valid bin input')
  const inputObstructed = wrapper.find('#obstructed')
  await inputObstructed.setValue('0')
  expect(wrapper.find('#obstructed').element.value).to.equal('0')
  expect(wrapper.find('#properObstructed').text()).to.equal('Valid bin input')
  const inputContaminated = wrapper.find('#contaminated')
  await inputContaminated.setValue('0')
  expect(wrapper.find('#contaminated').element.value).to.equal('0')
  expect(wrapper.find('#properContaminated').text()).to.equal('Valid bin input')
  const inputDateTime = wrapper.find('#dateTime')
  await inputDateTime.setValue('2021-03-02')
  expect(wrapper.find('#dateTime').element.value).to.equal('2021-03-02')
  expect(wrapper.find('#properDateTime').text()).to.equal('Valid date input')
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
  const inputDateTime = wrapper.find('#dateTime')
  await inputDateTime.setValue('2021-03-02')
  expect(wrapper.find('#dateTime').element.value).to.equal('2021-03-02')
  expect(wrapper.find('#properDateTime').text()).to.equal('Valid date input')
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
  const inputDateTime = wrapper.find('#dateTime')
  await inputDateTime.setValue('2021-03-02')
  expect(wrapper.find('#dateTime').element.value).to.equal('2021-03-02')
  expect(wrapper.find('#properDateTime').text()).to.equal('Valid date input')
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
  const inputDateTime = wrapper.find('#dateTime')
  await inputDateTime.setValue('2021-03-02')
  expect(wrapper.find('#dateTime').element.value).to.equal('2021-03-02')
  expect(wrapper.find('#properDateTime').text()).to.equal('Valid date input')
})

/**
 * Title: TestCollectedObstructedFour
 * Purpose: Test a pickup history of only collected and contaminated bins
 * Expected Result: Success
 * Return: return Collections History Form
 *          Message: "Submitted"
 **/
it('Should successfully be valid with all bins collected and obstructed', async () => {
  const inputCollected = wrapper.find('#collected')
  await inputCollected.setValue('2')
  expect(wrapper.find('#collected').element.value).to.equal('2')
  expect(wrapper.find('#properCollected').text()).to.equal('Valid bin input')
  const inputObstructed = wrapper.find('#obstructed')
  await inputObstructed.setValue('2')
  expect(wrapper.find('#obstructed').element.value).to.equal('2')
  expect(wrapper.find('#properObstructed').text()).to.equal('Valid bin input')
  const inputContaminated = wrapper.find('#contaminated')
  await inputContaminated.setValue('0')
  expect(wrapper.find('#contaminated').element.value).to.equal('0')
  expect(wrapper.find('#properContaminated').text()).to.equal('Valid bin input')
  const inputDateTime = wrapper.find('#dateTime')
  await inputDateTime.setValue('2021-03-02')
  expect(wrapper.find('#dateTime').element.value).to.equal('2021-03-02')
  expect(wrapper.find('#properDateTime').text()).to.equal('Valid date input')
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
  const inputDateTime = wrapper.find('#dateTime')
  await inputDateTime.setValue('2021-03-02')
  expect(wrapper.find('#dateTime').element.value).to.equal('2021-03-02')
  expect(wrapper.find('#properDateTime').text()).to.equal('Valid date input')
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
  const inputDateTime = wrapper.find('#dateTime')
  await inputDateTime.setValue('2021-03-02')
  expect(wrapper.find('#dateTime').element.value).to.equal('2021-03-02')
  expect(wrapper.find('#properDateTime').text()).to.equal('Valid date input')
})

/**
 * Title: TestMissingBinError
 * Purpose: This test will test if the driver inputs a total of bins less than the
 *          number of bins associated to a site
 * Expected Result: Failure
 * Return: Error Message description: "Error - Invalid number of containers".
 **/
it('Should display error when container number of containers is less than 4', async () => {
  const inputCollected = wrapper.find('#collected')
  await inputCollected.setValue('2')
  expect(wrapper.find('#collected').element.value).to.equal('2')
  expect(wrapper.find('#properCollected').text()).to.equal('Error - Invalid number of bins')
  const inputObstructed = wrapper.find('#obstructed')
  await inputObstructed.setValue('1')
  expect(wrapper.find('#obstructed').element.value).to.equal('1')
  expect(wrapper.find('#properObstructed').text()).to.equal('Error - Invalid number of bins')
  const inputContaminated = wrapper.find('#contaminated')
  await inputContaminated.setValue('0')
  expect(wrapper.find('#contaminated').element.value).to.equal('0')
  expect(wrapper.find('#properContaminated').text()).to.equal('Error - Invalid number of bins')
  const inputDateTime = wrapper.find('#dateTime')
  await inputDateTime.setValue('2021-03-02')
  expect(wrapper.find('#dateTime').element.value).to.equal('2021-03-02')
  expect(wrapper.find('#properDateTime').text()).to.equal('Valid date input')
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
  expect(wrapper.find('#properCollected').text()).to.equal('Error - Invalid number of bins')
  const inputObstructed = wrapper.find('#obstructed')
  await inputObstructed.setValue('2')
  expect(wrapper.find('#obstructed').element.value).to.equal('2')
  expect(wrapper.find('#properObstructed').text()).to.equal('Error - Invalid number of bins')
  const inputContaminated = wrapper.find('#contaminated')
  await inputContaminated.setValue('1')
  expect(wrapper.find('#contaminated').element.value).to.equal('1')
  expect(wrapper.find('#properContaminated').text()).to.equal('Error - Invalid number of bins')
  const inputDateTime = wrapper.find('#dateTime')
  await inputDateTime.setValue('2021-03-02')
  expect(wrapper.find('#dateTime').element.value).to.equal('2021-03-02')
  expect(wrapper.find('#properDateTime').text()).to.equal('Valid date input')
})

/**
 * Title: TestNullBinError
 * Purpose: This test will test if the driver inputs null bins
 * Expected Result: Failure
 * Return: Error Message description: "Error - Invalid, Bin number amount required".
 **/
it('Should display error when container number of containers is null', async () => {
  expect(wrapper.find('#properCollected').text()).to.equal('Error - Invalid. Bin number amount required.')
  expect(wrapper.find('#properObstructed').text()).to.equal('Error - Invalid. Bin number amount required.')
  expect(wrapper.find('#properContaminated').text()).to.equal('Error - Invalid. Bin number amount required.')
})

/**
 * Title: TestPastDateTimeError
 * Purpose: This test will test Past date input
 * Expected Result: Failure
 * Return: Error Message description: "Error - Invalid date response".
 **/
it('Should display error when date fields are in a past date', async () => {
  const inputDateTime = wrapper.find('#dateTime')
  await inputDateTime.setValue('2021-01-02')
  expect(wrapper.find('#dateTime').element.value).to.equal('2021-01-02')
  expect(wrapper.find('#properDateTime').text()).to.equal('Error - Invalid date response')
})

/**
 * Title: TestFutureDateTimeError
 * Purpose: This test will test future date input
 * Expected Result: Failure
 * Return: Error Message description: "Error - Invalid date response".
 **/
it('Should display error when date fields are in a future date', async () => {
  const inputDateTime = wrapper.find('#dateTime')
  await inputDateTime.setValue('2021-04-02')
  expect(wrapper.find('#dateTime').element.value).to.equal('2021-04-02')
  expect(wrapper.find('#properDateTime').text()).to.equal('Error - Invalid date response')
})

/**
 * Title: TestNullDate
 * Purpose: This test will test null date input
 * Expected Result: Failure
 * Return: Error Message description: "Error – Invalid, date required".
 **/
it('Should display error when date fields are null', async () => {
  expect(wrapper.find('#properDateTime').text()).to.equal('Error - Invalid, date required.')
})

/**
 * Title: TestAllFieldsBlank
 * Purpose: This test will test if all fields are left null
 * Expected Result: Failure
 * Return: Error Message description: "Error – Invalid, date required".
 *         Error Message description: "Error - Invalid require Bin number amounts".
 **/
it('Should display error when all fields are null', async () => {
  expect(wrapper.find('#properCollected').text()).to.equal('Error - Invalid. Bin number amount required.')
  expect(wrapper.find('#properObstructed').text()).to.equal('Error - Invalid. Bin number amount required.')
  expect(wrapper.find('#properContaminated').text()).to.equal('Error - Invalid. Bin number amount required.')
  expect(wrapper.find('#properDateTime').text()).to.equal('Error - Invalid date response')
})

/**
 * Title: TestNoSiteShown
 * Purpose: This test will test if there is no site
 * Expected Result: Failure
 * Return: Error Message description: "Error -No Site Exist".
 **/
it('Should display error when container fields are required', async () => {
  expect(wrapper.find('#properContaminated').text()).to.equal('Error - No site exists.')
})

/**
 * Title: TestLoadPageError
 * Purpose: This test will test failure for page to load
 * Expected Result: Failure
 * Return: Error Message description: "Error - Invalid Page/ Not Found".
 **/
it('Should display error when container fields are required', async () => {
  expect(wrapper.find('#properContaminated').text()).to.equal('Error - Invalid Page/Not Found.')
})
