<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Language file for plugin gradingform_simplefeedbackrubric
 *
 * @package    gradingform_simplefeedbackrubric
 * @copyright  2011 David Mudrak <david@moodle.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcriterion'] = 'Add criterion';
$string['alwaysshowdefinition'] = 'Allow users to preview Simple Simple Feedback Rubric used in the module (otherwise Simple Feedback Rubric will only become visible after grading)';
$string['autopopulatecomments'] = 'Feedback comment created automatically from rubric';
$string['autopopulatecomments0'] = 'No';
$string['autopopulatecomments1'] = 'Yes';
$string['backtoediting'] = 'Back to editing';
$string['criterionordering'] = 'Feedback comment ordering is based on the criterion order specified in the rubric';
$string['criterionordering0'] = 'No';
$string['criterionordering1'] = 'Yes';
$string['confirmdeletecriterion'] = 'Are you sure you want to delete this criterion?';
$string['confirmdeletelevel'] = 'Are you sure you want to delete this level?';
$string['criterionaddlevel'] = 'Add level';
$string['criteriondelete'] = 'Delete criterion';
$string['criterionduplicate'] = 'Duplicate criterion';
$string['criterionempty'] = 'Click to edit criterion';
$string['criterionmovedown'] = 'Move down';
$string['criterionmoveup'] = 'Move up';
$string['definesimplefeedbackrubric'] = 'Define Simple Feedback Rubric';
$string['description'] = 'Description';
$string['err_mintwolevels'] = 'Each criterion must have at least two levels';
$string['err_nocriteria'] = 'Simple Feedback Rubric must contain at least one criterion';
$string['err_nodefinition'] = 'Level definition can not be empty';
$string['err_nodescription'] = 'Criterion description can not be empty';
$string['err_scoreformat'] = 'Number of points for each level must be a valid non-negative number';
$string['err_totalscore'] = 'Maximum number of points possible when graded by the Simple Feedback Rubric must be more than zero';
$string['feedbackrubric'] = 'Feedback rubric';
$string['gradingof'] = '{$a} grading';
$string['leveldelete'] = 'Delete level';
$string['levelempty'] = 'Click to edit level';
$string['name'] = 'Name';
$string['needregrademessage'] = 'The Simple Feedback Rubric definition was changed after this student had been graded. The student can not see this Simple Feedback Rubric until you check the Simple Feedback Rubric and update the grade.';
$string['pluginname'] = 'Simple Feedback Rubric';
$string['previewsimplefeedbackrubric'] = 'Preview Simple Feedback Rubric';
$string['regrademessage1'] = 'You are about to save changes to a Simple Feedback Rubric that has already been used for grading. Please indicate if existing grades need to be reviewed.';
$string['regrademessage5'] = 'You are about to save significant changes to a Simple Feedback Rubric that has already been used for grading. The gradebook value will be unchanged, but the Simple Feedback Rubric will be hidden from students until their item is regraded.';
$string['regradeoption0'] = 'Do not mark for regrade';
$string['regradeoption1'] = 'Mark for regrade';
$string['restoredfromdraft'] = 'NOTE: The last attempt to grade this person was not saved properly so draft grades have been restored. If you want to cancel these changes use the \'Cancel\' button below.';
$string['simplefeedbackrubric'] = 'Simple Feedback Rubric';
$string['simplefeedbackrubricmapping'] = 'Score to grade mapping rules';
$string['simplefeedbackrubricmappingexplained'] = 'The minimum possible score for this Simple Feedback Rubric is <b>{$a->minscore} points</b> and it will be converted to the minimum grade available in this module (which is zero unless the scale is used).
    The maximum score <b>{$a->maxscore} points</b> will be converted to the maximum grade.<br />
    Intermediate scores will be converted respectively and rounded to the nearest available grade.<br />
    If a scale is used instead of a grade, the score will be converted to the scale elements as if they were consecutive integers.';
$string['simplefeedbackrubricnotcompleted'] = 'Please choose something for each criterion';
$string['simplefeedbackrubricoptions'] = 'Simple Feedback Rubric options';
$string['simplefeedbackrubricstatus'] = 'Current Simple Feedback Rubric status';
$string['save'] = 'Save';
$string['savesimplefeedbackrubric'] = 'Save Simple Feedback Rubric and make it ready';
$string['savesimplefeedbackrubricdraft'] = 'Save as draft';
$string['scorepostfix'] = '{$a}points';
$string['showdescriptionteacher'] = 'Display Simple Feedback Rubric description during evaluation';
$string['showdescriptionteacher0'] = 'No';
$string['showdescriptionteacher1'] = 'Yes';
