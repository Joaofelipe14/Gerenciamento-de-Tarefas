<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;

class TaskController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = Auth::user();

            $tasks = Task::where('user_id', $user->id)->get();
        
            return $this->sendResponse($tasks, 'Tasks found');
        } catch (\Exception $e) {
            return $this->sendError('error', ['error' => 'Failed to fetch tasks'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'user_id' => 'required|exists:users,id'
            ]);

            $task = Task::create($request->all());
            return response()->json($task, 201);

            return $this->sendResponse($task, 'Task registered successfully.');
        } catch (ValidationException $e) {
            return $this->sendError('error', ['error' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            return $this->sendError('error', ['error' => 'Failed to create task'], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        try {
            $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'user_id' => 'required|exists:users,id'
            ]);

            $task->update($request->all());
            return $this->sendResponse($task, 'Task update successfully.');

        } catch (ValidationException $e) {
            return $this->sendError('error', ['error' => $e->getMessage()], 422);
        } catch (ModelNotFoundException $e) {
            return $this->sendError('error', ['error' => 'Task not found'], 404);
        } catch (\Exception $e) {
            return $this->sendError('error', ['error' => 'Failed to update task'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            $task->delete();
            return $this->sendResponse($task, 'Task delete successfully.');
        } catch (ModelNotFoundException $e) {
            return $this->sendError('error', ['error' => 'Task not found'], 404);
        } catch (\Exception $e) {
            return $this->sendError('error', ['error' => 'Failed to delete task'], 400);

        }
    }
}
