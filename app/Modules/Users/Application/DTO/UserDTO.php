<?php

namespace App\Modules\Users\Application\DTO;

class UserDTO {
    public ?int $id;
    public string $name;
    public string $email;
    public ?string $password;

    public function __construct(?int $id = 0, string $name, string $email, ?string $password = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
}