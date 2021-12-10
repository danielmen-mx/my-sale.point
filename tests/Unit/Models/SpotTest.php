<?php

namespace Tests\Unit\Models;

use PHPUnit\Framework\TestCase;
use App\Models\Spot;
use Illuminate\Support\Str;

class PostTest extends TestCase
{
    public function test_set_name_in_lowercase() // Vamos a testear una función que comprube que string lo estamos convirtiendo a minusculas
    {
        $spot = new Spot();
        $spot->name = 'Curso de Testing en PHP';    // Al objeto le pondremos la propiedad name y un valor, ojo que el string se declaró en forma de oración, con mayus y minus...

        $this->assertEquals('curso de testing en php', $spot->name);    // La comprobación dice "comprobar que 'curso de testing en php' sea igual que lo que contiene la propiedad name de $post"
        // Si está función se esta ejecutando correctamente nos dará un passed al ejecutar el test en la terminal.
        // self::assertEquals(Str::lower($post->title), $post->title);   // Esto realiza la misma comprobación que la de arriba, pero con diferente diseño...
    }

    public function test_get_slug() // No olvides comenzar siempre con la palabra test_name al principio de la función.
    {
        $spot = new Spot();
        $spot->name = 'Curso de Testing en PHP';

        $this->assertEquals('curso-de-testing-en-php', $spot->slug);
        // self::assertEquals(Str::slug($post->name), $post->slug);
    }

    public function test_get_href()
    {
        $spot = new Spot();
        $spot->name = 'Curso de testing en PHP';
        $href = Str::of($spot->name)->slug()->prepend('blog/');

        // self::assertEquals($href, $spot->href());
        self::assertEquals('blog/curso-de-testing-en-php', $spot->href());
    }
}
