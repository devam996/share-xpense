<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Validator;

use App\Models\User;
use App\Models\Category;


class CategoryController extends Controller
{
    public function CreateCategory(Request $request)
    {
        $status = 500;
        $requestData = $request->all();

        $validationRules = VALIDATION_DATA["CATEGORY"]["ADD"]["RULES"];
        $validationMessage = VALIDATION_DATA["CATEGORY"]["ADD"]["MESSAGES"];

        $validator = Validator::make($requestData, $validationRules, $validationMessage);

        if($validator->fails()){
            $status = 404;
            $response = [
                "message" => $validator->errors()->first()
            ];
        } else {
            $categoryData = $requestData["category"];

            $category = new Category;
            $category->fill($categoryData);
            $category->created_by = $request->user->id;
            $category->save();

            $status = 200;
            $response = [
                "message" => "Category successfully created",
                "category" => $category
            ];
        }

        return response($response, $status);
    }
}
