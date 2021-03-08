<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        if (\Auth::user()->role != 'master') {
            $minutes = 1440;// 24 hours = 1440 minutes
            $school_id = \Auth::user()->school->id;
            $classes =  \App\Myclass::bySchool($school_id)
                                ->pluck('id')
                                ->toArray();
      
            $totalStudents =  \App\User::bySchool($school_id)
                              ->where('role','student')
                              ->where('active', 1)
                              ->count();
            
            $totalTeachers =  \App\User::bySchool($school_id)
                              ->where('role','teacher')
                              ->where('active', 1)
                              ->count();
          
            $totalBooks =  \App\Book::bySchool($school_id)->count();
           
            $totalClasses =  \App\Myclass::bySchool($school_id)->count();
            
            $totalSections = \App\Section::whereIn('class_id', $classes)->count();

            $notices =  \App\Notice::bySchool($school_id)
                                ->where('active',1)
                                ->get();

            $events =  \App\Event::bySchool($school_id)
                              ->get();
            
            $routines =  \App\Routine::bySchool($school_id)
                                ->where('active',1)
                                ->get();
            
            $syllabuses =  \App\Syllabus::bySchool($school_id)
                                  ->where('active',1)
                                  ->get();
            
            $exams = \App\Exam::bySchool($school_id)
                              ->where('active',1)
                              ->get();
            
            // if(\Auth::user()->role == 'student')
            //   $messageCount = \App\Notification::where('student_id',\Auth::user()->id)->count();
            // else
            //   $messageCount = 0;
            return view('home',[
              'totalStudents'=>$totalStudents,
              'totalTeachers'=>$totalTeachers,
              'totalBooks'=>$totalBooks,
              'totalClasses'=>$totalClasses,
              'totalSections'=>$totalSections,
              'notices'=>$notices,
              'events'=>$events,
              'routines'=>$routines,
              'syllabuses'=>$syllabuses,
              'exams'=>$exams,
              //'messageCount'=>$messageCount,
            ]);
        } else {
            return redirect('/masters');
        }
    }
}
