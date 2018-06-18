<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

abstract class CRUDController extends Controller
{
    /**
     * Get Array with mandatory fields and rules to check.
     */
    abstract protected function getMandatoryModelsFields();
    
    /**
     * Check request's body is valid using rules define in class' constant MANDATORY_MODELS_FIELDS.
     */
    protected function          checkRequestDatas(Request $request)
    {
        try
        {
            $this->validate($request, $this->getMandatoryModelsFields());
        }
        catch (ValidationException $ex)
        {
            return false;
        }
        return true;
    }
    
    /**
     * Fill User model with MANDATORY_MODELS_FIELDS validate in checkRequestDatas.
     */
    protected function          fillMandatoryModelsFields(&$model, $body)
    {
        $fields = array_keys($this->getMandatoryModelsFields());
        foreach ($fields as $field)
        {
            $model->$field = $body[$field];
        }
    }
}