<?php

class controller
{
    protected $view = Null;
    protected $model = Null;

    function __construct()
    {
        $this->view = new view();
    }

    function view($path, $args = array())
    {
        $this->view->render($path, $args) ;
    }

    function LoadModel($name)
    {
        $name .= "Model";
        $this->model = new $name();
    }

    public function ConvertToArrayNames(array $args)
    {
        $res = array();
        if (count($args) % 2 == 0)
        {
            for ($i = 0 ; $i < count($args) ; $i+=2)
            {
                $res[$args[$i]] = $args[$i+1] ; 
            }
        }
        return $res ; 
    }

}
?>