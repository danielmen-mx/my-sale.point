<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\PostRequest;

// to eliminate an image is necesary first beggin with the install of the doc required, next this is the route where the images is saved after we charge on a database
use Illuminate\Support\Facades\Storage;
// continuos the procces directly in the apart update

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request)
    {
        // what is the files that the form gonna save?
        // first step: save
        $post = Post::create([ // creamos la variable post que contendrá el contenido de Post::create, usando un arreglo declaramos que un post le pertenece a un user, validamos la informacion y le agregamos lo que recibimos en el request
            'user_id' => auth()->user()->id
        ] + $request->all());

        // second step: image
        if ($request->file('file')) { // si la solicitud de request contiene una imagen la validamos dentro de la logica del sistema y al final lo mandamos a una carpeta llamada public para que se guarde, al final guardamos
            $post->image = $request->file('file')->store('posts', 'public');
            $post->save();
        }
        // thirst step: return
        return back()->with('status', 'Create Success'); // finalizamos con el guardado con un status que se mostrará en el index... 
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post)
    {
        //dd($request->all()); // use this if you wanna see what happen in the backend...
        $post->update($request->all()); // to request all the entries of the post

        if ($request->file('file')) { // now we delete the first doc that we charge, or update, and then we send the new object to our database

            // now, to delete an image, this function with the class, the location that, so that says, find in the 'Storage' the carpet 'public',  next we define the method to delete, ¿delete what?, the image of the post, this line is necesary in the 'destroy' apart
            Storage::disk('public')->delete($post->image);

            $post->image = $request->file('file')->store('posts', 'public'); // to the image that we had, we send the request of a new object, then the 'file' his sending to the store, to update the information and finis that, get save in the database.
            $post->save();
        }
        return back()->with('status', 'Update Success'); // finally this send us an image to see how it looks..
    }

    public function destroy(Post $post)
    {
        Storage::disk('public')->delete($post->image);
        $post->delete(); // this is the function to delete a post...

        return back()->with('status', 'Delete Success');    // this is the method to let's see when the function is complete
    }
}
