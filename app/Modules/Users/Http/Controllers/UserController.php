<?php

namespace App\Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Users\Application\DTO\UserDTO;
use App\Modules\Users\Application\UseCases\DeleteUserUseCase;
use App\Modules\Users\Application\UseCases\FindByIdUseCase;
use App\Modules\Users\Application\UseCases\GetAllUsersUseCase;
use App\Modules\Users\Application\UseCases\CreateUserUseCase;
use App\Modules\Users\Application\UseCases\UpdateUserUseCase;
use App\Modules\Users\Domain\Exceptions\Exceptions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller {


    public function __construct(
        private FindByIdUseCase $findByIdUseCase,
        private GetAllUsersUseCase $getAll,
        private CreateUserUseCase $createUserUseCase,
        private UpdateUserUseCase $updateUserUseCase,
        private DeleteUserUseCase $deleteUserUseCase,
    )
    {}

    public function index(): JsonResponse {
        $data = $this->getAll->execute();
        
        if ($data) {
            return response()->json($data);
        }
        return response()->json(['message' => 'Users not found', 'status' => 'users_not_found'], 404);
    }

    public function show($id): JsonResponse {
        $data = $this->findByIdUseCase->execute($id);
        if ($data) {
            return response()->json($data);
        }
        return response()->json(['message' => 'User not found', 'status' => 'user_not_found'], 404);
    }

    public function store(Request $request) {
        
        $user = new UserDTO(
            id: null,
            name: $request->input('name'),
            email: $request->input('email'),
            password: $request->input('password')
        );

        $data = $this->createUserUseCase->execute($user);
        if ($data) {
            return response()->json(['message' => 'User created successfully', 'status' => 'user_created'], 201);
        }
        return response()->json(['message' => 'Failed to create user', 'status' => 'user_creation_failed'], 400);
    }

    public function update(Request $request, $id) {
        $user = new UserDTO(
            id: $id,
            name: $request->input('name'),
            email: $request->input('email'),
            password: $request->input('password')
        );

        $data = $this->updateUserUseCase->execute(user: $user, id: $id);
        if ($data) {
            return response()->json(['message' => 'User updated successfully', 'status' => 'user_updated'], 200);
        }
        return response()->json(['message' => 'Failed to update user', 'status' => 'user_update_failed'], 400);
    }

    public function destroy($id) {
        try {
            $data = $this->deleteUserUseCase->execute($id);
            if ($data) {
                return response()->json(['message' => 'User deleted successfully', 'status' => 'user_deleted'], 200);
            }
            return response()->json(['message' => 'Failed to delete user', 'status' => 'user_deletion_failed'], 400);
        } catch (Exceptions $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 'user_deletion_failed'], 400);
        }
    }
}