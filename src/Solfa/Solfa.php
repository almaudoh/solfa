<?php

namespace KodeHauz\Solfa;

use KodeHauz\Midi\Midi;

/**
 *
 * @author Aniebiet
 */
class Solfa {

  const GAP_ALLOWANCE = 0.05;

  /**
   * @var Midi
   */
  protected $tracks;

  /**
   * @var
   */
  protected $attributes;

  /**
   * The (meta) events that happen during the playing of this solfa.
   *
   * @var array
   */

  protected $events = array();
  /**
   * Creates a new instance of SolfaMidi
   */
  public function __construct($timebase = 0 /* @todo */) {
    $this->tracks = array();
    $this->setTempo(0); // 125000 = 120 bpm.
    $this->timebase = $timebase;
  }

  public function getTrack($track_number) {
    return $this->tracks[$track_number];
  }

  public function getTracks() {
    return $this->tracks;
  }

  public function updatePart() {
    $this->info->trackname = $this->getStyle().getAttribute(MetaEvent.describe(MetaEvent.TRACK_NAME)).toString();
    if (info.getTrackName().equalsIgnoreCase("soprano")) {
      $this->part = 0;
    } else if (info.getTrackName().equalsIgnoreCase("alto")) {
      $this->part = 1;
    } else if (info.getTrackName().equalsIgnoreCase("tenor")) {
      $this->part = 2;
    } else if (info.getTrackName().equalsIgnoreCase("bass")) {
      $this->part = 3;
    }
  }

  public function setTempo($tempo, $bar_location = 0) {
    $this->setEvent('tempo', $tempo, $bar_location);
  }

  public function setTimeSignature($time_signature, $bar_location = 0) {
    $this->setEvent('time_signature', $time_signature, $bar_location);
  }

  public function setKeySignature($key_signature, $bar_location = 0) {
    $this->setEvent('key_signature', $key_signature, $bar_location);
  }

  public function setEvent($event_name, $value, $bar_location = 0) {
    $this->events[$event_name][$bar_location] = $value;
  }

}
