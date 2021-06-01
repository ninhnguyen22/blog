<?php

namespace App\Admin\Entities\Resume;

class Link extends BaseEntity
{
	public $facebook;
	public $instagram;
	public $linkedin;
	public $github;

    public function __construct($properties)
    {
        parent::__construct($properties, 'link');
    }
}
