const TODO_ITEM_ONE = "Learn some Vue JS";
let TODO_ITEM_TWO = "Create tests with cypress.io";
let TODO_ITEM_THREE = "Apply applitools visual testing";

describe("Todo App Test Suite", () => {
  // before each test, make sure to visit the home page of the app
  beforeEach(() => {
    cy.visit("/"); // "baseUrl" is defined in cypress.json file
  });

  context("Add todos", () => {
    it.only("should allow me to add todo items", () => {
      // create one todo item
      cy.get("[data-cy=todo-input]") // grab the input textbox
        .type(TODO_ITEM_ONE) // type the title of the todo
        .type("{enter}"); // press enter

      // verify the item was added
      cy.get("[data-cy=todo-list] li")
        .eq(0) // first li
        .find("label")
        .should("contain", TODO_ITEM_ONE);

      // create one todo item
      cy.get("[data-cy=todo-input]")
        .type(TODO_ITEM_TWO)
        .type("{enter}");

      // verify the item was added
      cy.get("[data-cy=todo-list] li")
        .eq(1) // second li
        .find("label")
        .should("contain", TODO_ITEM_TWO);

      // create one todo item
      cy.get("[data-cy=todo-input]")
        .type(TODO_ITEM_THREE)
        .type("{enter}");

      // verify the item was added
      cy.get("[data-cy=todo-list] li")
        .eq(2) // third li
        .find("label")
        .should("contain", TODO_ITEM_THREE);

      // verify the count is correct
      cy.get("[data-cy=todo-count]").contains("3");
    });

  });
});
