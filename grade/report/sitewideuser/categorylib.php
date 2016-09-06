<?php
/**
 * @package   gradereport_sitewideuser
 * @copyright 2012 onwards Barry Oosthuizen http://elearningstudio.co.uk
 * @author    Barry Oosthuizen
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * 
 * @param object $category
 * @param type $displaylist
 * @param type $parentslist
 * @param type $depth
 * @param type $files
 * @return type
 */
function gradereport_sitewideuser_print_category($category=NULL, $displaylist=NULL, $parentslist=NULL, $depth=-1, $files = true) {

    Global $CFG;
    /// Recursive function to print out all the categories in a nice format
    /// with or without courses included

    if (isset($CFG->max_category_depth) && ($depth >= $CFG->max_category_depth)) {
        return;
    }
    
    if ($category) {

        if ($category->visible or has_capability('moodle/course:update', context_system::instance())) {
            gradereport_sitewideuser_print_category_info($category, $depth, $files);
        } else {
            return;  // Don't bother printing children of invisible categories
        }
    } else {
        $category = new stdClass();
        $category->id = "0";
    }

    if ($categories = coursecat::get($category->id)->get_children()) {   // Print all the children recursively
        $countcats = count($categories);
        $count = 0;
        $first = true;
        $last = false;

        foreach ($categories as $cat) {
            $count++;
            if ($count == $countcats) {
                $last = true;
            }
            $up = $first ? false : true;
            $down = $last ? false : true;
            $first = false;

            gradereport_sitewideuser_print_category($cat, $displaylist, $parentslist, $depth + 1, $files);
            echo '</ul></li>';
        }
    }
}

/**
 * gradereport_sitewideuser_print_category_info
 * 
 * @param type $category
 * @param type $depth
 * @param type $files
 */
function gradereport_sitewideuser_print_category_info($category, $depth, $files = false) {
// Prints the category info in indented fashion
// This function is only used by print_whole_category_list() above
    Global $CFG; Global $DB;

    $coursecount = $DB->count_records('course');
    $i = 0;

    $courses = get_courses($category->id, 'c.sortorder ASC', 'c.id,c.sortorder,c.visible,c.fullname,c.shortname');
    if ($depth) {
        if(!$i == 0) {
            echo '</li>';
            $i = 1;
        }
        if ($category->visible) {
            echo '<li><input type="checkbox" name="category" id="catid'.$category->id.'"/>';
            echo '<label>'.format_string($category->name).'</label>';
        } else {
            echo '<li><input type="checkbox" name="hiddencategory" id="catid'.$category->id.'"/>';
            echo '<label>'.format_string($category->name).'</label></li>';
        }
    } else {
        if(!$i == 0) {
            echo '</li>';
            $i = 1;
        }
        if ($category->visible) {
            echo '<li><input type="checkbox" name="category" id="catid'.$category->id.'"/>';
            echo '<label>'.format_string($category->name).'</label>';
        } else {
            echo '<li><input type="checkbox" name="hiddencategory" id="catid'.$category->id.'"/>';
            echo '<label>'.format_string($category->name).'</label></li>';
        }
    }
    if ($files and $coursecount) {
        echo '<ul>';
        if ($courses && !(isset($CFG->max_category_depth)&& ($depth>=$CFG->max_category_depth - 1))) {
            foreach ($courses as $course) {
                if ($course->visible) {
                    echo '<li><input type="checkbox" name="coursebox[]" value="'.$course->id.'"/>';
                    echo '<label>'.format_string($course->shortname).'</label></li>';
                } else {
                    echo '<li><input type="checkbox" name="coursebox[]" value="'.$course->id.'"/>';
                    echo '<label>'.format_string($course->shortname).'</label></li>';

                }
            }
        }
    }
}
