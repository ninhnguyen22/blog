<?php

namespace App\Admin\Services\Resume;

use App\Enums\ProfileType;
use App\Models\Resume\Profile;

class ProfileService extends BaseService
{
    /**
     * @var Profile
     */
    protected $profile;

    public function __construct(Profile $profile)
    {
        parent::__construct();

        $this->profile = $profile;
    }

    /**
     * @return Profile
     */
    public function getModel()
    {
        return $this->profile;
    }

    public function getForSelectBox()
    {
       return ProfileType::getConstants();
    }

    public function getStateForStatusInput()
    {
        return [
            'on' => ['value' => 1, 'text' => 'enable', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'disable', 'color' => 'danger'],
        ];
    }

}
