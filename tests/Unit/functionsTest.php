<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class functionsTest extends TestCase
{
    public function testEmails()
    {
        $result = validate_email('danie@admin.com');    // Estamos ingresando una función que actualmente no existe, por ello es necesario primero validar que las funciones en verdad existan.
        $this->assertTrue($result);

        $result = validate_email('danie@@admin.com');
        $this->assertFalse($result);
    }
}
