<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Alumno;
use Illuminate\Http\Request;
use App\DisparadorCollecciones;
use App\http\Requests\AlumnoRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(Auth::user()->rol == 'Administrador'){

            $usuarios = User::all();
            return view('administrador')->with('usuarios', $usuarios);

        } else {

            $alumnos = Alumno::all();
            return view('home')->with('alumnos', $alumnos);
        
        }


    }

    public function mostrar_alumnos($id){

        $consulta           = Alumno::where('matricula', $id)->first();
        return response()->json($consulta);

    }

    public function guardar(Request $request){

        $consulta           = Alumno::where('matricula', $request->matricula)->first();

        if($consulta == null){
           
            $alumno             = new Alumno();
            $alumno->matricula  = $request->matricula;
            $alumno->nombre     = $request->nombre;
            $alumno->curso      = $request->curso;
            $alumno->asignatura = $request->asignatura;
            $alumno->repite     = $request->repite;
            $alumno->nota       = $request->nota;
            $alumno->save();

            return redirect("home")
            ->with("mensaje_exitoso", "Insercion realizada exitosamente");

        } else {
            return redirect("home")
            ->with("mensaje_error", "Ya existe un registro con ese numero de matricula, Evite duplicidad de registros");
        }

        

    }

    public function actualizar(Request $request, $id){

        // Consulta del registro a actualizar
        $alumno_serch             = Alumno::where('matricula', $id)->first();

        // Trigger function manual
        $disparador             = new DisparadorCollecciones();
        $disparador->matricula  = $alumno_serch->matricula;
        $disparador->nombre     = $alumno_serch->nombre;
        $disparador->curso      = $alumno_serch->curso;
        $disparador->asignatura = $alumno_serch->asignatura;
        $disparador->repite     = $alumno_serch->repite;
        $disparador->usuario    = Auth::user()->name;
        $disparador->rol        = Auth::user()->rol;
        $disparador->fecha      = date('Y-m-d');
        $disparador->nota       = $alumno_serch->nota;
        $disparador->accion     = 'Actualizar';
        $disparador->save();

        // Actualizacion
        $alumno             = Alumno::where('matricula', $id)->first();
        $alumno->matricula  = $request->matricula;
        $alumno->nombre     = $request->nombre;
        $alumno->curso      = $request->curso;
        $alumno->asignatura = $request->asignatura;
        $alumno->repite     = $request->repite;
        $alumno->nota       = $request->nota;
        $alumno->update();

        return redirect("home")
            ->with("mensaje_exitoso", "Actualización realizada exitosamente");

    }

    public function eliminar($id){

        // Consulta del registro a actualizar
        $alumno_serch             = Alumno::where('matricula', $id)->first();
        
        // Trigger function manual
        $disparador             = new DisparadorCollecciones();
        $disparador->matricula  = $alumno_serch->matricula;
        $disparador->nombre     = $alumno_serch->nombre;
        $disparador->curso      = $alumno_serch->curso;
        $disparador->asignatura = $alumno_serch->asignatura;
        $disparador->repite     = $alumno_serch->repite;
        $disparador->usuario    = Auth::user()->name;
        $disparador->rol        = Auth::user()->rol;
        $disparador->fecha      = date('Y-m-d');
        $disparador->nota       = $alumno_serch->nota;
        $disparador->accion     = 'Eliminar';
        $disparador->save();
        
        
        $alumno             = Alumno::where('matricula', $id)->first();
        $alumno->delete();

        return redirect("home")
            ->with("mensaje_exitoso", "Eliminación realizada exitosamente");
    }

}
