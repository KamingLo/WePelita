<?php

namespace App\Services;

use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use GuzzleHttp\Client;
use SendinBlue\Client\Model\SendSmtpEmail;

class BrevoMailer
{
    protected $apiInstance;

    public function __construct()
    {
        $config = Configuration::getDefaultConfiguration()
            ->setApiKey('api-key', env('BREVO_API_KEY'));

        $this->apiInstance = new TransactionalEmailsApi(
            new Client(),
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
        $email = new SendSmtpEmail([
            'subject' => 'Akun Murid dan Orang Tua Berhasil Dibuat',
            'sender' => [
                'name' => 'Admin Sekolah',
                'email' => 'admin@sekolah.com', // pastikan email ini sudah diverifikasi di Brevo
            ],
            'to' => [[
                'email' => $toEmailMurid,
                'name' => $namaMurid
            ]],
            'htmlContent' => "
                <h2>Selamat Datang, {$namaMurid}!</h2>
                <p>Akun untuk Anda dan orang tua Anda telah berhasil dibuat. Berikut informasi login:</p>

                <h3>🔑 Akun Murid</h3>
                <ul>
                    <li><strong>Email:</strong> {$emailMurid}</li>
                    <li><strong>Password:</strong> {$passwordMurid}</li>
                </ul>

                <h3>👨‍👩‍👧 Akun Orang Tua</h3>
                <ul>
                    <li><strong>Email:</strong> {$emailOrtu}</li>
                    <li><strong>Password:</strong> {$passwordOrtu}</li>
                </ul>

                <p>Segera login dan ubah password untuk keamanan akun Anda.</p>
                <p>Terima kasih telah bergabung dengan kami.</p>
            ",
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
