<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\User;
//use App\Helpers\JwtAuth;

class UserController extends Controller
{
    public function pruebas(Request $request){
        return "Accion de pruebas de USER";
    }

    public function register(Request $request){

        //Recoger los datos del usuario
        $json = $request->input('json', null);

        $params = json_decode($json);  //Object
        $params_array = json_decode($json, true);  //array 

        if(!empty($params_array && $params)){

            // Limpiar datos
            $params_array = array_map('trim', $params_array);

            //Validar datos
            $validate = \Validator::make($params_array,[
                'name'      => 'required|alpha',
                'surname'  => 'required|alpha',
                'email'     => 'required|email|unique:users',     //Comprobar si el usuario existe
                'password' => 'required',

            ]);       

            if ($validate->fails()) {
                // La validacion ha fallado
                $data = array(
                    'status' => 'error',
                    'code ' => 404,
                    'message' => 'El usuario no se ha creado correctamente',
                    'errors' => $validate->errors()    
                );            
            }else{

                // Validacion pasada correctamente
                        
                //Cifrar la contraseña
                $pwd = hash('sha256',$params->password);

                //Crear el usuario
                $user = new User();
                $user->name = $params_array['name'];
                $user->surname = $params_array['surname'];
                $user->email = $params_array['email'];
                $user->password = $pwd;
                $user->role ='ROLE_USER';
                // Guardar el usuario
                $user->save();

                $data = array(
                    'status' => 'success',
                    'code ' => 200,
                    'message' => 'El usuario se ha creado correctamente',
                    'user' => $user
                    
                );   
            }
         }else {

            $data = array(
                'status' => 'error',
                'code ' => 404,
                'message' => 'Los datos enviados no son correctos',                
            ); 
         }
              
        return response()->json($data);

    }

    public function login(Request $request){

        $jwtAuth = new \App\Helpers\JwtAuth;

      
        // Recibir datos por POST
        $json = $request->input('json', null);
        $params = json_decode($json);
        $params_array = json_decode($json, true);

        

        //Validar datos
        $validate = \Validator::make($params_array,[
            'email'     => 'required|email',     //Comprobar si el usuario existe
            'password' =>  'required',

        ]);       

        if ($validate->fails()) {
            // La validacion ha fallado
            $signup = array(
                'status' => 'error',
                'code ' => 404,
                'message' => 'El usuario no se ha podido identificar',
                'errors' => $validate->errors()    
            );            
        }else{
            // Cifrar la password
            $pwd = hash('sha256', $params->password);
            // Devolver token o datos
            $signup = $jwtAuth->signup($params->email, $pwd);

            if(!empty($params->gettoken)){
                $signup = $jwtAuth->signup($params->email, $pwd, true);
            }      

        }
        return response()->json($signup,200);
    } 

    public function update(Request $request){
             

        //Recoger los datos por post
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        var_dump($params_array);
        die();

        if ($checkToken && !empty($params_array)){

            //Actualizar usuario
            

            // Sacar usuario identificado
            $user = $jwtAuth->checkToken($token, true);
         

            // validar los datos
            $validate = \Validator::make($params_array,[
                'name'      => 'required|alpha',
                'surname'  => 'required|alpha',
                'email'     => 'required|email|unique:users'. $user->sub,     //Comprobar si el usuario existe
               ]);   

            // Quitar los campos que no quiero actualizar
            unset($params_array['id']);
            unset($params_array['role']);
            unset($params_array['password']);
            unset($params_array['created_at']);
            unset($params_array['remember_token']);

            //Actualizar usuario en bd
            $user_update = User::where('id', $user->sub)->update($params_array);

            $data = array(
                'code' => 200,
                'status' => 'success',
                'user' => $user_update,
                'changes' => $params_array

            );


        }else{
            $data = array(
                'code' => 400,
                'status' => 'error',
                'message' => 'El usuario no esta identificado'
            );
        }

        return response()->json($data, $data['code']);


    }
   
    public function upload(Request $request){

        // Recoger los datos
        $image = $request->file('file0');

        // Validar imagen

        $validate = \Validator::make($request->all(), [
            'file0' => 'required|image|mimes:jpg, jpeg,png,gif',
        ]);




        // Guardar imagen
        if (!$image || $validate->fails()){
            $data = array(
                'code' => 400,
                'status' => 'error',
                'message' => 'Error al subir imagen'
            );    
           
        }else{
            $image_name = time().$image->getClientOriginalName();
            \Storage::disk('users')->put($image_name, \File::get($image));

            $data = array(
                'code' => 200,
                'status' => 'success',
                'image' => $image_name
            );
        }


        // Devolver los resultados       
     
        return response()->json($data, $data['code']);


    }

    public function getImage($filename){

        $isset = \Storage::disk('users')->exists($filename);
        
        if ($isset){
            $file = \Storage::disk('users')->get($filename);
            return new Response($file, 200);
        }else{
            $data = array(
                'code' => 404,
                'status' => 'error',
                'message' => 'La imagen no existe'
            );

            return response()->json($data, $data['code']);
        }

       

    }

    public function detail($id){

        $user = User::find($id);

        if (is_object($user)){
            $data = array(
                'code' => 200,
                'status' => 'success',
                'user' => $user
            );
            

        }else{

            $data = array(
                'code' => 404,
                'status' => 'error',
                'message' => 'El usuario NO existe'
            );
            

        }

        return response()->json($data, $data['code']);



    }

    
    }

