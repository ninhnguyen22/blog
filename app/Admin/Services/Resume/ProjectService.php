<?php

namespace App\Admin\Services\Resume;

use App\Admin\Entities\Resume\Projects;
use App\Admin\Entities\Resume\Project as ProjectEntity;
use App\Models\Resume\Project;

class ProjectService extends BaseService
{
    /**
     * @var Project
     */
    protected $project;

    const IMAGE_PATH_PREFIX = [
        'portfolio', 'src', 'assets', 'img', 'projects'
    ];

    public function __construct(Project $project)
    {
        parent::__construct();

        $this->project = $project;
    }

    public function afterSaved($model)
    {
        $image = $model->image;
        $images = explode(DIRECTORY_SEPARATOR, $image);
        if ($images[0] === 'portfolio') {
            $image = $images[1];
            // copy file
            $storePath = 'app/public/admin/' . $model->image;
            copy(storage_path($storePath), public_path($this->getImagePathPrefix()) . DIRECTORY_SEPARATOR . $image);
        }
    }

    public function getImagePathPrefix($noPrefix = false)
    {
        if ($noPrefix) {
            return implode(DIRECTORY_SEPARATOR, self::IMAGE_PATH_PREFIX);
        }
        return DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, self::IMAGE_PATH_PREFIX);
    }

    /**
     * @return Project
     */
    public function getModel()
    {
        return $this->project;
    }

    public function getDataGenerate()
    {
        return $this->project
            ->public()
            ->select('title', 'content', 'link', 'image', 'color', 'date')
            ->get()
            ->toArray();
    }

    public function generate()
    {
        $projectsEntity = new Projects();

        $projects = [];
        foreach ($this->getDataGenerate() as $project) {
            $projects[] = new ProjectEntity($project);
        }

        $projectsEntity->items = $projects;

        $path = $this->getPath('projects.json');
        return $this->convertToJson($projectsEntity, $path);
    }

    public function getColors()
    {
        return [
            'red' => 'red',
            'blue' => 'blue',
            'purple' => 'purple',
            'green' => 'green',
            'orange' => 'orange',
        ];
    }


}
