<?php

/**
 * @param $value
 * @param string $dash
 * @return string
 */
function display($value, $dash = '-')
{
    if (empty($value)) {
        return $dash;
    }

    return $value;
}

/**
 * @param $width
 * @param null $entity
 * @return mixed
 */
function thumbnail($width, $height = null, $entity = null, $field='image')
{
    $height ?: $height = $width;

    try {
        if (!is_null($entity)) {
            if ($image = $entity->image()->where('meta', $field)->first()) {
                return asset($image->thumbnail($width, $height));
            }
        }
    } catch (\Exception $e)
    {

    }

    return asset(setting('placeholder'));
}

function resize($width=null, $height = null, $entity = null, $field='image')
{
    if($width == null) {
        if ($height == null) {
            $width = 100;
        } else {
            $width = $height;
        }
    }

    if (!is_null($entity)) {
        if ($image = $entity->image()->where('meta', $field)->first()) {
            return asset($image->resize($width, $height));
        }
    }

    return asset(setting('placeholder'));
}

/**
 * @param $query
 * @return mixed
 */
function setting($query)
{
    $setting = \App\Models\Setting::fetch($query)->first();

    return $setting ? $setting->value : null;
}
