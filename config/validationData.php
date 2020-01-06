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
                    "user.name.required" => "Name of user is required for registration",
                    "user.password.required" => "Password is required for registration",
                    "user.password.min" => "Minimum 6 Characters for Password is required for registration",
                    "user.password.max" => "Maximum 25 Characters for Password are allowed for registration",
                    "user.email.required" => "Email of user is required for registration",
                    "user.email.regex" => "Email of user is Invalid for registration",
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
                    "category.title.required" => "Title is required to create a category",
                    "category.title.max" => "Title of category is too long, maximum 25 characters allowed",
                    "category.title.min" => "Title of category is too short, minimum 3 characters required",
                ]
            ],
        ],
        "GROUP" => [
            "ADD" => [
                "RULES" => [
                    "group.name" => "bail|required|max:25|min:3",
                    "group.members" => "bail|required|array|min:1"
                ],
                "MESSAGES" => [
                    "group.name.required" => "Title is required to create a group",
                    "group.name.max" => "Title of group is too long, maximum 25 characters allowed",
                    "group.name.min" => "Title of group is too short, minimum 3 characters required",
                    "group.members.required" => "Minimum 2 members are required to create a group",
                    "group.members.array" => "Members information is invalid to create a group",
                    "group.members.min" => "Minimum 2 members are required to create a group"
                ]
            ],
        ],

        "EXPENSE" => [
            "ADD" => [
                "RULES" => [
                    "expense.amount" => "bail|required|numeric|min:1",
                    "expense.category_id" => "bail|required|exists:categories,id",
                    "expense.members" => "bail|required|array|min:1"
                ],
                "MESSAGES" => [
                    "expense.amount.required" => "Amount is required for adding expense",
                    "expense.amount.numeric" => "Amount  is invalid for adding expense",
                    "expense.amount.min" => "Minimum amount for adding expense is 1",
                    "expense.category_id.required" => "Category is required for adding expense",
                    "expense.category_id.exists" => "Category  is invalid for adding expense",
                    "expense.members.required" => "Members are required to create a expense",
                    "expense.members.array" => "Members information is invalid to create a expense",
                    "expense.members.min" => "Minimum 2 members are required to create a expense"                    
                ]
            ]
        ]
    ]
);
