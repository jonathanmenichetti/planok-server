<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'List of tasks']);
    }

    public function store(Request $request)
    {
        // Logic to create a new task
    }

    public function show($id)
    {
        // Logic to show a specific task
    }

    public function update(Request $request, $id)
    {
        // Logic to update a specific task
    }

    public function destroy($id)
    {
        // Logic to delete a specific task
    }
}
