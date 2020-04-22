<?php

class block_profspomanage extends block_base
{
    public function init()
    {
        $this->title = get_string('profspomanage', 'block_profspomanage');
    }

    public function get_content()
    {
        global $CFG;
        if ($this->content !== null) {
            return $this->content;
        }

        $style = file_get_contents($CFG->dirroot . "/blocks/profspomanage/style/profspomanage.css");
        $js = file_get_contents($CFG->dirroot . "/blocks/profspomanage/js/profspomanage.js");
        $mainPage = file_get_contents($CFG->dirroot . "/blocks/profspomanage/templates/rendermainpage.mustache");

        $this->content = new stdClass;
        $this->content->text .= "<style>" . $style . "</style>";
        $this->content->text .= "<script src=\"https://code.jquery.com/jquery-1.9.1.min.js\"></script>";
        $this->content->text .= $mainPage;
        $this->content->text .= "<script type=\"text/javascript\"> " . $js . " </script>";

        return $this->content;
    }

    public function hide_header()
    {
        return true;
    }

    function has_config()
    {
        return true;
    }

}
