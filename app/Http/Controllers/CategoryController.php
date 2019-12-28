<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Validator;
use Exception;

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

            try {
                $category = new Category;
                $category->fill($categoryData);
                $category->created_by = $request->user->id;
                $category->save();

                $status = 200;
                $response = [
                    "message" => "Category successfully created",
                    "category" => $category
                ];
            } catch (Exception $e){
                $status = 500;
                $response = [
                    "exception" => $e,
                    "message" => $e->getMessage()
                ];
            }
            
        }

        return response($response, $status);
    }

    public function GetAllCategories(Request $request)
    {
        try {
            $categories = Category::get()->toArray();

            $status = 200;
            $response = [
                "message" => "Listing all the categories",
                "categories" => $categories
            ];
        } catch (Exception $e){
            $status = 500;
            $response = [
                "exception" => $e,
                "message" => $e->getMessage()
            ];
        }
        
        return response($response, $status); 
    }
}
