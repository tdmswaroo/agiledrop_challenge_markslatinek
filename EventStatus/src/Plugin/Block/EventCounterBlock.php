<?php

namespace Drupal\hello_world\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'EventCounter' Block.
 *
 * @Block(
 *   id = "event_counter",
 *   admin_label = @Translation("Event Status"),
 *   category = @Translation("Event Status"),
 * )
 */
class EventCounterBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $path = \Drupal::request()->getpathInfo();
	$arg  = explode('/',$path);

	/*
      retrieval of date value for specific event from database
    */

	if($arg[1]=="node"){
		$connection = \Drupal::database(); //db name is challenge
		$options = array();
		$result = $connection->query("SELECT * FROM node__field_event_date WHERE entity_id = :nid", 
			array(':nid' => $arg[2]), $options);

		if(!empty($result)){
			foreach($result as $item) {
				$record = $item;
			}

			$service = \Drupal::service('hello_world.calculateDate');
			if(!empty($record)){
				$date = $record->field_event_date_value;
			
				return array(
					'#markup' => $this->t('@name', array(
					'@name' => $service->calculateDates($date),
					)),
				);
			}
		}


    }else{


      return array(
        '#markup' => $this->t('@name', array(
          '@name' => "Please set the block to be visible only on event pages.",
        )),
      );
    }
  }

  /**
     * {@inheritdoc}
     */
    public function getCacheMaxAge() {
        return 0;
    }


}

?>