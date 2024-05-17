<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/user",
     *      tags={"User"},
     *      summary="get all users",
     *      @OA\Response(
     *          response=200,
     *          description="success"
     *      )
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(User::all(), 200);
    }

    /**
     * @OA\Get(
     *      path="/api/user/{id}",
     *      tags={"User"},
     *      summary="get the user",
     *      @OA\Parameter(
     *          name="id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success"
     *      )
     * )
     * 
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(User::find($id), 200);
    }

    /**
     * @OA\POST(
     *      path="/api/user",
     *      tags={"User"},
     *      summary="create the user",
     *      @OA\Parameter(
     *           name="user",
     *           required=true,
     *           in="query",
     *           @OA\Schema (
     *               type="object",
     *               example={
     *                   "name": "john",
     *                   "age": 30,
     *               }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success"
     *      )
     * )
     * 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    /**
     * @OA\PATCH(
     *      path="/api/user/{id}",
     *      tags={"User"},
     *      summary="update the user",
     *      @OA\Parameter(
     *          name="id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *           name="user",
     *           required=true,
     *           in="query",
     *           @OA\Schema (
     *               type="object",
     *               example={
     *                   "name": "john",
     *                   "age": 30,
     *               }
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success"
     *      )
     * )
     * 
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json($user, 200);
    }

    /**
     * @OA\DELETE(
     *      path="/api/user/{id}",
     *      tags={"User"},
     *      summary="delete the user",
     *      @OA\Parameter(
     *          name="id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success"
     *      )
     * )
     * 
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
        }

        return response()->json($user, 200);
    }
}
