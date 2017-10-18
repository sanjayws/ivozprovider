@brand
@genericCallACLPatterns
@brand10

Feature: Generic call ACL patterns admin page
  As a main operator
  I want to be able to access generic call ACL patterns admin page
  emulating brand operator
  In order to check and manage them

Background:
  Given I go to the admin page
   When I send valid admin credentials
   Then I am logged in
   When I click on brand emulation button
    And I emulate the brand at position "1"
    And I click on "GenericCallACLPatterns" CTA
   Then I am on "GenericCallACLPatterns" list

Scenario: I can create new generic generic call ACL patterns
  When I click on add button
   And I fill out the form with "brand/genericCallACLPatterns/new" data fixture
   And I click on save button
  Then I can see confirmation dialog
  When I click on close dialog button
  Then I am on "GenericCallACLPatterns" list

Scenario: I can save generic call ACL patterns
  Given I can see at least one row
   When I click on "GenericCallACLPatterns" first elements edit button
    And I click on save button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "GenericCallACLPatterns" list

Scenario: I can click on delete generic call ACL patterns button
  Given I can see at least one row
   When I click on "GenericCallACLPatterns" first elements delete button
   Then I can see confirmation dialog
   When I click on close dialog button
   Then I am on "GenericCallACLPatterns" list
