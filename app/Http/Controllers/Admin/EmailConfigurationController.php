<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailConfiguration;
use Illuminate\Http\Request;

class EmailConfigurationController extends Controller
{

    public function updateEmailConf(Request $request)
    {
        $request->validate([
            'mail_driver' => 'required',
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_username' => 'required',
            'mail_password' => 'required',
            'mail_encryption' => 'required',
            'mail_from_address' => 'required',
            'mail_from_name' => 'required',
        ]);

        EmailConfiguration::updateOrCreate(
            ['id' => 1],
            $request->only([
                'mail_driver',
                'mail_host',
                'mail_port',
                'mail_username',
                'mail_password',
                'mail_encryption',
                'mail_from_address',
                'mail_from_name'
            ])
        );

        $this->updateEmailConfEnvFile($request);

        return redirect()->back();
    }

    private function updateEmailConfEnvFile(Request $request)
    {
        $env = [
            'MAIL_MAILER' => $request->mail_driver,
            'MAIL_HOST' => $request->mail_host,
            'MAIL_PORT' => $request->mail_port,
            'MAIL_USERNAME' => $request->mail_username,
            'MAIL_PASSWORD' => $request->mail_password,
            'MAIL_ENCRYPTION' => $request->mail_encryption,
            'MAIL_FROM_ADDRESS' => $request->mail_from_address,
            'MAIL_FROM_NAME' => $request->mail_from_name,
        ];

        $Envpath = base_path('.env');
        $keyValue = file_get_contents($Envpath);

        foreach ($env as $key => $value) {
            $value = '"' . $value . '"';
            $keyValue = preg_replace("/^{$key}=.*$/m", "{$key}={$value}", $keyValue);
        }

        file_put_contents($Envpath, $keyValue);
    }
}
