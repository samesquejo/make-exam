<?php

namespace App\Library;

class ModelFactory {
    public static function model($model) {
        $modelName = "\\App\\Models\\" . $model;
        return new $modelName();
    }
}