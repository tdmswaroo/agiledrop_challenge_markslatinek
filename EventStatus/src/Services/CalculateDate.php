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

  public function calculateDates($nid) {
    
    /*
      retrieval of date value for specific event from database
    */
    $connection = \Drupal::database(); //db name is challenge

    $options = array();
    $result = $connection->query("SELECT field_event_date_value FROM node__field_event_date WHERE entity_id = :nid", array(':nid' => $nid), $options);

    foreach($result as $item) {
      var_dump($item);
    }

    /*
      Time calculator
    */
    $today = time();
    $date = strtotime($item->field_event_date_value);
    $datediff = $date - $today;

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