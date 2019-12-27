<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Validator;
use \Firebase\JWT\JWT;

use App\Models\User;

class AuthController extends Controller
{
    public function Register(Request $request)
    {
        $status = 500;
        $requestData = $request->all();

        $validationRules = VALIDATION_DATA["AUTH"]["REGISTER"]["RULES"];
        $validationMessage = VALIDATION_DATA["AUTH"]["REGISTER"]["MESSAGES"];

        $validator = Validator::make($requestData, $validationRules, $validationMessage);

        if($validator->fails()){
            $status = 404;
            $response = [
                "message" => $validator->errors()->first()
            ];
        } else {
            $userData = $requestData["user"];

            $user = new User;
            $user->fill($userData);
            $user->password = bcrypt($userData["password"]);
            $user->save();

            $token = [
                "uid" => $user->id,
                "email" => strtolower($user->email),
                "name" => $user->name
            ];

            $jwt = JWT::encode($token, JWT_KEY);

            $status = 200;
            $response = [
                "token" => $jwt,
                "message" => "User created successfully"
            ];            
        }

        return response($response, $status);
    }

    public function Login(Request $request)
    {
        $status = 500;
        $requestData = $request->all();

        $validationRules = VALIDATION_DATA["AUTH"]["LOGIN"]["RULES"];
        $validationMessage = VALIDATION_DATA["AUTH"]["LOGIN"]["MESSAGES"];

        $validator = Validator::make($requestData, $validationRules, $validationMessage);

        if($validator->fails()){
            $status = 404;
            $response = [
                "message" => $validator->errors()->first()
            ];
        } else {
            $userData = $requestData["user"];

            $user = User::where("email", $userData["email"])
                        ->first();
            
            if(!password_verify($userData["password"], $user["password"])){
                $status = 401;
                $response = [
                    "message" => "Password entered is incorrect"
                ];
            } else {
                unset($user["password"]);

                $token = [
                    "uid" => $user["id"],
                    "email" => strtolower($user["email"]),
                    "name" => $user["name"],
                ];
    
                $jwt = JWT::encode($token, JWT_KEY);
    
                $status = 200;
                $response = [
                    "token" => $jwt,
                    "message" => "Login successfull"
                ];
            }
        }

        return response($response, $status);
    }
}
