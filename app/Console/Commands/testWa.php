<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\Appointment\Appointment;

class testWa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:testWa';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notificar al paciente 1 hora antes de su cita medica , por medio de whatsap';

    /**
     * Execute the console command.
     */
    public function handle() {

            $accessToken = 'EAALo0UGYdUcBOzXlZBPWduUM18LsKzG8oechzfT0d0m0Dw980Q1Cn8mZBdNKwYZBs6aZBFhxze7lZBnoxgNIlUlETIUw6ZAI6Tt1zmLELL9YeIRlryXl6yvTorRZB4Bi9II67t7TZBMp167XbZA1IEoiOtvgfkm2JEmrCiTAQe9QYAPhbzofVkQ9TtaF12FIufEd9mVaOaMVmaO0R6oBiUlmaTUbZBUVKSZCdzEPw9QYPxipJ8chsoR5L7ZA';

            $fbApiUrl = 'https://graph.facebook.com/v19.0/319104057956594/messages';
            $data = [
                'messaging_product' => 'whatsapp',
                'to' => '+503 71293626',
                'type' => 'template',
                'template' => [
                    'name' => 'recordatorio',
                    'language' => [
                        'code' => 'es_MX',
                    ],
                    "components"=>  [
                        [
                            "type" =>  "header",
                            "parameters"=>  [
                                [
                                    "type"=>  "text",
                                    "text"=>  "ROBERTO.' '.ALVARADO",
                                ]
                            ]
                        ],
                        [
                            "type" => "body",
                            "parameters" => [
                                [
                                    "type"=> "text",
                                    "text"=>  '1:00 PM'.' '. '1:30 PM',
                                ],
                                [
                                    "type"=> "text",
                                    "text"=>  'CARLOS LOPEZ'
                                ],
                                [
                                    "type"=> "text",
                                    "text"=>  'CONSULTA GENERAL'
                                ],
                            ]
                        ],
                    ],
                ],
            ];

            $headers = [
                'Authorization: Bearer ' . $accessToken,
                'Content-Type: application/json',
            ];

            $ch = curl_init($fbApiUrl);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            echo "HTTP Code: $httpCode\n";



    }
}
