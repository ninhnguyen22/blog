<?php

namespace App\Admin\Entities\Resume;

class Experiences extends BaseEntity
{
    public $description;
    public $title;
    public $professional;
    public $academic;

    public function __construct($properties = [])
    {
        parent::__construct($properties, 'experiences');
    }
}
