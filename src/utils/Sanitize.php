<?php

namespace App\Utils;

final Class Sanitize {
    public static function Data(string $data) {
        return htmlspecialchars(strip_tags($data));
    }
}