<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ORM\Project;

class ProjectController extends CRUDController
{
    /**
     * CF: CRUDController
     */
    protected function getMandatoryModelsFields()
    {
        return array
        (
            "languages" => "required|json",
            "name" => "required",
            "descriptive" => "required",
            "links" => "required|json",
            "userId" => "required|numeric|min:1"
        );
    }
    
    /**
     * Read Project from the database By Id or all.
     */
    public function             show($id = -1)
    {
        $project = ($id == -1) ? Project::all() : Project::find($id);
        return (empty($project) || ($id == -1 && $project->isEmpty())) ? response()->json("Projects not found", 404) : response()->json($project, 200);
    }
    
    /**
     * Create Project into the database
     */
    public function             create(Request $request)
    {
        if ($this->checkRequestDatas($request) !== true /*|| !UserController::userExist($request->input('userId'))*/)
        {
            return response()->json('Invalid input', 405);
        }
        
        $project = new Project;
        $this->fillMandatoryModelsFields($project, $request->all());
        $project->save();
        
        return response()->json('Project added', 200);
    }
    
    /**
     * Update Project into the database
     */
    public function             update(Request $request, $id)
    {
        if ($this->checkRequestDatas($request) !== true /*|| !UserController::userExist($request->input('userId'))*/)
        {
            return response()->json('Invalid input', 405);
        }
 
        $project = Project::find($id);
        if (empty($project))
        {
            return response()->json("Project not found", 404);
        }
        
        $this->fillMandatoryModelsFields($project, $request->all());
        $project->save();

        return response()->json('Project updated', 200);
    }
    
    /**
     * Delete Project into the database
     */
    public function             delete($id)
    {
        $project = Project::find($id);
        if (empty($project))
        {
            return response()->json("Project not found", 404);
        }
        $project->delete();
        return response()->json('Project deleted', 200);
    }
}