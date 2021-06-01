<?php

namespace App\Admin\Services\Resume;

use App\Admin\Entities\Resume\Description;
use App\Admin\Entities\Resume\Link;
use App\Enums\ProfileType;
use App\Models\Resume\Profile;
use App\Admin\Entities\Resume\User;

class ProfileService extends BaseService
{
    /**
     * @var Profile
     */
    protected $profile;

    public function __construct(Profile $profile)
    {
        parent::__construct();

        $this->profile = $profile;
    }

    /**
     * @return Profile
     */
    public function getModel()
    {
        return $this->profile;
    }

    public function getForSelectBox()
    {
       return ProfileType::getConstants();
    }

    public function getGenerateByType($type)
    {
        return $this->profile
            ->public()
            ->select('content_key', 'content_value')
            ->where('type', $type)
            ->get()
            ->toArray();
    }

    public function generate()
    {
        // user - type: ProfileType::USER
        $this->userGenerate();
        // links
        $this->descriptionGenerate();
        // description
        $this->linkGenerate();
    }

    public function userGenerate()
    {
        $data = $this->dataAdapter($this->getGenerateByType(ProfileType::USER));
        $entity = new User($data);
        $path = $this->getPath('user.json');
        return $this->convertToJson($entity, $path);
    }

    public function linkGenerate()
    {
        $data = $this->dataAdapter($this->getGenerateByType(ProfileType::LINKS));
        $entity = new Link($data);
        $path = $this->getPath('links.json');
        return $this->convertToJson($entity, $path);
    }

    public function descriptionGenerate()
    {
        $data = $this->dataAdapter($this->getGenerateByType(ProfileType::DESCRIPTIONS));
        $entity = new Description($data);
        $path = $this->getPath('description.json');
        return $this->convertToJson($entity, $path);
    }

    public function dataAdapter($modelData)
    {
        $data = [];
        foreach ($modelData as $row)
        {
            $data[$row['content_key']] = $row['content_value'];
        }
        return $data;
    }

}
