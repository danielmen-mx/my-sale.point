<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- Vamos a mejorar la vista indicando cuando exista un error y el usuario pueda entender que sucede --}}
    @if ( $errors->any() ) <!-- Laravel de forma automatica crea un registro de los errores que la aplicación presente, asi que podemos hacer una condicional de los errores, indicando cualquier tipo de error 'any()' -->
        @foreach ($errors->all() as $error) <!-- Iteramos entre los errores existentes y los guardamos dentro de una variable error -->
            <li>{{ $error }}</li>   <!-- Finalmente le indicamos que se imprima el error en un li de HTML para que el usuario reciba la notificación del error que esta cometiendo -->
        @endforeach
    @endif

                                        {{-- Se utiliza para indicarle al navegador que el formulario enviará archivos y que entienda qué es lo que enviamos --}}
    <form action="profile" method="POST" enctype="multipart/form-data">
        @csrf <!-- Importante para indicarle a Laravel que es de procedencia segura -->
        <input type="file" name="photo">
        <input type="submit" value="Send">
    </form>
</body>
</html>
{{-- Finalizamos verificando a traves de un input que nuestros archivos son enviados de forma satisfactoria --}}