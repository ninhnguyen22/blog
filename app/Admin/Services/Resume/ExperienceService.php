<?php

namespace App\Admin\Services\Resume;

use App\Admin\Entities\Resume\Experiences;
use App\Admin\Entities\Resume\Experience as ExperienceEntity;
use App\Enums\ExperienceType;
use App\Models\Resume\Experience;

class ExperienceService extends BaseService
{
    /**
     * @var Experience
     */
    protected $experience;

    public function __construct(Experience $experience)
    {
        parent::__construct();

        $this->experience = $experience;
    }

    /**
     * @return Experience
     */
    public function getModel()
    {
        return $this->experience;
    }

    public function getDataGenerate()
    {
        return $this->experience
            ->public()
            ->select('from', 'to', 'title', 'content', 'type')
            ->get()
            ->toArray();
    }

    public function generate()
    {
        $projectsEntity = new Experiences();

        $academies = [];
        $professionals = [];
        foreach ($this->getDataGenerate() as $experience) {
            switch ($experience['type']) {
                case ExperienceType::ACADEMIC:
                    $academies[] = new ExperienceEntity($this->dataAdapter($experience));
                default:
                    $professionals[] = new ExperienceEntity($this->dataAdapter($experience));
            }
        }

        $projectsEntity->academic = $academies;
        $projectsEntity->professional = $professionals;

        $path = $this->getPath('experiences.json');
        return $this->convertToJson($projectsEntity, $path);
    }

    public function dataAdapter($modelData)
    {
        $data = [];
        $data['year'] = date('m.Y', strtotime($modelData['from'])) . ' - ' . date('m.Y', strtotime($modelData['to']));
        $data['title'] = $modelData['title'];
        $data['content'] = $modelData['content'];
        return $data;
    }

}
