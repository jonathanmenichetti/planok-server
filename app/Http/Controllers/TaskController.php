<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
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
                'status' => $request->input('status', false),
            ]);

            return response()->json([
                'message' => 'Task created successfully',
                'data' => [
                    'task' => Task::latest()->first(),
                ],
            ], 201);
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

    public function update(Request $request, $id)
    {
        try {
            $task = Task::findOrFail($id);

            // Validate the request data
            $request->validate([
                'title' => 'sometimes|required|string|max:255',
                'description' => 'sometimes|nullable|string',
                'status' => 'sometimes|nullable|string|in:pending,completed',
            ]);

            // Update the task
            $task->update($request->only(['title', 'description', 'status']));

            return response()->json([
                'message' => 'Task updated successfully',
                'data' => [
                    'task' => $task,
                ],
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            logger('Error updating task', ['error' => $e->getMessage()]);
            return response()->json([
                'message' => 'An error occurred while updating the task',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json([
            'message' => 'Task deleted successfully',
        ]);
    }
}
