<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\ORM\User;

class UserController extends CRUDController
{
    /**
     * CF: CRUDController
     */
    protected function getMandatoryModelsFields()
    {
        return array
        (
            "email" => "required|email",
            "firstName" => "required",
            "lastName" => "required",
            "description" => "required",
            "salaryClaims" => "required|numeric|min:10"
        );
    }

    /**
     * Read User from the database By Id or all.
     */
    public function             show($id = -1)
    {
        $user = ($id == -1) ? User::all() : User::find($id);
        return (empty($user) || ($id == -1 && $user->isEmpty())) ? response()->json("User not found", 404) : response()->json($user, 200);
    }

    /**
     * Create User into the database
     */
    public function             create(Request $request)
    {
        if ($this->checkRequestDatas($request) !== true)
        {
            return response()->json('Invalid data', 400);
        }
        
        $user = new User;
        $this->fillMandatoryModelsFields($user, $request->all());
        
        try
        {
            $user->save();
        }
        catch (QueryException $ex)
        {
            return response()->json('User already exist', 401);
        }
        
        return response()->json('successful operation', 200);
    }
    
    /**
     * Update User into the database
     */
    public function             update(Request $request, $id)
    {
        if ($this->checkRequestDatas($request) !== true)
        {
            return response()->json('Invalid data supplied', 400);
        }
 
        $user = User::find($id);
        if (empty($user))
        {
            return response()->json("User not found", 404);
        }
        
        $this->fillMandatoryModelsFields($user, $request->all());
        try
        {
            $user->save();
        }
        catch (QueryException $ex)
        {
            return response()->json('User already exist', 401); // ??
        }
        return response()->json('User updated', 200);
    }
    
    /**
     * Delete User into the database
     */
    public function             delete($id)
    {
        $user = User::find($id);
        if (empty($user))
        {
            return response()->json("User not found", 404);
        }
        $user->delete();
        return response()->json('User deleted', 200);
    }
    
    static public function      userExist($id)
    {
        return (User::where('id', $id)->count() > 0);
    }
}