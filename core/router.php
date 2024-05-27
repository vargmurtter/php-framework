<?php

class Router{
		
    private string $defaultView = "home";
    private	string $defaultAction = "Index";
    
    public $uriStr;
    
    public function route() {
        $url = $_SERVER["REQUEST_URI"];
        $url = preg_replace("/\?.*/", "", $url);
        $url = explode("/", $url);
        $this->uriStr = $url;

        if(empty($url[1]))
            $view = $this->defaultView;
        else
            $view = $url[1];
        
        if(empty($url[2]))
            $action = $this->defaultAction;
        else
            $action = ucfirst($url[2]);
        
        $view_file_name = $view."View";
        $view_class_name = ucfirst($view)."View";
        $action = "action".$action;
        
        if(file_exists("views/".$view_file_name.".php")){
            require_once "views/".$view_file_name.".php";
            $view = new $view_class_name;

            if(method_exists($view, $action)){
                $view->$action();
            }else{
                require_once "views/unfoundView.php";
                $nfv = new UnfoundView();
                $nfv->actionIndex();
            }
        }else{
            require_once "views/unfoundView.php";
            $nfv = new UnfoundView();
            $nfv->actionIndex();
        }
    }
}

?>