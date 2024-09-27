<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.setting.setting');
    }
    public function update(Request $request){
        foreach ($request->types as $key => $type) {
            $settings = Setting::where('type', $type)->first();
            if ($settings != null) {
                $settings->update([
                    'value'=> $request[$type]
                ]);
            } else {
                $settings = new Setting();
                $settings->type = $type;
                $settings->value = $request[$type];
                $settings->save();
            }
        }

        return back();
    }
}
