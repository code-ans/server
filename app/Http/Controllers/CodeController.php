<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    public function search ()
    {
        return DB::table('code')->get();
    }
}
