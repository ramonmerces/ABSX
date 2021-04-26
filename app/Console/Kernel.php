<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
//use App\Http\Controllers\Api\ChamadoController;
use App\Models\Chamado;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function (){
            $d1 = new \DateTime();
            $d1->sub(new \DateInterval('P1D'));
            $chamados = Chamado::where('status', 'Aberto')
                           ->where('created_at', '<' ,date_format($d1, 'Y-m-d'))
                           ->get();  
            
                    foreach ($chamados as $chamado){
                        $chamado->status = "Atrasado";
                        $chamado->save();
                }
        })->everyMinute();

        /*
        $schedule->call(function (){
            $chamado = new ChamadoController;
            $chamado->atrasados();
        })->everyMinute();*/
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
