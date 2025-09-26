<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function all(){
        $registros = Region::get();
        return $registros;
    }
}
