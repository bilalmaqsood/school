<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
class DashboardController extends Controller
{
    protected $data = array();
    public $module = 'dashboard';

    public function __construct() {
        parent::__construct();
    }

    public function getIndex(Request $request)
    {
        $year_id = \Session::get('selected_year');
        $total_students = \DB::table('tb_students')->where('year_id', '=', $year_id)->count();
        $total_teachers = \DB::table('tb_teachers')->where('year_id', '=', $year_id)->count();
        $total_male_students = \DB::table('tb_students')->where('year_id', '=', $year_id)->where('gender', '=', 1)->count();
        $total_female_students = \DB::table('tb_students')->where('year_id', '=', $year_id)->where('gender', '=', 2)->count();
        $news = \DB::table('tb_news')->orderBy('id', 'DESC')->where('year_id', '=', $year_id)->get();
        $events = Event::where('year_id', $year_id)->get();
        $event_array = array();
        foreach($events as $event)
        {
            $event_array[] = array(
                'title' => $event->title,
                'start' => $event->start_datetime,
                'end' => $event->end_datetime,
                'body' => $event->body,
                'venue' => $event->venue

            );
        }
        $this->data['events'] = json_encode($event_array);
        $this->data['total_students'] = $total_students;
        $this->data['total_teachers'] = $total_teachers;
        $this->data['total_male_students'] = $total_male_students;
        $this->data['total_female_students'] = $total_female_students;
        $this->data['news'] = $news;
        return View('dashboard.index', $this->data);
    }
}