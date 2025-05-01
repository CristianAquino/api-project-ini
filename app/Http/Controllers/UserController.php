<?php

namespace App\Http\Controllers;

use App\DTOs\UserDTO;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::query()
            ->paginate(10);
        $usersDTO = UserDTO::fromPagination($users);
        return response()->json($usersDTO, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function me()
    {
        $user = Auth::user();
        $response = Gate::inspect('view', $user);

        if (!$response->allowed()) {
            return response()->json([
                'message' => $response->message()
            ], Response::HTTP_UNAUTHORIZED);
        }

        $userDTO = UserDTO::fromBaseModel($user);
        return response()->json($userDTO, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
        $user = Auth::user();
        $response = Gate::inspect('view', $user);

        if (!$response->allowed()) {
            return response()->json([
                'message' => $response->message()
            ], Response::HTTP_UNAUTHORIZED);
        }

        User::where('id', $user->id)->delete();
        return response()->json([
            'message' => 'User deleted successfully'
        ], Response::HTTP_ACCEPTED);
    }
}
