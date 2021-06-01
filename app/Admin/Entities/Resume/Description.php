<?php

namespace App\Admin\Entities\Resume;

class Description extends BaseEntity
{
	public $pres_second;
	public $pres_first;
	public $pres_title;
	public $description;
	public $title;

    public function __construct($properties)
    {
        parent::__construct($properties, 'description');
    }
}
