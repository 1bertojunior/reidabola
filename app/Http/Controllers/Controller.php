<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getDataWithByAttribute($class = null, $attribute = array(), $model = null){
        return $class->selectRaw($attribute)->with($model)->get();
    }

    protected function getAllDataWith($class = null, $model = null){
        return $class->with($model)->get();
    }
    
}
