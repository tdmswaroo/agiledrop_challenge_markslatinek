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

  	$node = \Drupal::routeMatch()->getParameter('node');
	if ($node instanceof \Drupal\node\NodeInterface) {
	  	$eventDate = $node->get('field_event_date')->value;
	  	$service = \Drupal::service('hello_world.calculateDate');
		if(!empty($eventDate)){
			return array(
				'#markup' => $this->t('@name', array(
				'@name' => $service->calculateDates($eventDate),
				)),
			);
		}else{
	      return array(
	        '#markup' => $this->t('@name', array(
	          '@name' => "Please set the block to be visible only on event pages or set the date for the event.",
	        )),
	      );
	    }
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