<?php 

namespace App\Http\Controllers\Course;

use App\Http\Controllers\AbstractController;
use App\Services\Course\CourseService;

/**
 * CourseController
 */
class CourseController extends AbstractController {
  
  /**
   * __construct
   *
   * @param  mixed $courseService
   * @return void
   */
  public function __construct(CourseService $courseService)
  {
    $this->service = $courseService;
  }
}