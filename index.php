<?php
/**
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */
/**
 * @author Daniel Tome <danieltomefer@gmail.com>
 */

require_once '../../config.php';
require_once $CFG->dirroot . '/local/' . local_gradebook\Constants::PLUGIN_NAME . '/lib.php';
require_once $CFG->dirroot . '/grade/lib.php';
require_once $CFG->dirroot . '/grade/edit/tree/lib.php';
require_once $CFG->dirroot . '/local/' . local_gradebook\Constants::PLUGIN_NAME . '/locallib.php';

$courseid = required_param('id', PARAM_INT);
$action = optional_param('action', 0, PARAM_ALPHA);
$eid = optional_param('eid', 0, PARAM_ALPHANUM);
$weightsadjusted = optional_param('weightsadjusted', 0, PARAM_INT);

//Always check if grade_items.idnumber is set. Otherwise we create one.
$localGradebookFunctions = new local_gradebook\Functions();
$localGradebookFunctions->local_gradebook_complete_grade_idnumbers($courseid);

/// Make sure they can even access this course
if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    print_error('nocourseid');
}

require_login($course);
$context = context_course::instance($course->id);

$url = new moodle_url('/grade/edit/tree/index.php', array('id' => $courseid));
$PAGE->set_url($url);
$PAGE->set_pagelayout('admin');
$PAGE->set_title(get_string('pluginname', 'local_gradebook'));

/// return tracking object
$gpr = new grade_plugin_return(array('type' => 'edit', 'plugin' => 'tree', 'courseid' => $courseid));
$returnurl = $gpr->get_return_url(null);

// get the grading tree object
// note: total must be first for moving to work correctly, if you want it last moving code must be rewritten!
$gtree = new grade_tree($courseid, false, false);

$switch = grade_get_setting($course->id, 'aggregationposition', $CFG->grade_aggregationposition);

$strgrades = get_string('grades');
$strgraderreport = get_string('graderreport', 'grades');

$grade_edit_tree = new local_gradebook\grade\tree\GradebookTree($gtree, false, $gpr);

echo $OUTPUT->header();
// Print Table of categories and items
echo $OUTPUT->box_start('gradetreebox generalbox');

echo '<form id="gradetreeform" method="post" action="' . $returnurl . '">';
echo '<div>';
echo '<input type="hidden" name="sesskey" value="' . sesskey() . '" />';

echo html_writer::table($grade_edit_tree->table);

echo '<div id="gradetreesubmit">';
echo '<input class="advanced" type="submit" value="' . get_string('savechanges') . '" />';
echo '</div>';
echo '</div></form>';
echo $OUTPUT->box_end();
echo $OUTPUT->footer();
