<?php

define("VALIDATION_DATA", 
    [
        "AUTH" => [
            "LOGIN" => [
                "RULES" => [
                    "user.email" => "bail|required|max:255|exists:users,email",
                    "user.password" => "bail|required|min:6|max:25"
                ],
                "MESSAGES" => [
                    "user.email.required" => "Email is required for login",
                    "user.email.exists" => "User for this email don't exists",
                    "user.password.required" => "Password is required for login",
                    "user.password.min" => "Minimum 6 Characters for Password is required",
                    "user.password.max" => "Password is too long",
                ]
            ],
            "REGISTER" => [
                "RULES" => [
                    "user.name" => "bail|required|max:255",
                    "user.email" => "bail|required|regex:/\S+@\S+\.\S+/|unique:users,email|max:255",
                    "user.password" => "bail|required|min:6|max:25",
                ],
                "MESSAGES" => [
                    "user.name.required" => "Name is required for registration",
                    "user.password.required" => "Password is required for registration",
                    "user.password.min" => "Minimum 6 Characters for Password is required for registration",
                    "user.password.max" => "Maximum 25 Characters for Password are allowed",
                    "user.email.required" => "Email is Required for registration",
                    "user.email.regex" => "Email is Invalid",
                    "user.email.unique" => "User already exists with this email"
                ]
            ]
        ],
        "CATEGORY" => [
            "ADD" => [
                "RULES" => [
                    "category.title" => "bail|required|max:25|min:3",  
                ],
                "MESSAGES" => [
                    "category.title.required" => "Title of category is required",
                    "category.title.max" => "Title of category is too long, maximum 25 characters allowed",
                    "category.title.min" => "Title of category is too short, minimum 3 characters required",
                ]
            ],
        ]
    ]
);
