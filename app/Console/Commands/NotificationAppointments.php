<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Mail\NotificationAppoint;
use Illuminate\Support\Facades\Mail;
use App\Models\Appointment\Appointment;

class NotificationAppointments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notification-appointments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notificar al paciente 1 hora antes de su cita medica, por medio de correo';

    /**
     * Execute the console command.
     */
    public function handle()    {        
            date_default_timezone_set("America/El_Salvador");
            $patient = [
                "name"  => "Roberto",
                "surname" => "Alvarado",
                "avatar" => NULL,
                "email" => "roberto.alvarado.35@gmail.com",
                "mobile" => "71293626",
                "specialitie_name" => "CONSULTORIA GENERAL",
                "n_document" => "028084604",
                "hour_start_format" => "2024-05-31 10:00:00",
                "hour_end_format" =>  "2024-05-31 10:00:00",
            ];
            Mail::to($patient["email"])->send(new NotificationAppoint($patient));
    }
}
