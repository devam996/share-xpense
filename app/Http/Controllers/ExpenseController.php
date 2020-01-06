<?php

namespace App\Http\Controllers;

use Exception;
use Validator;

use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Expense;
use App\Models\ExpenseSplit;
use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExpenseController extends Controller
{
    
    public function CreateGroupExpenses(Request $request)
    {
        $requestData = $request->all();
        $userId = $request->user->id;
        $groupId = $request->id;

        $validationRules = VALIDATION_DATA["EXPENSE"]["ADD"]["RULES"];
        $validationMessage = VALIDATION_DATA["EXPENSE"]["ADD"]["MESSAGES"];

        $validator = Validator::make($requestData, $validationRules, $validationMessage);

        if($validator->fails()){
            $status = 404;
            $response = [
                "message" => $validator->errors()->first()
            ];
        } else {
            try {
                $expenseData = $requestData["expense"];
                $expenseMembers = $expenseData["members"];

                $expense = new Expense;
                $expense->fill($expenseData);
                $expense->split_numbers = sizeof($expenseMembers) + 1;            
                $expense->recepient_id = $userId;
                $expense->group_id = $groupId;
                $expense->save();          

                array_push($expenseMembers, $userId);
                $expenseSplitAmount = round($expense->amount / $expense->split_numbers, 2);
                
                foreach ($expenseMembers as $expenseMemberId) {
                    $groupUser = GroupUser::where(["user_id" => $expenseMemberId, "group_id" => $groupId])->first();
                    if(!isset($groupUser)){
                        $expense->delete();
                        throw new Exception("Invalid member added to expense");
                    }

                    $expenseSplit = new ExpenseSplit;
                    $expenseSplit->amount = $expenseSplitAmount;
                    $expenseSplit->expense_id = $expense->id;
                    $expenseSplit->group_user_id = $groupUser->id;
                    $expenseSplit->recepient_paid = $userId;
                    $expenseSplit->user_id = $expenseMemberId;
                    $expenseSplit->paid_amount = 0;

                    if($expenseMemberId == $userId){
                        $expenseSplit->paid_amount = $expenseSplitAmount;
                        $groupUser->amount_paid = $groupUser->amount_paid + $expenseSplitAmount;
                        $groupUser->amount_owe = $groupUser->amount_owe + $expenseSplitAmount * ($expense->split_numbers - 1);
                        
                    } else {
                        $groupUser->amount_due = $expenseSplitAmount;
                    }

                    $groupUser->save();
                    $expenseSplit->save();

                    unset($groupUser);
                    unset($expenseSplit);
                }

                $status = 200;
                $response = [
                    "expense" => $expense,
                    "message" => "Expesnse created successfuly"
                ];

            }  catch (Exception $e){
                $status = 500;
                $response = [
                    "exception" => $e,
                    "message" => $e->getMessage()
                ];
            }
        }  
        
        return response($response, $status);
    }

    public function SettleGroupExpenses(Request $request)
    {
        $requestData = $request->all();
        $userId = $request->user->id;
        $groupId = $request->id;

        $validationRules = VALIDATION_DATA["EXPENSE"]["ADD"]["RULES"];
        $validationMessage = VALIDATION_DATA["EXPENSE"]["ADD"]["MESSAGES"];

        $validator = Validator::make($requestData, $validationRules, $validationMessage);

        if($validator->fails()){
            $status = 404;
            $response = [
                "message" => $validator->errors()->first()
            ];
        } else {
            try {
                
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
}
