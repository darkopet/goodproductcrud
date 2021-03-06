<?php

/** Class ROUTER */

namespace app;
use app\Database;

class Router 
{
    public array $getRoutes = [];
    public array $postRoutes = [];
    public Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function get($url, $fn)
    {
        //var_dump('getfn', $url);
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function resolve()
    {
        $currentUrl = $_SERVER['REQUEST_URI'] ?? '/';
                // var_dump($currentUrl);
                // echo "<br>";

                // echo'<pre>';
                // var_dump($_SERVER);
                // echo'</pre>';
       
        if(strpos($currentUrl, '?') !== false)
        {
            $currentUrl = substr($currentUrl, 0, strpos($currentUrl, '?'));
        }
                // var_dump($currentUrl);
                // echo "<br><br>";

        $method = $_SERVER['REQUEST_METHOD'];
                // var_dump($method);

        if($method === 'GET')
        {       
                //var_dump($currentUrl);
            $fn = $this->getRoutes[$currentUrl] ?? null;
                //var_dump($fn); 
        }
        else 
        { $fn = $this->postRoutes[$currentUrl] ?? null; }
                // echo "<br>";
                // var_dump($fn);
                // echo "<br><br>";

                // echo '<pre>';
                // var_dump($this);
                // echo "</pre>"; 

                // $fn = $currentUrl;
                
        if($fn) 
        {   
                // echo "chckpnt7<br><br>";

                // echo '<pre>';
                // var_dump($this);
                // echo "</pre>"; 

                // echo '<pre>';
                // var_dump($fn);
                // echo "</pre>"; 

                // echo "chckpnt8<br><br>";

            $that = $this;
            call_user_func($fn, $that);

            // $fn->{'index'}($this);
            // $this->{'index'}($fn);
            // $fn->{$index}($this);
            // $this->{$index}($fn);

            // $fn($this);
            // $this($fn);
            // $fn->{$this}();
            // call_user_func($this, $fn);

                // echo "chckpnt9<br><br>";

                // echo '<pre>';
                // var_dump($fn);
                // echo "</pre>"; 
        }
        else { echo "Page Not Found"; }
    }

    public function renderView($view, $params = []) // products/index
    {
        foreach ($params as $key => $value)
        {
           $$key = $value;
        } 

        // var_dump(__DIR__);

        ob_start(); # To automatically send the content to the browser via local buffer
        include_once __DIR__."/views/$view.php"; # The content that is being sent
        $content = ob_get_clean(); # Cleaning the local buffer, value of the view html file in the $content
        include_once __DIR__."/views/_layout.php";

                // echo '<pre>';
                // var_dump($_SERVER);
                // echo '</pre>';
        
    }
}
