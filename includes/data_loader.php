<?php
if (!function_exists('load_data')) {
function load_data($filename) {
    $path = __DIR__ . '/../admin/data/' . $filename;
    if (!file_exists($path)) return [];
    $data = file_get_contents($path);
    $decoded = json_decode($data, true);
    return is_array($decoded) ? $decoded : [];
}
}
