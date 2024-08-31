<?php

declare(strict_types=1);

namespace App\Http\Builders;

use Illuminate\Http\Request;

interface DtoBuilderFromRequest
{
    /**
     * Build Dto based on request data
     *
     * @return mixed
     */
    public function build(Request $request);
}
