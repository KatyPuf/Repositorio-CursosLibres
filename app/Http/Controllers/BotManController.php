<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
   

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');  
        $botman->hears('{message}', function($botman, $message) {
   
            if ($message == 'hola') {
                $this->askName($botman);
            }
            elseif($message == 'HOLA') {
                $this->askName($botman);
            }
            elseif($message == 'Hola') {
                $this->askName($botman);
            }
            elseif($message == 'si') {
                $this->askName2($botman);
            }
            elseif($message == 'Si') {
                $this->askName2($botman);
            }
            elseif($message == 'SI') {
                $this->askName2($botman);
            }
            elseif($message == 'A') {
                $this->askName3($botman);
            }
            elseif($message == 'B') {
                $this->askName4($botman);
            }
            elseif($message == 'C') {
                $this->askName5($botman);
            }
            
            elseif($message == 'D') {
                $this->askName6($botman);
            }
            elseif($message == 'inscripción') {
                $this->askName6($botman);
            }
            elseif($message == 'inscripcion') {
                $this->askName6($botman);
            }
            
            elseif($message == 'E') {
                $this->askName7($botman);
            }
            else{
                $botman->reply("Escribe 'hola'...");
            }
   
        });
   
        $botman->listen();
    }
   
    /**
     * Place your BotMan logic here.*/
     
    public function askName($botman)
    {
        $botman->ask('Hola! ¿Cuál es tu nombre?', function(Answer $answer) {
   
            $name = $answer->getText();
            $this->say('Bienvenido(a) '.$name);
            $this->say('Este espacio es para resolver tus dudas. ¿Tienes alguna duda?. Responde Si o No');
            
        });


    }
    
    public function askName2($botman)
    {
        $botman->ask('Si tu duda es respecto a alguna de estas opciones, escriba la letra correspondiente: <br>
            A. Precios<br>
            B. Horarios<br>
            C. Duración<br>
            D. Inscripción<br>
            E. Ninguna', function(Answer $answer) {
            
            
        });
    }
    public function askName3($botman)
    {
        $botman->ask('Precio', function(Answer $answer){

        });
    }
    public function askName4($botman)
    {
        $botman->ask('Horarios', function(Answer $answer){

        });
    }

    public function askName5($botman)
    {
        $botman->ask('Duración', function(Answer $answer){

        });
    }
    public function askName6($botman)
    {
        $botman->ask('Inscripción', function(Answer $answer){

        });
    }
    public function askName7($botman)
    {
        $botman->ask('Ninguna', function(Answer $answer){

        });
    }
}


/*
$botman = app('botman');
   
        $botman->hears('Hola', function($bot) {
            $bot->reply('¡Hola!');
            $bot->ask('¿Cuál es tu nombre?', function($answer, $bot) {
                $bot->say('Bienvenido '.$answer->getText());
                $bot->say('¿Tienes alguna duda?');
            });
            
        });

        $botman->hears('si', function($bot) {
            $bot->reply('Si tu duda es sobre precios, horarios o duración, escribe la palabra') ;
            
        });
        $botman->hears('Precios', function($bot) {
            
            $bot->reply('Los precios para los cursos de Excel Intermedio y Excel avanzado tienen un precio
            de C$1500, el pago puede ser de tal forma que la mitad se da a inicio del curso y el resto al finalizar.');
                
            
        });
        /*$bot->ask('Tienes alguna duda?', function($answer, $bot) {
            $bot->say('La duda es'.$answer->getText());
        });

        
        $botman->listen();
    } */