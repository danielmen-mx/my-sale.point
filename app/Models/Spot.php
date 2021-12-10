<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Spot extends Model
{
    use HasFactory;

    // <-- Testing in PHP and Laravel course -->

    // <-- A esto se le conoce como Mutators, porque estamos cambiando las caracteristicas de una propiedad de un elemento -->
    public function setNameAttribute($value)
    {
        // $this->attributes['name']->strtolower($value);  // Ambas formas realizan lo mismo, unicamente cambia el diseño por uno más amigable. Este modo ya no es usado en Laravel 8 o ^
        $this->attributes['name'] = Str::lower($value);
    }

    // <-- a esto se le conoce como Accessors, porque unicamente estámos accediendo a una de las caracteristicas de un elemento de la tabla -->
    public function getSlugAttribute()
    {
        // return str_replace(' ', '-', $this->name);  // Ambas formas realizan lo mismo, unicamente cambia el diseño por uno más amigable, lo que hay que enfatizar es que en el segundo el string que slugeara estará en inglés por lo que no reconocerá los acentos ya algunos signos...
        // Aunque ambas formas obtienen el mismo resultado, no realizan la mmisma función que en el primero dice "regresame el string reemplazando todos los " "(espacios) en "-"(slugs) del elemento $post propiedad name. Tambien podrías ordenar reemplazar otra cosa.
        return Str::slug($this->attributes['name']);
    }

    public function href()  // Ambos metodos presentados debajo realizan lo mismo...
    {
        // return Str::of($this->slug)->prepend('blog/'); // Estamos llamando el valor de la propiedad slug del elemento spot y vamos a colocar una función que colocará un string antes de nuestro slug...
        return "blog/{$this->slug}"; // Esto es más sencillo porque unicamente estamos concatenando un string 'blog/' antes de nuestra propiedad slug del elemento.
    }

    // Notes: El tercero es un metodo propio, los primeros dos son metodos proporcionados por el framework de laravel, el uso de get y set es propio de Laravel, pero en el tercero nosotros estamos declarando como se ejecutará la función.
}
