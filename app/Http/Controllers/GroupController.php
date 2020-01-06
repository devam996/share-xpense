<?php

namespace App\Http\Controllers;

use Exception;
use Validator;

use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GroupController extends Controller
{
    public function CreateGroup(Request $request)
    {
        $requestData = $request->all();
        $userId = $request->user->id;

        $validationRules = VALIDATION_DATA["GROUP"]["ADD"]["RULES"];
        $validationMessage = VALIDATION_DATA["GROUP"]["ADD"]["MESSAGES"];

        $validator = Validator::make($requestData, $validationRules, $validationMessage);

        if($validator->fails()){
            $status = 404;
            $response = [
                "message" => $validator->errors()->first()
            ];
        } else {
            try {
                $groupData = $requestData["group"];
            
                $groupMembers = $groupData["members"];

                foreach ($groupMembers as $groupUserId) {
                    $searchUser = User::where('id', $groupUserId)->first();
                    if(!isset($searchUser)){
                        throw new Exception("Group user invalid");
                    }
                }

                $group = new Group;
                $group->fill($groupData);
                $group->created_by = $userId;
                $group->save();

                array_push($groupMembers, $userId);
                $groupUsers = [];

                foreach ($groupMembers as $groupUserId) {
                    $groupUser = new GroupUser;
                    $groupUser->user_id = $groupUserId;
                    $groupUser->group_id = $group->id;
                    $groupUser->save();
                    array_push($groupUsers, $groupUser);
                    unset($groupUser);
                }

                $status = 200;
                $response = [
                    "group" => $group,
                    "groupUsers" => $groupUsers,
                    "message" => "Group successfully created"
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

    public function GetAllGroups(Request $request)
    {
        $userId = $request->user->id;

        try {
            $groupUsers = GroupUser::where("user_id", $userId)
                        ->with('group')
                        ->get();
        
            $groups = [];

            foreach ($groupUsers as $groupUser) {
                array_push($groups, $groupUser["group"]);
            }

            $status = 200;
            $response = [
                "groups" => $groups,
                "message" => "Groups found successfully"
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

    public function GetGroupDetails(Request $request)
    {
        $userId = $request->user->id;
        $groupId = $request->id;

        try {

            $group = Group::where("id", $groupId)
                        ->with("expenses")
                        ->first();

        
            $groupUsers = GroupUser::where("group_id", $groupId)
                        ->with("user")
                        ->get();
        
            foreach ($groupUsers as $index => $groupUser) {
                $groupUsers[$index]["user_name"] = $groupUser["user"]["name"];
                unset($groupUsers[$index]["user"]);
            }

            $group["groupUsers"] = $groupUsers;

            $status = 200;
            $response = [
                "group" => $group,
                "message" => "Group details found successfully"
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
