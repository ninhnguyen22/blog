<?php

namespace App\Admin\Entities\Resume;

class Experience extends BaseEntity
{
    public $year; // 01.2020 - 05.2020
    public $title;
    public $content;

    public function __construct($properties = [])
    {
        parent::__construct($properties, 'experience');
    }
}
