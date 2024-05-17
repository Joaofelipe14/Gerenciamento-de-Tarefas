<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class UserController extends BaseController
{
    /**
     * Register a new user.
     *
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register a new user",
     *     description="Endpoint to register a new user.",
     *     tags={"User"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="User data",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="name",
     *                     description="User's name",
     *                     type="string",
     *                     example="joao"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     description="User's email address",
     *                     type="string",
     *                     format="email",
     *                     example="joao@example.com"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     description="User's password",
     *                     type="string",
     *                     format="password",
     *                     example="admin1234"
     *                 ),
     *                 @OA\Property(
     *                     property="c_password",
     *                     description="Confirm password",
     *                     type="string",
     *                     format="password",
     *                     example="admin1234"
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *     response=200,
     *     description="User create User register successfully."
     *     ),
     * @OA\Response(
     *     response=500,
     *     description="Validation error or missing data",
     * )


     * )

     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'c_password' => 'required|same:password',
            ]);

            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $success['token'] =  $user->createToken('TaskApi')->plainTextToken;
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User register successfully.');
        } catch (\Exception $e) {
            return $this->sendError('error', ['error' => 'Error when registering user'], 500);
        }
    }

    /**
     * Login a user.
     *
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login a user",
     *     description="Endpoint to login a user.",
     *     tags={"User"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="User credentials",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="email",
     *                     description="User's email address",
     *                     type="string",
     *                     format="email",
     *                     example="Joao@gmail.com"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     description="User's password",
     *                     type="string",
     *                     format="password",
     *                     example="admin"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User logged in successfully"
     *     ),
     *      @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     * )
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('TaskApi')->plainTextToken;
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User login successfully.');
        } else {
            return $this->sendError('Unauthorized.', ['error' => 'Unauthorized'],401);
        }
    }

    /**

     * Retrieve tasks for the authenticated user.
     * @OA\Get(
     *     path="/api/me",
     *     summary="Retrieve tasks",
     *     description="Endpoint to retrieve tasks for the authenticated user.",
     *     tags={"User"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\Parameter(
     *         name="Content-Type",
     *         in="header",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             example="multipart/form-data;"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tasks retrieved successfully"
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

    public function me()
    {
        $user = Auth::user();

        if ($user) {
            return $this->sendResponse($user, 'Info user');
        } else {
            return $this->sendError('Unauthorized.', ['error' => 'Unauthorized'],401);
        }
    }
}
