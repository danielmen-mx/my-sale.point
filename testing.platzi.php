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

<!-- Apuntes de Método personalizado -->
Getter: Su función es permitir el obtener el valor de una propiedad de la clase y así poder utilizar dicho valor en diferentes métodos.

Setter: Su función permite brindar acceso a propiedades especificas para poder asignar un valor fuera de la clase.

Un método en programación es una función que tiene un conjunto de instrucciones definidas dentro de él. El método tiene un nombre para identificarlo. Podemos hacer que requiera diferentes tipos de datos de entrada para ejecutarse. Y podemos hacer que el método devuelva datos como resultado.

<!-- La refactorización -->
Alterar el codigo sin modificar la prueba, a traves del testing tenemos la respuesta satisfacotoria de los metodos ingresados y vamos a darle una mejor vista para mejorar la calidad y legibilidad de nuestro codigo, en caso de trabajar con un grupo de trabajo es muy util, ya que debemos asegurarnos de que nuestro codigo lo entiendan todos y no dependan de nosotros para continuar con el trabajo.    <<Comenzamos con el metodo de upload en la carpeta profiles y la route>>
Refactorizar es mejorar el codigo sin dañar la función que realiza.

<!-- Validación -->


<!-- Notes -->
Recuerda siempre nombrar al archivo del Test con está estructura:
        ExampleTest
    <<Es muy importante terminar con el "Test" ya que de lo contrario no lo identificará al realizar la prueba>>
Mientras que los metodos que ingreses dentro del archivo, podrás nombrarlos con la estructura de:
        TestExample()
    <<Del mismo modo esta nomenclatura es muy importante ya que de otro modo el test no se ejecutará y te mandará un error>>

<!-- Qué es TDD -->
Test-Driven Development
Esto significa <<Desarrolla la prueba, despues desarrolla el codigo>>
    Se divide en 3 partes:
    1. Rojo. Creamos la prueba y obtenemos rojo.
    2. Verde. Desarrollamos el código y corregimos los detalles.
    3. Refactorización. Opcional, para mejorar la vista de nuestro código y su legibilidad.

Continuaremos con un proyecto nuevo... {tags}