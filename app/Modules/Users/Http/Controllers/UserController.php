<?php

namespace App\Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Users\Domain\Exceptions\Exceptions;
use Illuminate\Support\Facades\Request;

class UserController extends Controller {
    public function index() {
        throw new Exceptions('method not implemented');
    }

    public function show($id) {
        throw new Exceptions('method not implemented');
    }

    public function store(Request $request) {
        throw new Exceptions('method not implemented');
    }

    public function update(Request $request, $id) {
        throw new Exceptions('method not implemented');
    }

    public function destroy($id) {
        throw new Exceptions('method not implemented');
    }
}