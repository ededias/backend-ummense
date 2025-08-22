<?php

namespace App\Modules\Users\Infrastructure\Repository;

use App\Modules\Users\Domain\Exceptions\Exceptions;
use App\Modules\Users\Domain\Interfaces\UserInterface;
use Illuminate\Support\Facades\DB;
use App\Modules\Users\Domain\Entity\User;

class UserRepository implements UserInterface {

    public function __construct(private DB $db) {}

    public function findById(int $id): ?User {

        try {
            $user = $this->db::table('users')->where('id', $id)->first();

            if (!$user) {
                return null;
            }

            $entity = new User(
                $user->id,
                $user->name,
                $user->email,
                $user->password
            );

            return $entity;
        } catch (\Exception $e) {
            return null;
        }

    }

     /**
     * @return ?User[]
     * **/
    public function getAll(): ?array {
        try {

            $users = $this->db::table('users')->get();
            $entity = $users->map(fn($user) => new User(
                id: $user->id,
                name: $user->name,
                email: $user->email,
            ))->toArray();
            return $entity;
        } catch (\Exception $e) {
            return null;
        }
    }

    public function edit(int $id, User $data): bool {
        try {
            $this->db::table('users')->where('id', $id)->update([
                'name' => $data->getName(),
                'email' => $data->getEmail(),
                'password' => $data->getPassword(),
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function delete(int $id): bool {
        try {
            $this->db::table('users')->where('id', $id)->delete();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}