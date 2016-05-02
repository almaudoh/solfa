<?php

/*
 * Track.java
 *
 * Created on August 29, 2007, 2:11 AM
 *
 * To change this template, choose Tools | Template Manager
 * and open the template in the editor.
 */
namespace KodeHauz\Solfa;

/**
 *
 * @author Aniebiet
 */
class Track {

  protected static $trackCount = 0;

  /**
   * The bars that make up this solfa musical track.
   *
   * @var \KodeHauz\Solfa\Bar[]
   */
  protected $bars;
  protected $part = -1;
  protected $trackName;
  protected $mainPatch;
//  protected $info;  // TrackInfo

  /** Creates a new instance of Track */
  public function __construct(array $bars = array()) {
    $this->bars = $bars;
    $this->trackName = 'Track ' . self::$trackCount++;
  }

  public static function fromBeats(array $beats) {

  }

  public function getPart() {
    return $this->part;
  }

  public function addBar(Bar $bar) {
    $this->bars[] = $bar;
  }

  public function addBeats($beats, $beats_per_bar = NULL) {
    if (!isset($beats_per_bar)) {
      $beats_per_bar = $this->bars[count($this->bars) - 1]->getBeatsPerBar();
    }
    while ($beats) {
      $to_add = array_slice($beats, 0, $beats_per_bar);
      $this->addBar(new Bar($to_add));
      $beats = array_slice($beats, $beats_per_bar);
    }
  }

  public function getBars() {
    return $this->bars;
  }

//    public function addBeatStyle(MetaEvent meta) { // function
//        if (meta != null) {
//
////            metas.put(currIndex, meta);
//        }
//    }
//
//    public function addBeatStyle(int index, MetaEvent meta) { // function
//        if (meta != null) {
////            metas.put(index, meta);
//            currIndex = index;
//        }
//    }
//

  protected $lofreq = 131;
  protected $hifreq = 0;

  public function getLowestFrequency() { // int
  return $this->lofreq;
}

  public function getHighestFrequency() { // int
  return $this->hifreq;
}

}
