<?php
namespace App\Controllers;

use App\Core\base\Controller;

class AppController extends Controller
{
    public $metadata = [];

    protected function setMetadata($title = '', $description = '', $keywords = '')
    {
        $this->metadata['title'] = $title;
        $this->metadata['description'] = $description;
        $this->metadata['keywords'] = $keywords;
    }
}