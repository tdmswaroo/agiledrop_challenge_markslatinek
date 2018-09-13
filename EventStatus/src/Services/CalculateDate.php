<?php

namespace Drupal\hello_world\Services;

use Drupal\Core\Database\Database;

/**
 * Class CustomService.
 */
class CalculateDate {

  /**
   * Constructs a new CustomService object.
   */
  public function __construct() {

  }

  public function calculateDates($date) {
    
    /*
      Time calculator
    */
    $today = time();
    $givendate = strtotime($date);
    $datediff = $givendate - $today;

    $difference = round($datediff / (60 * 60 * 24));

    /*
      status terms and content
    */
    if($difference < 0){
      $status = "The event has ended.";
    }else if($difference > 0){
      $status = "Days left to event start: ".$difference;
    }else{
      $status = "The event is in progress.";
    }

    return $status;
  }
  
}

?>