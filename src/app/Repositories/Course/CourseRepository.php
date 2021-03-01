<?php 

namespace App\Repositories\Course;

use App\Models\Course\Course;
use App\Repositories\AbstractRepository;

/**
 * CourseRepository
 */
class CourseRepository extends AbstractRepository
{  
  /**
   * __construct
   *
   * @param  mixed $course
   * @return void
   */
  public function __construct(Course $course)
  {
    $this->model = $course;
  }
    
  /**
   * findByName
   *
   * @param  mixed $name
   * @return array
   */
  public function findByName(string $name): array
  {
    return $this->model::where('name', $name)
      ->get()
      ->toarray();
  }
}