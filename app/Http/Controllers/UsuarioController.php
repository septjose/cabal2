<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class UsuarioController extends Controller
{
    public function Login(Request $input)
	{
    $email = $input['email_show'];
    $contrasenia = $input['contrasenia_show'];

    $query = "select * from usuario where email='$email'";
    $data=DB::select($query);
    print_r($data);

    die();
	}

      public function rol()
	{
		//$data = Rol::all();
		$posts=DB::select('select * from rol');
        //$videos_recientes=DB::select('SELECT clases.url,cursos.fecha_creacion,cursos.nombre,cursos.descripcion,cursos.precio,IFNULL(COUNT(adquirir.id_curso), 0)as vendidos,IFNULL(TRUNCATE(AVG(adquirir.calificacion),0),0) as calificacion FROM cursos LEFT JOIN adquirir ON cursos.id_curso = adquirir.id_curso inner join clases on clases.id_curso=cursos.id_curso GROUP BY cursos.id_curso ORDER BY(cursos.fecha_creacion) desc limit 6  ');

        //print_r ($data);
		//exit();
		return view('/crud/rol',compact('posts'));
		//return ('/Rol/Rol')->withData($data);
		//return view('rol',compact('rol'));

	}


    public function index(Request $request)
    {
        $request->session()->put('search', $request
            ->has('search') ? $request->get('search') : ($request->session()
            ->has('search') ? $request->session()->get('search') : ''));

        $request->session()->put('field', $request
            ->has('field') ? $request->get('field') : ($request->session()
            ->has('field') ? $request->session()->get('field') : 'email'));

        $request->session()->put('sort', $request
            ->has('sort') ? $request->get('sort') : ($request->session()
            ->has('sort') ? $request->session()->get('sort') : 'asc'));



  //      echo "<pre>";
    //    print_r($request->session()->get('field'));
//        die();
        $posts = new Usuarios();
        $posts = $posts->where('email', 'like', '%' . $request->session()->get('search') . '%')
            ->orderBy($request->session()->get('field'), $request->session()->get('sort'))

            ->paginate(5);
        if ($request->ajax()) {
            return view('Usuarios.index', compact('posts'));
        } else {
            return view('Usuarios.Ajax', compact('posts'));
        }
    }

    public function create(Request $request)
    {
        if ($request->isMethod('get'))
            return view('Usuarios.Form');

        $rules = [
            'email' => 'required',
            'nombre' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return response()->json([
                'fail' =>true,
                'errors' => $validator->errors()
            ]);

        $post = new Usuarios();
        $post->email = $request->email;
        $post->nombre = $request->nombre;
        $post->save();

        return response()->json([
            'fail' => false,
            'redirect_url' => url('posts')
        ]);
    }

    public function show(Request $request, $id)
    {


//        if($request->isMethod('get')) {
//echo  "<pre>";
//print_r(Usuarios::where ('email',$id)->get());


    return view('Usuarios.Detail',['post' => Usuarios::where('email', $id)->get()]);
  //      }
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('get'))
            return view('Usuarios.Form',['post' => Usuarios::where('email', $id)->get()]);

        $rules = [
            'email' => 'required',
            'nombre' => 'required',
        ];

//        $validator = Validator::make($request->all(), $rules);
     //   if ($validator->fails())
   //         return response()->json([
         //       'fail' =>true,
       //         'errors' => $validator->errors()
           // ]);

        $post = Usuarios::where('email', $id)->get();
        $post->email = $request->email;
        $post->nombre = $request->nombre;
        $post->save();

        return response()->json([
            'fail' => false,
            'redirect_url' => url('Usuarios')
        ]);
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return redirect('posts');
    }
}
