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

	  $service = \Drupal::service('hello_world.calculateDate');
    if(($arg[1]=="node" && $arg[1]!=null) && ($arg[2]!=null)){
      return array(
        '#markup' => $this->t('@name', array(
          '@name' => $service->calculateDates($arg[2]),
        )),
      );
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