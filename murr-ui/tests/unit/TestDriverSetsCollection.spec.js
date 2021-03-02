import { shallowMount } from '@vue/test-utils'
import DriverSiteReport from '@/components/DriverSiteReport'
import { expect } from 'chai'

// global variable for wrapper container
describe('DriverSiteReport.vue', () => {
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

  })

  /**
   * Title: TestObstructedFour
   * Purpose: Test a pickup history of only obstructed bins
   * Expected Result: Success
   * Return: return Collections History Form
   *          Message: "Submitted"
   **/
  it('Should successfully be valid with all bins obstructed', async () => {

  })

  /**
   * Title: TestCollectedFour
   * Purpose: Test a pickup history of only collected bins
   * Expected Result: Success
   * Return: return Collections History Form
   *          Message: "Submitted"
   **/
  it('Should successfully be valid with all bins collected', async () => {

  })
  /**
  * Title: TestCollectedObstructedContaminated
   * Purpose: Test a pickup history of all bin types
   * Expected Result: Success
   * Return: return Collections History Form
   *          Message: "Submitted"
  **/
  it('Should successfully be valid with all bins types', async () => {

  })

  /**
   * Title: TestCollectedObstructedFour
   * Purpose: Test a pickup history of only collected and contaminated bins
   * Expected Result: Success
   * Return: return Collections History Form
   *          Message: "Submitted"
   **/
  it('Should successfully be valid with all bins collected and obstructed', async () => {

  })

  /**
   * Title: TestCollectedContaminatedFour
   * Purpose: Test a pickup history of only collected and contaminated bins
   * Expected Result: Success
   * Return: return Collections History Form
   *          Message: "Submitted"
   **/
  it('Should successfully be valid with all bins collected and contaminated', async () => {

  })

  /**
   * Title: TestContaminatedObstructed
   * Purpose: Test a pickup history of only contaminated and obstructed bins
   * Expected Result: Success
   * Return: return Collections History Form
   *          Message: "Submitted"
   **/
  it('Should successfully be valid with all bins contaminated and obstructed', async () => {

  })

  /**
   * Title: TestMissingBinError
   * Purpose: This test will test if the driver inputs a total of bins less than the
   *          number of bins associated to a site
   * Expected Result: Failure
   * Return: Error Message description: "Error - Invalid number of containers".
   **/
  it('Should display error when container number of containers is less than 4', async () => {

  })

  /**
   * Title: TestMaxBinError
   * Purpose: This test will test if the driver inputs a total of bins
   *          more than the number of bins associated to a site
   * Expected Result: Failure
   * Return: Error Message description: "Error - Invalid number of containers".
   **/
  it('Should display error when container number of containers is more than 4', async () => {

  })

  /**
   * Title: TestNullBinError
   * Purpose: This test will test if the driver inputs null bins
   * Expected Result: Failure
   * Return: Error Message description: "Error - Invalid, Bin number amount required".
   **/
  it('Should display error when container number of containers is null', async () => {

  })

  /**
   * Title: TestPastDateTimeError
   * Purpose: This test will test Past date input
   * Expected Result: Failure
   * Return: Error Message description: "Error - Invalid date response".
   **/
  it('Should display error when date fields are in a past date', async () => {

  })

  /**
   * Title: TestFutureDateTimeError
   * Purpose: This test will test future date input
   * Expected Result: Failure
   * Return: Error Message description: "Error - Invalid date response".
   **/
  it('Should display error when date fields are in a future date', async () => {

  })

  /**
   * Title: TestNullDate
   * Purpose: This test will test null date input
   * Expected Result: Failure
   * Return: Error Message description: "Error – Invalid, date required".
   **/
  it('Should display error when date fields are null', async () => {

  })

  /**
   * Title: TestAllFieldsBlank
   * Purpose: This test will test if all fields are left null
   * Expected Result: Failure
   * Return: Error Message description: "Error – Invalid, date required".
   *         Error Message description: "Error - Invalid require Bin number amounts".
   **/
  it('Should display error when all fields are null', async () => {

  })

  /**
   * Title: TestNoSiteShown
   * Purpose: This test will test if there is no site
   * Expected Result: Failure
   * Return: Error Message description: "Error -No Site Exist".
   **/
  it('Should display error when container fields are required', async () => {

  })

  /**
   * Title: TestLoadPageError
   * Purpose: This test will test failure for page to load
   * Expected Result: Failure
   * Return: Error Message description: "Error - Invalid Page/ Not Found".
   **/
  it('Should display error when container fields are required', async () => {

  })
})
