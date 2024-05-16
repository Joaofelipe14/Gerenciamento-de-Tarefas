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
     * @OA\SecurityScheme(
     *    securityScheme="bearerAuth",
     *    in="header",
     *    name="Authorization",
     *    type="http",
     *    scheme="bearer",
     *    bearerFormat="JWT",
     * )
     * Retrieve tasks for the authenticated user.
     * @OA\Get(
     *     path="/api/tasks",
     *     summary="Retrieve tasks",
     *     description="Endpoint to retrieve tasks for the authenticated user.",
     *     tags={"Task"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\Parameter(
     *         name="Content-Type",
     *         in="header",
     *         required=true,
     *         description="Tipo de conteúdo da solicitação",
     *         @OA\Schema(
     *             type="string",
     *             example="multipart/form-data;"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tasks retrieved successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             example={
     *                 "data": {
     *                     {
     *                         "id": 1,
     *                         "title": "Task 1",
     *                         "description": "Description of task 1",
     *                         "created_at": "2024-05-15 10:00:00",
     *                         "updated_at": "2024-05-15 10:00:00"
     *                     },
     *                     {
     *                         "id": 2,
     *                         "title": "Task 2",
     *                         "description": "Description of task 2",
     *                         "created_at": "2024-05-15 11:00:00",
     *                         "updated_at": "2024-05-15 11:00:00"
     *                     }
     *                 },
     *                 "message": "Tasks found"
     *             }
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="No content"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */

    public function index()
    {
        try {
            $user = Auth::user();

            $tasks = Task::where('user_id', $user->id)->get();
            if ($tasks->isEmpty()) {
                return $this->sendResponse('', 'No tasks found for this user.');
            }
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
     * Store a newly created task.
     *
     * @OA\Post(
     *     path="/api/tasks",
     *     summary="Store a task",
     *     description="Endpoint to store a new task.",
     *     tags={"Task"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Task data",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     example="Task title"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string",
     *                     example="Task description"
     *                 ),
     *                 @OA\Property(
     *                     property="user_id",
     *                     type="integer",
     *                     format="int64",
     *                     example="1"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Task created successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity"
     *     )
     * )
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
     * Update an existing task.
     *
     * @OA\Put(
     *     path="/api/tasks/{id}",
     *     summary="Update a task",
     *     description="Endpoint to update an existing task.",
     *     tags={"Task"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Task ID",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Task data",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     example="Updated task title"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string",
     *                     example="Updated task description"
     *                 ),
     *                 @OA\Property(
     *                     property="user_id",
     *                     type="integer",
     *                     format="int64",
     *                     example="1"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task updated successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="error",
     *                 type="string",
     *                 description="Error message"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Unprocessable Entity",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="error",
     *                 type="string",
     *                 description="Error message"
     *             )
     *         )
     *     )
     * )
     */
    public function update(Request $request, Task $task)
    {
        try {
            $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                // 'user_id' => 'required|exists:users,id'
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
     * Delete a task.
     *
     * @OA\Delete(
     *     path="/api/tasks/{id}",
     *     summary="Delete a task",
     *     description="Endpoint to delete a task.",
     *     tags={"Task"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Task ID",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad Request"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found")
     * 
     * )
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
