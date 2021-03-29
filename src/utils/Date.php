<?php

namespace App\Utils;

final class Date {
    public static function format(string $date): string {
        return (new \DateTimeImmutable($date))->format("Y-m-d");
    }
}