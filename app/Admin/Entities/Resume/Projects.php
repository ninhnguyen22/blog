<?php

namespace App\Admin\Entities\Resume;

class Projects extends BaseEntity
{
    public $items;
    public $title;
    public $description;

    public function __construct($properties = [])
    {
        parent::__construct($properties, 'projects');
    }
}
