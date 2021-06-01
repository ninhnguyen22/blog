<?php

namespace App\Admin\Services\Resume;

use App\Admin\Entities\Resume\Skills;
use App\Models\Resume\Skill;
use App\Admin\Entities\Resume\Skill as SkillEntity;

class SkillService extends BaseService
{
    /**
     * @var Skill
     */
    protected $skill;

    const IMAGE_PATH_PREFIX = [
        'portfolio', 'src', 'assets', 'img', 'logo'
    ];

    public function __construct(Skill $skill)
    {
        parent::__construct();

        $this->skill = $skill;
    }

    /**
     * @return Skill
     */
    public function getModel()
    {
        return $this->skill;
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

            // save
            $model->image = $image;
            $model->save();
        } else {
            $image = $this->getResourceImage($model->name);
            $model->image = $image;
            $model->save();
        }
    }

    public function getImagePathPrefix($noPrefix = false)
    {
        if ($noPrefix) {
            return implode(DIRECTORY_SEPARATOR, self::IMAGE_PATH_PREFIX);
        }
        return DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, self::IMAGE_PATH_PREFIX);
    }

    public function getResourceImage($key)
    {
        $skills = config('skills', []);
        foreach ($skills as $skill) {
            if ($skill['title'] === trim($key)) {
                return $skill['img'];
            }
        }
        return null;
    }

    public function getDataGenerate()
    {
        return $this->skill
            ->public()
            ->select('name', 'image')
            ->get()
            ->toArray();
    }

    public function generate()
    {
        $skillsEntity = new Skills();

        $skills = [];
        foreach ($this->getDataGenerate() as $skill) {
            $skills[] = new SkillEntity($this->dataAdapter($skill));
        }

        $skillsEntity->items = $skills;

        $path = $this->getPath('skills.json');
        return $this->convertToJson($skillsEntity, $path);
    }

    public function dataAdapter($modelData)
    {
        $data = [];
        $data['title'] = $modelData['name'];
        $data['img'] = $modelData['image'];
        return $data;
    }

    public function getNameSelect()
    {
        $configs = config('skills');
        $options = [];
        foreach ($configs as $config) {
            $options[$config['title']] = $config['title'];
        }
        return $options;
    }
}
