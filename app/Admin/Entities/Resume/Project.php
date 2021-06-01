<?php

namespace App\Admin\Entities\Resume;

class Project extends BaseEntity
{
    public $title;
    public $content;
    public $link;
    public $image;
    public $color = "purple";
    public $date;

    public function __construct($properties)
    {
        parent::__construct($properties, 'project');
    }

    public function datePrepare($date)
    {
        return date('Y-m-d', strtotime($date));
    }

    public function imagePrepare($image)
    {
        $images = explode(DIRECTORY_SEPARATOR, $image);
        return isset($image[1]) ? $images[1] : $image;
    }
}
