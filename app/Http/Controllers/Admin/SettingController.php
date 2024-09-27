<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailConfiguration;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $emailConfig = EmailConfiguration::first();
        return view('admin.setting.setting',compact('emailConfig'));
    }
    public function update(Request $request){

        return back();
    }
}
