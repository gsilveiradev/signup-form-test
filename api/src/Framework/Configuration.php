<?php

namespace SignupFormTest\Framework;

class Configuration
{
    /**
     * Get configuration from config/ folder
     * @param string $config The config identifier
     * @return array
     */
    public static function get($config)
    {
        list($file, $key) = explode('.', $config);

        $configs = include __DIR__ . '/../../config/'.$file.'.php';

        return $configs[$key];
    }
}
