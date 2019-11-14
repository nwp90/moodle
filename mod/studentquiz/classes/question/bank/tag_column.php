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
 * Representing tag column
 *
 * @package    mod_studentquiz
 * @copyright  2017 HSR (http://www.hsr.ch)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace mod_studentquiz\bank;

defined('MOODLE_INTERNAL') || die();

/**
 * Represent tag column in studentquiz_bank_view
 *
 * @copyright  2017 HSR (http://www.hsr.ch)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class tag_column extends \core_question\bank\column_base {

    protected $tags;

    protected $searchconditions;

    protected $tagfilteractive;

    /**
     * Get column name
     * @return string
     */
    public function get_name() {
        return 'tags';
    }

    public function set_searchconditions($searchconditions) {
        $this->searchconditions = $searchconditions;
        foreach ($searchconditions as $searchcondition) {
            if (method_exists($searchcondition, 'is_tag_filter_active')) {
                $this->tagfilteractive = $searchcondition->is_tag_filter_active();
            }
        }
    }

    /**
     * Set array of tags, used for renderer by this column
     * @param $tags array ( [questionid] => array( [tag.id] => {$tag->rawname, $tag.name}  )
     */
    public function set_tags($tags) {
        $this->tags = $tags;
    }

    /**
     * Get column title
     * @return string translated title
     */
    protected function get_title() {
        return get_string('tags', 'studentquiz');
    }

    /**
     * Default display column content
     * @param  stdClass $question Questionbank from database
     * @param  string $rowclasses
     */
    protected function display_content($question, $rowclasses) {
        if (!empty($question->tags) && !empty($question->tagarray)) {
            foreach ($question->tagarray as $tag) {
                $tag = $this->render_tag($tag);
                echo $tag;
            }
        } else {
            echo get_string('no_tags', 'studentquiz');
        }
    }

    private function render_tag($tag) {
        return '<span role="listitem" data-value="HELLO" aria-selected="true" class="tag tag-success ">'
                . (strlen($tag->rawname) > 10 ? (substr($tag->rawname, 0, 8) ."...") : $tag->rawname)
                . '</span> ';
    }

    /**
     * Get sql query join for this column
     * @return array sql query join additional
     */
    public function get_extra_joins() {
        if ($this->tagfilteractive) {
            return array('tags' => 'LEFT JOIN ('
                .' SELECT '
                .' ti.itemid questionid,'
                .' COUNT(*) tags,'
                .' SUM(CASE WHEN t.name LIKE :searchtag then 1 else 0 end) searchtag'
                .' FROM {tag} t '
                .' JOIN {tag_instance} ti ON t.id = ti.tagid'
                .' WHERE ti.itemtype = \'question\''
                .' GROUP BY	questionid'
                . ') tags ON tags.questionid = q.id ');
        } else {
            return array('tags' => 'LEFT JOIN ('
                .' SELECT '
                .' ti.itemid questionid,'
                .' COUNT(*) tags,'
                .' 0 searchtag'
                .' FROM {tag} t '
                .' JOIN {tag_instance} ti ON t.id = ti.tagid'
                .' WHERE ti.itemtype = \'question\''
                .' GROUP BY	questionid'
                . ') tags ON tags.questionid = q.id ');
        }
    }

    /**
     * Return parameter for
     */
    public function get_sqlparams() {
            return array();
    }

    public function get_required_fields() {
        return array('tags.tags', 'tags.searchtag');
    }

    public function is_sortable() {
        return 'tags.tags';
    }
}
