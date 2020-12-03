// https://docs.cypress.io/api/introduction/api.html

describe("Profile Completion Test Pass", () => {
  it("should allow me to insert data into each field", () => {
    cy.visit('/profile')
    cy.get("[data-fn=todo-input]")
      .type('Lane');
    cy.get("[data-fn=todo-input]")
      .find("input")
      .should("contain", 'Lane');

    cy.get("[data-ln=todo-input]")
      .type('Lockhart');
    cy.get("[data-ln=todo-input]")
      .find("input")
      .should("contain", 'Lockhart');

    cy.get("[data-sa=todo-input]")
      .type('222 Wayburn St');
    cy.get("[data-sa=todo-input]")
      .find("input")
      .should("contain", '222 Wayburn St');


    cy.get("[data-ci=todo-input]")
      .type('Warman');
    cy.get("[data-ci=todo-input]")
      .find("input")
      .should("contain", 'Warman');

    cy.get("[data-pv=todo-input]")
      .type('SK');
    cy.get("[data-pv=todo-input]")
      .find("input")
      .should("contain", 'SK');

    cy.get("[data-po=todo-input]")
      .type('S0K4S0');
    cy.get("[data-po=todo-input]")
      .find("input")
      .should("contain", 'S0K4S0');

  })
});

describe("Profile Completion Test Fail", () => {
  it("should allow me to insert data into each field", () => {
    cy.visit('/profile')
    cy.get("[data-fn=todo-input]")
      .type('Lanesssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss');
    cy.get("[data-fn=todo-input]")
      .find("error")
      .should("contain", 'First name must not exceed 20 characters');

    cy.get("[data-ln=todo-input]")
      .type('Lockhartsssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss');
    cy.get("[data-ln=todo-input]")
      .find("error")
      .should("contain", 'Last name must not exceed 20 characters');

    cy.get("[data-sa=todo-input]")
      .type('222 Wayburn Stssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss');
    cy.get("[data-sa=todo-input]")
      .find("error")
      .should("contain", 'Street Address must not exceed 50 characters');


    cy.get("[data-ci=todo-input]")
      .type('Warmanssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss');
    cy.get("[data-ci=todo-input]")
      .find("error")
      .should("contain", 'City must not exceed 30 characters');

    cy.get("[data-pv=todo-input]")
      .type('SKwwawe');
    cy.get("[data-pv=todo-input]")
      .find("error")
      .should("contain", 'Province Initials must not exceed 2 characters');

    cy.get("[data-po=todo-input]")
      .type('S0K4S0asdas');
    cy.get("[data-po=todo-input]")
      .find("error")
      .should("contain", 'Postal Code must follow the format ‘L#L#L#');

  })
});

describe("Profile Completion Test Fail", () => {
  it("should allow me to insert data into each field", () => {
    cy.visit('/profile')
    cy.get("[data-fn=todo-input]")
      .type('Lanesssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss');
    cy.get("[data-fn=todo-input]")
      .find("error")
      .should("contain", 'First name must not exceed 20 characters');

    cy.get("[data-ln=todo-input]")
      .type('Lockhart');
    cy.get("[data-ln=todo-input]")
      .find("input")
      .should("contain", 'Lockhart');

    cy.get("[data-sa=todo-input]")
      .type('222 Wayburn St');
    cy.get("[data-sa=todo-input]")
      .find("input")
      .should("contain", '222 Wayburn St');


    cy.get("[data-ci=todo-input]")
      .type('Warmanssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss');
    cy.get("[data-ci=todo-input]")
      .find("error")
      .should("contain", 'City must not exceed 30 characters');

    cy.get("[data-pv=todo-input]")
      .type('SK');
    cy.get("[data-pv=todo-input]")
      .find("input")
      .should("contain", 'SK');

    cy.get("[data-po=todo-input]")
      .type('S0K4S0asdas');
    cy.get("[data-po=todo-input]")
      .find("error")
      .should("contain", 'Postal Code must follow the format ‘L#L#L#');

  })
});
