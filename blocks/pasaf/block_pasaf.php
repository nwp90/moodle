<?php

class block_pasaf extends block_base {
    public function init() {
        $this->title = get_string('defaulttitle', 'block_pasaf');
    }

    function has_config() {
        return true;
    } 

    function content_is_trusted() {
        return true; //TODO - may need to revisit this - see block_html version of this function
    }

    function specialization() {
        global $PAGE;
        global $DB;
        if ($PAGE->context->get_level_name()=='Category'){
            //debugging("pasaf specialization Category level");
            $this->course_category_name_title = "On ".$PAGE->context->get_context_name();
        }else{
            //debugging("pasaf specialization !Category");
            foreach ($PAGE->context->get_parent_contexts() as $parent_context){
                //debugging("pasaf specialization parent_context". $parent_context->get_context_name());
                if ($parent_context->get_level_name()=='Category'){
                    //debugging("pasaf specialization parent_context Category!");
                    $block_criteria = array(
                        "blockname" => "pasaf",
                        "parentcontextid" => $parent_context->id
                    );
                    $parent_category_block = $DB->get_record('block_instances', $block_criteria);
                    if ($parent_category_block && !empty($parent_category_block->configdata)){
                        //debugging("pasaf specialization parent_context set instance");
                        $this->config = unserialize(base64_decode($parent_category_block->configdata));
                        //debugging("pasaf specialization walk to Category level with block");
                        $this->course_category_name_title = "Within and overridden by ".$parent_context->get_context_name();
                        break;
                    }
                    //debugging("pasaf specialization walk to Category level without block");
                    $this->course_category_name_title = "Within ".$parent_context->get_context_name();
                    break;
                }
            }
        }
    }

    public function get_content() {
        //debugging("pasaf get_content");
        if ($this->content !== null) {
            return $this->content;
        }
        $format = FORMAT_HTML;
        $filteropt = new stdClass;
        $filteropt->overflowdiv = true;

        $this->content  =  new stdClass;
        if (isset($this->config->text)) {
            $this->content->text = format_text($this->config->text["text"], $format, $filteropt);
        } else {
            $this->content->text = '';
        }
        return $this->content;
    }

    public function applicable_formats() {
        return array(
            'site-index' => false,
            'course-view' => false, 
            'course-editcategory' => true,
            'course-view-social' => false,
            'grade-report-pasaf-' => true,
            'mod' => false
        );
    }
}