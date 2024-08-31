<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ValidationController extends Controller
{
    public function validate(Request $request): Response
    {
        dd($request->all());
    }
}
