<?php



namespace MVC;



class Router
{



    //Se definen como arreglos porque luego usaremos una funcion que recibe un arreglo como parametro

    public $rutasGET = [];

    public $rutasPOST = [];





    public function get($url, $fn)
    {

        $this->rutasGET[$url] = $fn;
    }



    public function post($url, $fn)
    {

        $this->rutasPOST[$url] = $fn;
    }



    public function run()
    {



        //Arreglo de rutas protegidas



        $urlActual = $_SERVER['PATH_INFO'] ?? '/';

        $metodo = $_SERVER['REQUEST_METHOD'];



        if ($metodo === 'GET') {

            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {

            $fn = $this->rutasPOST[$urlActual] ?? null;
        }


        //Proteger rutas


        if ($fn) {
            //La url existe y hay una funcion asociada
            call_user_func($fn, $this);
        } else {

            header('Location: /');
        }
    }



    //Muestra una vista



    public function render($view, $datos = [])
    {

        foreach ($datos as $key => $value) {

            //Mostramos los datos (el valor) con el nombre de la llave

            // el $$ significa variable de variables

            //el sentido de este codigo es acceder al valor de una llave llamandola como Svariable

            //genera variables con el nombre de los keys del arreglo que le estamos pasando

            $$key = $value;
        }

        //Almacena en memoria la vista

        ob_start();

        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean();



        include __DIR__ . "/views/layout.php";
    }
}
