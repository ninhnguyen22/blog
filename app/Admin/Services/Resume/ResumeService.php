<?php

namespace App\Admin\Services\Resume;

use App\Models\Resume\Resume;

class ResumeService extends BaseService
{
    /**
     * @var Resume
     */
    protected $resume;


    /**
     * @return Resume
     */
    public function getModel()
    {
        return $this->resume;
    }

    public function getStateForStatusInput()
    {
        return [
            'on' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
        ];
    }

}
