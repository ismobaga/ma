<?php

if (! function_exists('setting')) {
    function setting(string $key, mixed $default = null): mixed
    {
        $setting = \App\Models\Setting::where('key', $key)->first();

        return $setting ? $setting->value : $default;
    }
}
