<?php

namespace KodeHauz\Solfa;

/**
 * Represents a single bar in a measure of solfa music.
 */
class Bar {

  /**
   * @var \KodeHauz\Solfa\Beat[]
   */
  protected $beats;

  /**
   * The number of beats that make up this bar
   *
   * @var
   */
  protected $beatsPerBar;

  public function __construct(array $beats, $beats_per_bar = NULL) {
    $this->beatsPerBar = $beats_per_bar ?: count($beats);
    $this->beats = array_slice($beats, 0, $this->beatsPerBar);
  }

  public function addBeat(Beat $beat) {
    if (count($this->beats) < $this->beatsPerBar) {
      $this->beats[] = $beat;
    }
    else {
      // @todo Create Exception classes.
      throw new \InvalidArgumentException('The bar is already filled up. Cannot add new beat.');
    }
  }

  /**
   * @return \KodeHauz\Solfa\Beat[]
   */
  public function getBeats() {
    return $this->beats;
  }

  /**
   * @return int
   */
  public function getBeatsPerBar() {
    return $this->beatsPerBar;
  }

}
