<?php

namespace App\Http\Controllers;

use App\Models\Bug;
use Faker\Generator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BugController extends Controller
{
    public function create(Generator $generator)
    {
        $bug = new Bug();
        $bug->name = $generator->lexify('???????');
        $bug->color = $generator->boolean? 'red' : 'green';
        $bug->save();

        return response($bug->jsonSerialize(), Response::HTTP_CREATED);
    }

    public function index()
    {
        return response(Bug::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $bug = Bug::findOrFail($id);
        $bug->color = $request->color;
        $bug->save();

        return \response(null, Response::HTTP_OK);
    }

    public function delete($id)
    {
        Bug::destroy($id);

        return response(null, Response::HTTP_OK);
    }
}
