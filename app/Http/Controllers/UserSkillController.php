<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ORM\User;
use App\ORM\Skill;

class UserSkillController extends Controller
{
    /**
     * Read Skill from the database by User ID
     */
    public function             showSkillByUserID($id)
    {
        if (UserController::userExist($id))
        {
            $skills = Skill::where('userId', $id)->get(['note', 'name', 'type', 'userId']);
            return ($skills->isEmpty()) ? response()->json("Skill not found", 404) : response()->json($skills, 200);
        }
        return response()->json('User not found', 404);
    }
    
    public function             showUserByTypeOrNameSkill($type, $note = -1)
    {
        $request = Skill::where(function ($query) use ($type)
        {
            return $query->where('type', $type)->orWhere('name', $type);
        });                
        if ($note != -1)
        {
            $request = $request->where('note', $note);
        }
        
        $usersId = array_values($request->groupBy('userId')->get(['userId'])->toArray());
        if (empty($usersId))
        {
            return response()->json('Invalid parameters supplied', 400);
        }
        $users = User::find($usersId);        

        return ($users->isEmpty()) ? response()->json('User not found', 404) : response()->json($users, 200);
    }
}