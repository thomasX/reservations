<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class ScrollController extends Controller
{
    //
    /**
     * Store a newly created resource in storage.
     */
    public function findFirst(Request $request) {
        $users = DB::select('select * from users');
        return $users;
    }
}
