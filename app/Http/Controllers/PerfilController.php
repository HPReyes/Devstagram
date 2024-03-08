<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(User $user)
    {
        return view('perfil.index',
        [
            'user'=>$user,

            
        ]);
    }


    public function store(Request $request)
    {
        //A un store siempre se le pasa un request

        $request->request->add(['username'=> Str::SLUG($request->username)]);

        $this->validate($request, [
            'username' => ['required','unique:users,username,'.auth()->user()->id,'min:3','max:20', 'not_in:twitter,editar-perfil'],
        ]);

        if($request->imagen)
        {
            $imagen = $request->file('imagen');
 
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
     
            $manager = new ImageManager(new Driver());
            $imagenServidor = $manager::imagick()->read($imagen);
            $imagenServidor->resize(500, 500);
     
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            
            $imagenServidor->save($imagenPath);
        }

        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        return redirect()->route('posts.index',$usuario->username);
        


    }
}
