<?php
define('DATA_PATH', __DIR__ . '/../data/');

function read_json($filename) {
    $path = DATA_PATH . $filename;
    if (!file_exists($path)) return [];
    $data = file_get_contents($path);
    $decoded = json_decode($data, true);
    return is_array($decoded) ? $decoded : [];
}

function write_json($filename, $data) {
    $path = DATA_PATH . $filename;
    return file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function get_next_id($items) {
    if (empty($items)) return 1;
    return max(array_keys($items)) + 1;
}

function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return empty($text) ? 'item' : $text;
}

function truncate($text, $length = 100) {
    if (mb_strlen($text) <= $length) return $text;
    return mb_substr($text, 0, $length) . '...';
}
