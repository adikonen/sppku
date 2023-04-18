<?php

class TemplateView
{
    protected static $scripts = [];
    protected static $styles = [];

    protected static $components = [];

    public static function addScriptsSource(...$scripts)
    {
        foreach ($scripts as $script) {
            $script = trim($script, '/');
            $url = ASSET_URL . "/$script";
            static::$scripts[] = "<script src='$url'></script>";
        }
    }

    public static function printScriptSources()
    {
        foreach (static::$scripts as $script) {
            echo $script;
        }
    }

    public static function addComponent($on_section, $component, $component_params = [])
    {
        static::$components[$on_section][] = [
            'name' => $component, 
            'params' => $component_params
        ];

    }

    public static function printComponent($on_section)
    {
        if (isset(static::$components[$on_section])) {
            foreach (static::$components[$on_section] as $component) {
                echo component($component['name'], $component['params']);
            }
        }
    }
}