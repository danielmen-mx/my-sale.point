Testing with PHPUnit -- <!-- Revisar el curso de desarrollo de un API -->

El comando que usaras para ejecucion en la terminal es:
$ vendor/bin/phpunit        ||      $ php artisan test
Trabajar con PHPUnit        ||   trabajar con un comando propio de laravel

Función del testing
Realizar cambios dentro del codigo y que se ponga a prueba antes de subirlo a produccion.
Si realizamos cambios en el codigo podemos dañar otra parte del sistema, pero con el testong podemos verifcar que nuestro codigo nuevo no cause confilcto con otras funciones.

Nos ubicamos en la carpeta >test la cual contiene dos carpetas: Unit y Feature.
Unit es donde se realizaran las pruebas.
Feature es para testear funciones especificas y más complejas.

Cuando crees un archivo lo ideal es testearlo con PHPUnit.
Dentro de los archivos test Unit manejamos un standar cuando los archivos se creen debemos terminarlo con un test.php, ejemplo, si creamos una prueba de un modelo User::class lo ideal es nombrarlo Usertest.php, y de manera interna los metodos deben comenzar con la palabra function testExample().

Diferencia entre la prueba Unit y Feature:
    Unit es tal cual su nombre se usa para realizar las pruebas unitarias y verificar que estas pequeñas tareas se esten realizando de la forma correcta, mientras que feature es cuando pruebas un conjunto de funciones, y verificas que todo se está orquestando de forma adecuada y obteniendo el resultado esperado.

    Para realizar pruebas de forma especifica podemos usar comandos como los siguientes:
        $ php artisan make:test ExampleTest
        $ php artisan make:test ExampleTest --unit
        Si no usamos "--unit" por default se irá a la carpeta feature.

    public function testBasicTest()
    {
        $this->assertTrue(true);    <!-- esta función se lee, afirma que True es true--> el resultado de la prueba debe ser satisfactorio.
    }

    Cuando utilizar pruebas unit o feature?
        - eso dependerá del tipo de prueba que requieras utilizar, pues como tal las pruebas unit se enfocaran en una única caracteristica de las funciones o metodos, mientras que con las pruebas feature se correrá de forma global y no solo probariamos la funcion sino que al mismo tiempo se realizaria en los controladores, vistas y demás funciones que realizamos. Cual Test crear dependerá de la necesidad que tengas.

<!-- Resultado -->
https://phpunit.readthedocs.io/en/9.5/assertions.html <--- revisa el contenido de la página paa conocer los diferentes tipos de assertions o verificaciones que incluye phpUnit

Podemos realizar pruebas en Feature de forma especifica de una de sus funciones de la siguiente forma:
    $ php artisan test --filter testExample     <!-- de este modo estamos indicando a la terminal realizar una prueba de un único metodo dentro de nuestra carpeta test -->