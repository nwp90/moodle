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
 * Form for editing HTML block ob PASAF reports.
 *
 * @package   block_pasaf
 * @copyright 2020 University of Otago
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * copied and changed from
 * * Form for editing HTML block instances.
 * *
 * * @package   block_html
 * * @copyright 2009 Tim Hunt
 * * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Form for editing HTML block on PASAF reports.
 *
 * @copyright 2020 University of Otago
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * copied and changed from
 * * Form for editing HTML block instances.
 * *
 * * @copyright 2009 Tim Hunt
 * * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_pasaf_edit_form extends block_edit_form {
    protected function specific_definition($mform) {
        global $CFG;

        // Fields for editing HTML block title and contents.
        if (property_exists($this->block, "course_category_name_title")){
            $mform->addElement('html', '<h4>'.$this->block->course_category_name_title.'</h4>');
        }
        $mform->addElement('header', 'configheader', get_string('pluginname', 'block_pasaf'));

        $mform->addElement('text', 'config_title', get_string('configtitle', 'block_pasaf'));
        $mform->setType('config_title', PARAM_TEXT);

        $mform->addElement('editor', 'config_text', get_string('configcontent', 'block_pasaf'));
        $mform->setType('config_text', PARAM_RAW); 

        if (!empty($CFG->block_html_allowcssclasses)) {
            $mform->addElement('text', 'config_classes', get_string('configclasses', 'block_pasaf'));
            $mform->setType('config_classes', PARAM_TEXT);
            $mform->addHelpButton('config_classes', 'configclasses', 'block_pasaf');
        }
    }
}
