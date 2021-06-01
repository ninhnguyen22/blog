<?php

namespace App\Admin\Services;

class BaseService
{
    public function __construct()
    {
    }

    public function getStateForStatusInput()
    {
        return [
            'on' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
        ];
    }
}
