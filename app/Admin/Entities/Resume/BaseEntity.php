<?php

namespace App\Admin\Entities\Resume;

use Illuminate\Support\Str;

class BaseEntity
{
    public function __construct($properties = [], $configKey = null)
    {
        $this->setProperties($properties, $configKey);
    }

    public function setProperties($properties, $configKey)
    {
        $config = $this->getFromConfig($configKey);

        foreach ($config as $key => $default) {
            $this->setProperty($properties, $key, $default);
        }
    }

    protected function getFromConfig($configKey)
    {
        return config('portfolio.' . $configKey, []);
    }

    public function setProperty($properties, $key, $value)
    {
        if (property_exists($this, $key)) {
            if (isset($properties[$key])) {
                $value = $properties[$key];
            }
            if (method_exists($this, $key . 'Prepare')) {
                $value = $this->{$key . 'Prepare'}($value);
            }
            $this->{$key} = $value;
        }
    }

}
