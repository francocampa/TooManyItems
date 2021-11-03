<?php
    class Core
    {
        protected $currentController = 'ErrorController';
        protected $currentMethod = 'e404';
        protected $params= [];

        public function __construct()
        {
            require_once '../private/controllers/ErrorController.php';
            $Error= new ErrorController();

            $url = $this->getUrl();
            
            $stringController='';

            if(file_exists('../private/controllers/' . ucwords($url[0]) . '.php')){
                $this->currentController = ucwords($url[0]);
                $stringController= ucwords($url[0]);
                unset($url[0]);
            }
            
            require_once '../private/controllers/' . $this->currentController . '.php';
            $this->currentController= new $this->currentController;
            if(isset($url[1])){
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod=$url[1];
                    unset($url[1]);
                    $this->params = $url ? array_values($url) : [];

                    //Compruebo si el n[umero de parametros recibidos es el correcto
                    $metodo= new ReflectionMethod($this->currentController, $this->currentMethod);
                    $paramsNecesarios= $metodo -> getNumberOfRequiredParameters();
                    if($paramsNecesarios == count($url)){
                        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
                    }else{
                        header( 'location:' . URLROOT . '/error/');    
                    }
                }
            }
            if($this->currentMethod == 'e404' && $stringController != 'Login')call_user_func_array([$Error, $this->currentMethod], $this->params);
        }

        public function getUrl()
        {
            if (isset($_GET['url'])) {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }
    