<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //
    private $database;

    public function __construct()
    {
        $this->database = \App\Services\FirebaseService::connect();
    }

    public function create(Request $request)
    {
        $this->database
            ->getReference('employee_table/' . $request['title'])
            ->set([
                'title' => $request['title'] ,
                'content' => $request['content']
            ]);

        return response()->json('blog has been created');
    }

    public function index()
    {
        return response()->json($this->database->getReference('employee_table/')->getValue());
    }

    public function edit(Request $request)
{
    $this->database->getReference('employee_table/' . $request['title'])
        ->update([
            'content/' => $request['content']
        ]);

    return response()->json('blog has been edited');
}

public function delete(Request $request)
{
    $this->database
        ->getReference('employee_table/' . $request['title'])
        ->remove();

    return response()->json('blog has been deleted');
}


}
