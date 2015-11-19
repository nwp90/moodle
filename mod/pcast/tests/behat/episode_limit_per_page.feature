@mod @mod_pcast @file_upload
Feature: A teacher can create a podcast activity and limit the number of episodes displayed per page
  As a teacher
  I need to create a podcast, add an episode, and limit the number of episodes displayed

  @javascript
  Scenario: Limit the number of episodes per page
    Given the following "users" exist:
      | username | firstname | lastname | email |
      | teacher1 | Teacher | 1 | teacher1@example.com |
    And the following "courses" exist:
      | fullname | shortname | category |
      | Course 1 | C1 | 0 |
    And the following "course enrolments" exist:
      | user | course | role |
      | teacher1 | C1 | editingteacher |
    And I log in as "teacher1"
    And I follow "Course 1"
    And I turn editing mode on
    And I add a "Podcast" to section "1" and I fill the form with:
      | Podcast name | Test podcast name |
      | Description | Test podcast description |
      | Episodes shown per page | 5 |
    And I follow "Test podcast name"
    And I press "Add a new episode"
    And I set the following fields to these values:
      | Title | Episode ONE |
      | Summary | Test episode summary 1 |
    And I upload "mod/pcast/tests/fixtures/sample.mp3" file to "Media file" filemanager
    And I press "Save changes"
    And I press "Add a new episode"
    And I set the following fields to these values:
      | Title | Episode TWO |
      | Summary | Test episode summary 2 |
    And I upload "mod/pcast/tests/fixtures/sample.mp3" file to "Media file" filemanager
    And I press "Save changes"
    And I press "Add a new episode"
    And I set the following fields to these values:
      | Title | Episode THREE |
      | Summary | Test episode summary 3 |
    And I upload "mod/pcast/tests/fixtures/sample.mp3" file to "Media file" filemanager
    And I press "Save changes"
    And I press "Add a new episode"
    And I set the following fields to these values:
      | Title | Episode FOUR |
      | Summary | Test episode summary 4 |
    And I upload "mod/pcast/tests/fixtures/sample.mp3" file to "Media file" filemanager
    And I press "Save changes"
    And I press "Add a new episode"
    And I set the following fields to these values:
      | Title | Episode FIVE |
      | Summary | Test episode summary 5 |
    And I upload "mod/pcast/tests/fixtures/sample.mp3" file to "Media file" filemanager
    When I press "Save changes"
    And I should see "Episode ONE"
    And I should see "Episode TWO"
    And I should see "Episode THREE"
    And I should see "Episode FOUR"
    And I should see "Episode FIVE"
    And I navigate to "Edit settings" node in "Podcast administration"
    And I set the following fields to these values:
    | Episodes shown per page | 2 |
    And I press "Save and display"
    Then I should not see "Episode ONE"
    And I should not see "Episode TWO"
    And I should not see "Episode THREE"
    And I should see "Episode FOUR"
    And I should see "Episode FIVE"