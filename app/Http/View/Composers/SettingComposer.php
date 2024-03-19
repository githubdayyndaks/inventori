<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Setting;

class SettingComposer
{
    public function compose(View $view)
    {
        $setting = Setting::first();
        $view->with('setting', $setting);
    }
}
