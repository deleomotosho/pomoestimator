<?php namespace App\Http\Controllers;

class WelcomeController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Welcome Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the "marketing page" for the application and
    | is configured to only allow guests. Like most of the other sample
    | controllers, you are free to modify or remove it as you desire.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application welcome screen to the user.
     *
     * @return Response
     */
    public function index($unit = 0)
    {
        $time = $this->pomodoroToTime($unit);

        return view('welcome')->with('time', $time);
    }


    /**
     * Get a pomodoro unit and convert to Hours
     *
     * @param $pomodoroUnit
     * @return string of time
     */
    protected function pomodoroToTime($pomodoroUnit)
    {

        $minutePerPomodoro = 25;

        $shortBreak = 5;
        $longBreak = 25;

        $totalMinutes = $pomodoroUnit * $minutePerPomodoro;

        // add the breaks
        while ($pomodoroUnit !== 0) {

            if ($pomodoroUnit % 4 == 0) {
                $totalMinutes = $totalMinutes + $longBreak;
            } else {
                $totalMinutes = $totalMinutes + $shortBreak;
            }

            $pomodoroUnit--;
        }

        $hours = intval($totalMinutes / 60);
        $minutes = $totalMinutes - ($hours * 60);

        return "$hours H $minutes min";
    }


}
