<?php
class Template 
{
    private $dir_tmpl;
    private $base_tmpl;

    public function __construct($dir_tmpl, $base_tmpl)
    {
        $this->dir_tmpl = $dir_tmpl;
        $this->base_tmpl = $base_tmpl;
    }

    public function render($file, $params = [])
    {
        $template_dir = PROJECT_ROOT . $this->dir_tmpl;
        $template_base = $template_dir . $this->base_tmpl;
        $template_file = $template_dir . $file;

        if (file_exists($template_file))
        {
            extract($params);
            ob_start(); 
            include $template_file;
            $_content = ob_get_clean();
            include $template_base;
        } 
        else
        {
            echo "<b style=\"color:darkred;\"> Template '$template' not found! </b>";
            die();
        }

    }

}
?>