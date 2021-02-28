<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\Course\Course;
use Illuminate\Http\Request;

class CourseController extends BaseController
{
    protected Course $course;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function index()
    {
        return $this->course->all();
    }

    public function show($courseId)
    {
        return $this->course->findOrFail($courseId);
    }

    public function store(Request $request)
    {
        $this->course->create($request->all());
        return response()
            ->json([
                'data' => $request->all()
            ]);
    }

    public function update($courseId, Request $request)
    {
        $course = $this->course->findOrFail($courseId);
        $course->update($request->all());

        return response()
            ->json([
                'data' => $course
            ]);
    }

    public function destroy($courseId)
    {
        $course = $this->course->findOrFail($courseId);
        $course->delete($courseId);

        return response()
            ->json(['data' => [
                'message' => 'Deleted course with success!'
            ]]);
    }
}
