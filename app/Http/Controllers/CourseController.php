<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\CourseAddRequest;
use App\Http\Controllers\ResponseController;

class CourseController extends Controller
{
    public function add(CourseAddRequest $request){
        Course::create([
            'course' => $request->course
        ]);
        return ResponseController::success('Course added successfully',201);
    }

    
}
