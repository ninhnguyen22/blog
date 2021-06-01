<?php

namespace App\Admin\Entities\Resume;

class Skill extends BaseEntity
{
    public $title;
    public $img;

    public function __construct($properties)
    {
        parent::__construct($properties, 'skill');
    }

}
