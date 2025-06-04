<?php

namespace App\Services;

use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use GuzzleHttp\Client;
use SendinBlue\Client\Model\SendSmtpEmail;
use Illuminate\Support\Facades\App;


class BrevoMailer
{
    protected $apiInstance;

    public function __construct()
    {
        $config = Configuration::getDefaultConfiguration()
            ->setApiKey('api-key', env('BREVO_API_KEY'));

        $this->apiInstance = new TransactionalEmailsApi(
            new Client([
                'verify' => storage_path('certs/cacert.pem')
            ]),
            $config
        );
    }

    /**
     * Kirim email ke murid berisi akun murid dan orang tua
     */
    public function sendCredentialsToMurid(
        string $toEmailMurid,
        string $namaMurid,
        string $emailMurid,
        string $passwordMurid,
        string $emailOrtu,
        string $passwordOrtu
    ): bool {
        $email = new \SendinBlue\Client\Model\SendSmtpEmail([
            'templateId' => 2, // ganti dengan ID asli dari template Brevo
            'sender' => [
                'name' => 'Kuro Kyu',
                'email' => 'joenks321@gmail.com',
            ],
            'to' => [[
                'email' => $toEmailMurid,
                'name' => $namaMurid
            ]],
            'params' => [
                'namaMurid' => $namaMurid,
                'emailMurid' => $emailMurid,
                'passwordMurid' => $passwordMurid,
                'emailOrtu' => $emailOrtu,
                'passwordOrtu' => $passwordOrtu
            ]
        ]);


        try {
            $this->apiInstance->sendTransacEmail($email);
            return true;
        } catch (\Exception $e) {
            \Log::error('Gagal mengirim email Brevo: ' . $e->getMessage());
            return false;
        }
    }
}
