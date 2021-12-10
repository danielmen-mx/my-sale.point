<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function upload(Request $request)
    {
        // $file = $request->file('photo');
        // $file?->store('profiles');

        $request->validate([    // Atraves de esto le indicamos al metodo, que no se puede procesar una solictud $request si el formulario viene vacio.
            'photo' => 'required'
        ]); // Vamos a darle vista al navegador desde view.profile.blade.php

        $request->file('photo')->store('profiles'); // Misma función pero refactorizado para manejar menos código y hacerlo más legible.
        
        return redirect('profile');
    }
}
