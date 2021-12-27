<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Config;

class SettingsController extends Controller
{
    use HelperTrait;
    
    private $settings;

    public function __construct()
    {
        $this->settings = simplexml_load_file(env('SETTINGS_XML'));
    }

    // Seo
    public function getSeoTags()
    {
        $tags = [];
        foreach ($this->metas as $meta => $params) {
            $tags[$meta] = (string)$this->settings->seo->$meta;
        }
        return $tags;
    }

    public function getSettings()
    {
        return $this->settings->settings;
    }

    public function saveSeoTags(Request $request)
    {
        foreach (['title_ru','title_en'] as $title) {
            if ($request->has($title)) $this->settings->seo->$title = $request->input($title);
        }
        foreach ($this->metas as $meta => $params) {
            $this->settings->seo->$meta = $request->input($meta);
        }
        $this->save();
    }

    public function saveSettings($fields)
    {
        foreach($fields as $field => $value) {
            $this->settings->settings->$field = $value;
        }
        $this->save();
    }

    private function save()
    {
        $this->settings->asXML(env('SETTINGS_XML'));
    }
}
