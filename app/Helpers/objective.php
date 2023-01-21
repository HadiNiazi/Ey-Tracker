<?php

use App\Models\MainObjective;

if (! function_exists('main_objectives')) {
    function main_objectives() {
        $objectives = MainObjective::all();
        return $objectives;
    }
}
