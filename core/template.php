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

    public function render(
        string|null $file = null, 
        array $params = [],
        array $_additional_styles = [], 
        array $_additional_scripts = [],
        string|null $_meta_kw = null,
        string|null $_meta_desc = null
    ): void
    {
        $template_dir = PROJECT_ROOT . $this->dir_tmpl;
        $template_base = $template_dir . $this->base_tmpl;

        if ($file == null)
        {
            include $template_base;
            return;
        }

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
            echo "<b style=\"color:darkred;\"> Template '$template_file' not found! </b>";
            die();
        }

    }

    public function prerender(
        string $file, array $params = []
    ): string|null
    {
        $template_dir = PROJECT_ROOT . $this->dir_tmpl;
        $template_file = $template_dir . $file;

        if (file_exists($template_file))
        {
            extract($params);
            ob_start(); 
            include $template_file;
            $_content = ob_get_clean();
            return $_content;
        } 
        else
        {
            echo "<b style=\"color:darkred;\"> Template '$template_file' not found! </b>";
            die();
        }

    }

}
?>