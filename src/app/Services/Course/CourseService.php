<?php 

namespace App\Services\Course;

use App\Repositories\Course\CourseRepository;
use \App\Services\AbstractService;

/**
 * Class CourseService
 * @package App\Services\Course
 */
class CourseService extends AbstractService 
{
  public function __construct(CourseRepository $courseRepository)
  {
    $this->repository = $courseRepository;
  }
}