<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EmpresaController extends Controller
{

    public function create(Request $request){
        //Validacion de datos
        $mensaje = [
            'empresaName.required' => 'El nombre de la empresa es un campo obligatorio.',
            'empresaName.min' => 'El nombre de la empresa debe tener al menos 2 caracteres.',
            'empresaName.max' => 'El nombre de la empresa admite hasta 100 caracteres.',
            'empresaEmail.required' => 'El email de la empresa es un campo obligatorio.',
            'empresaEmail.email' => 'El email posee un formato incorrecto.',
            'empresaEmail.min' => 'El email de la empresa debe tener al menos 3 caracteres.',
            'empresaEmail.max' => 'El email de la empresa admite hasta 255 caracteres.',
            'empresaWeb' => 'El nombre de la empresa es un campo obligatorio.',
            'empresaWeb.min' => 'El enlace de la web debe tener al menos 3 caracteres.',
            'empresaWeb.max' => 'El enlace de la web admite hasta 255 caracteres.',

            'empresaImg.image' => 'El archivo no corresponde a una imagen'
        ];
        $rules = [
            'empresaName' => 'required|min:2|max:100',
            'empresaImg' => 'image',
            'empresaEmail' => 'required|email|min:3|max:255',
            'empresaWeb' => 'min:3|max:255',
        ];
        $this->validate($request, $rules, $mensaje);

        if(empty($request->file('empresaImg'))) {
            $empresa = new Empresa();
            $empresa->name = $request->input('empresaName');
            $empresa->email = $request->input('empresaEmail');
            $empresa->web = $request->input('empresaWeb');
            $empresa->save();
        }else{
            //guardamos la img en nuestro proyecto
            $file = $request->file('empresaImg');
            $path = storage_path() . '/app/public/img/logos';
            $fileName = uniqid() . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);
            // SI se movio la imagen a la carpeta
            //creamos un registro en la tabla
            if ($moved) {
                $empresa = new Empresa();
                $empresa->logo = $fileName;
                $empresa->name = $request->input('empresaName');
                $empresa->email = $request->input('empresaEmail');
                $empresa->web = $request->input('empresaWeb');
                $empresa->save();
            }
        }
        return back();
    }

    public function update(Request $request, $id){
        //Validacion de datos
        $mensaje = [
            'empresaName.required' => 'El nombre de la empresa es un campo obligatorio.',
            'empresaName.min' => 'El nombre de la empresa debe tener al menos 2 caracteres.',
            'empresaName.max' => 'El nombre de la empresa admite hasta 100 caracteres.',
            'empresaEmail.required' => 'El email de la empresa es un campo obligatorio.',
            'empresaEmail.email' => 'El email posee un formato incorrecto.',
            'empresaEmail.min' => 'El email de la empresa debe tener al menos 3 caracteres.',
            'empresaEmail.max' => 'El email de la empresa admite hasta 255 caracteres.',
            'empresaWeb' => 'El nombre de la empresa es un campo obligatorio.',
            'empresaWeb.min' => 'El enlace de la web debe tener al menos 3 caracteres.',
            'empresaWeb.max' => 'El enlace de la web admite hasta 255 caracteres.',

            'empresaImg.image' => 'El archivo no corresponde a una imagen'
        ];
        $rules = [
            'empresaName' => 'required|min:2|max:100',
            'empresaImg' => 'image',
            'empresaEmail' => 'required|email|min:3|max:255',
            'empresaWeb' => 'min:3|max:255',
        ];

        $this->validate($request, $rules, $mensaje);
        $empresa = Empresa::find($id);

        if(!empty($request->file('empresaImg'))) {                    //si el path no viene vacio
            $fullPath = storage_path() . '/app/public/img/logos/' . $empresa->logo;
            File::delete($fullPath);                                    //se elimina la img anterior

            $file = $request->file('empresaImg');
            $path = storage_path() . '/app/public/img/logos';
            $fileName = uniqid() . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);
                                                                        // y se se mmueve la nueva imagen a la carpeta
            if ($moved) {
                $empresa->logo = $fileName;                             //asignamos el nuevo name a la img
            }
        }
        $empresa->name = $request->input('empresaName');
        $empresa->email = $request->input('empresaEmail');
        $empresa->web = $request->input('empresaWeb');
        $empresa->save();

        return back();
    }

    public function delete($id){
        $empresa = Empresa::find($id);
        $fullPath = storage_path() . '/app/public/img/logos/' . $empresa->logo;
        File::delete($fullPath);   //se elimina la img almacenada
        $empresa->delete(); //DELETE
        return back();
    }
}
