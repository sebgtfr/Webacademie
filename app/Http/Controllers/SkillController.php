<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ORM\Skill;

class SkillController extends CRUDController
{    
    /**
     * CF: CRUDController
     */
    protected function getMandatoryModelsFields()
    {
        return array
        (
            "note" => "required|numeric|min:0|max:5",
            "name" => "required",
            "type" => "required",
            "userId" => "required|numeric|min:1",
        );
    }
    
    /**
     * Read Skill from the database by Id
     */
    public function             show($id)
    {
        $skill = Skill::find($id, ['note', 'name', 'type', 'userId']);
        return (empty($skill)) ? response()->json("Skill not found", 404) : response()->json($skill, 200);
    }
    
    /**
     * Create User into the database
     */
    public function             create(Request $request)
    {
        if ($this->checkRequestDatas($request) !== true /*|| !UserController::userExist($request->input('userId'))*/)
        {
            return response()->json('Invalid input', 405);
        }
        
        $skill = new Skill;
        $this->fillMandatoryModelsFields($skill, $request->all());
        
        $skill->save();
        return response()->json('Skill added sucessfully', 200);
    }
    
    /**
     * Update Skill into the database
     */
    public function             update(Request $request, $id)
    {
        if ($this->checkRequestDatas($request) !== true /*|| !UserController::userExist($request->input('userId'))*/)
        {
            return response()->json('Invalid input', 405);
        }
 
        $skill = Skill::find($id);
        if (empty($skill))
        {
            return response()->json("Skill not found", 404);
        }
        
        $this->fillMandatoryModelsFields($skill, $request->all());
        $skill->save();

        return response()->json('Project updated', 200);
    }
    
    /**
     * Delete Skill into the database
     */
    public function             delete($id)
    {
        $skill = Skill::find($id);
        if (empty($skill))
        {
            return response()->json("Skill not found", 404);
        }
        $skill->delete();
        return response()->json('Skill deleted', 200);
    }
}