import * as cy from 'bootstrap-vue'

describe('User enters email only, error.', () => {
  it('Creates a new login with only an email error message appears', () => {
    cy.visit('/')
    cy.contains('Resident')
      .type('email@email.com')
      .click()
    cy.contains('h3', 'Must enter a password')
  })
})
describe('User enters phone only, error.', () => {
  it('Creates a new login with only an email error message appears', () => {
    cy.visit('/')
    cy.contains('Resident')
      .type('(111)-111-1111)')
      .click()
    cy.contains('h3', 'Must enter a password')
  })
})
describe('User enters password only, error.', () => {
  it('Creates a new login with only a password error message appears', () => {
    cy.visit('/')
    cy.contains('Resident')
      .type('Passw0rd')
      .click()
    cy.contains('h3', 'Must enter an email and/or phone number')
  })
})
describe('User enters incorrect email format, error.', () => {
  it('Creates a new login with incorrect email error message appears', () => {
    cy.visit('/')
    cy.contains('Resident')
      .type('wrongemail.com')
      .click()
    cy.contains('h3', 'Must enter a valid email address')
  })
})
describe('User enters incorrect phone, error.', () => {
  it('Creates a new login with incorrect phone number error message appears', () => {
    cy.visit('/')
    cy.contains('Resident')
      .type('111-111-12345')
      .click()
    cy.contains('h3', 'Must enter a valid phone number')
  })
})
describe('User enters incorrect password, error.', () => {
  it('Creates a new login with incorrect password error message appears', () => {
    cy.visit('/')
    cy.contains('Resident')
      .type('password')
      .click()
    cy.contains('h3', 'Must enter a valid password')
  })
})
describe('User enters correct information, ', () => {
  it('Creates a new login with valid information success message appears, redirected to new page', () => {
    cy.visit('/')
    cy.contains('Resident')
      .type('111-111-1234')
      .type('Passw0rd')
      .click()
    cy.contains('h3', 'Successful login')
    cy.visit('/ResidentInformation')
  })
})
