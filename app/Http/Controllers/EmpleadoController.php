<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function create(Request $request){
        $mensaje = [
            'empleadoName.required' => 'El nombre del empleado es un campo obligatorio.',
            'empleadoName.min' => 'El nombre del empleado debe tener al menos 2 caracteres.',
            'empleadoName.max' => 'El nombre del empleado admite hasta 100 caracteres.',
            'empleadoSurname.required' => 'El apellido del empleado es un campo obligatorio.',
            'empleadoSurname.min' => 'El apellido del empleado debe tener al menos 2 caracteres.',
            'empleadoSurname.max' => 'El apellido del empleado admite hasta 100 caracteres.',
            'empleadoEmail.required' => 'El email del empleado es un campo obligatorio.',
            'empleadoEmail.email' => 'El email posee un formato incorrecto.',
            'empleadoEmail.min' => 'El email del empleado debe tener al menos 3 caracteres.',
            'empleadoEmail.max' => 'El email del empleado admite hasta 255 caracteres.',
            'empleadoPhone.required' => 'El numero de tel es un campo obligatorio.',
            'empleadoPhone.min' => 'El numero de tel debe tener al menos 3 caracteres.',
            'empleadoPhone.max' => 'El numero de tel admite hasta 50 caracteres.',
        ];
        $rules = [
            'empleadoName' => 'required|min:2|max:100',
            'empleadoSurname' => 'required|min:2|max:100',
            'empleadoEmail' => 'required|email|min:3|max:255',
            'empleadoPhone' => 'required|min:3|max:50',
        ];
        $this->validate($request, $rules, $mensaje);
        $empleado = new Empleado();
        $empleado->name = $request->input('empleadoName');
        $empleado->surname = $request->input('empleadoSurname');
        $empleado->empresa_id = $request->input('empleadoEmpresa');
        $empleado->email = $request->input('empleadoEmail');
        $empleado->phone = $request->input('empleadoPhone');
        $empleado->save();
        return back();
    }

    public function update(Request $request, $id){
        $mensaje = [
            'empleadoName.required' => 'El nombre del empleado es un campo obligatorio.',
            'empleadoName.min' => 'El nombre del empleado debe tener al menos 2 caracteres.',
            'empleadoName.max' => 'El nombre del empleado admite hasta 100 caracteres.',
            'empleadoSurname.required' => 'El apellido del empleado es un campo obligatorio.',
            'empleadoSurname.min' => 'El apellido del empleado debe tener al menos 2 caracteres.',
            'empleadoSurname.max' => 'El apellido del empleado admite hasta 100 caracteres.',
            'empleadoEmail.required' => 'El email del empleado es un campo obligatorio.',
            'empleadoEmail.email' => 'El email posee un formato incorrecto.',
            'empleadoEmail.min' => 'El email del empleado debe tener al menos 3 caracteres.',
            'empleadoEmail.max' => 'El email del empleado admite hasta 255 caracteres.',
            'empleadoPhone.required' => 'El numero de tel es un campo obligatorio.',
            'empleadoPhone.min' => 'El numero de tel debe tener al menos 3 caracteres.',
            'empleadoPhone.max' => 'El numero de tel admite hasta 50 caracteres.',
        ];
        $rules = [
            'empleadoName' => 'required|min:2|max:100',
            'empleadoSurname' => 'required|min:2|max:100',
            'empleadoEmail' => 'required|email|min:3|max:255',
            'empleadoPhone' => 'required|min:3|max:50',
        ];
        $this->validate($request, $rules, $mensaje);
        $empleado = Empleado::find($id);
        $empleado->name = $request->input('empleadoName');
        $empleado->surname = $request->input('empleadoSurname');
        $empleado->empresa_id = $request->input('empleadoEmpresa');
        $empleado->email = $request->input('empleadoEmail');
        $empleado->phone = $request->input('empleadoPhone');
        $empleado->save();
        return back();
    }

    public function delete($id){
        $empleado = Empleado::find($id);
        $empleado->delete(); //DELETE
        return back();
    }
}
