<?php

namespace App\Admin\Entities\Resume;

class User extends BaseEntity
{
    public $name;
    public $status;
    public $email;
    public $phone;
    public $city;
    public $lang;
    public $photo;

    public function __construct($properties)
    {
        parent::__construct($properties, 'user');
    }
}
