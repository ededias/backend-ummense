<?php

namespace App\Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Users\Application\DTO\UserDTO;
use App\Modules\Users\Application\UseCases\FindByIdUseCase;
use App\Modules\Users\Application\UseCases\GetAllUsersUseCase;
use App\Modules\Users\Application\UseCases\CreateUserUseCase;
use App\Modules\Users\Domain\Exceptions\Exceptions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller {


    public function __construct(
        private FindByIdUseCase $findByIdUseCase,
        private GetAllUsersUseCase $getAll,
        private CreateUserUseCase $createUserUseCase,
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
        throw new Exceptions('method not implemented');
    }

    public function destroy($id) {
        throw new Exceptions('method not implemented');
    }
}