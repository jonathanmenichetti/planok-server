<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'List of tasks']);
    }

    public function store(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'category' => 'nullable|string|max:100',
                'status' => 'nullable|string|in:pending,completed',
            ]);

            // Set default status if not provided
            $request->merge([
                'status' => $request->input('status', 'pending'),
            ]);

            // Create the task
            Task::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'category' => $request->input('category'),
                'status' => $request->input('status', false),
            ]);

            return response()->json(['message' => 'Task created successfully'], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            logger('Error storing task', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'An error occurred while creating the task',
                'error' => $e->getMessage()
            ], 500);
        }
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
