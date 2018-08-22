<?php
namespace App\Core;

class Cache
{
    public function __construct()
    {

    }
    public function set($key, $data, $time = 3600)
    {
        $content['data'] = $data;
        $content['end_time'] = time() + $time;
        if (file_put_contents(CACHE.'/'.hash('haval128,5', $key).'.bin', serialize($content))) {
            return true;
        }
        return false;
    }
    public function get($key)
    {
        if (file_exists($file = CACHE.'/'.hash('haval128,5', $key).'.bin')) {
            $fileData = unserialize(file_get_contents($file));
            if (time() <= $fileData['end_time']) {
                return $fileData['data'];
            }
            unlink($file); //если файл существует, но кэш не актуален, то удалим этот файл
        }
        return false;
    }
    public function delete($key)
    {
        if (file_exists($file = CACHE.'/'.hash('haval128,5', $key).'.bin')) {
            unlink($file);
        }
    }
}