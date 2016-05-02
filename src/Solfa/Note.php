<?php

namespace KodeHauz\Solfa;

/**
 * Represents a single solfa note.
 */
class Note {

  /**
   * The note value.
   *
   * @var int
   *
   * @see SolfaNoteFactory constants.
   */
  protected $value;

  /**
   * The length of the note.
   *
   * a beat-length note = 1; half-beat = 0.5; quarter-beat = 0.25.
   *
   * @var float
   */
  protected $length;

  /**
   * Specifies the octave of this note relative to the octave base of the part.
   *
   * 0 = same octave; 1 = octave above; 2 = two octaves above; -1 = octave below;
   * -2 = two octaves below; etc.
   *
   * @var int
   */
  protected $octave;

  /**
   * Creates a new instance of a solfa note.
   */
  public function __construct($value, $length = 1, $octave = 0) {
    $this->value = $value;
    $this->length = $length;
    $this->octave = $octave;
  }

  public function getValue() {
    return $this->value;
  }

  public function getLength() {
    return $this->length;
  }

  public function getOctave() {
    return $this->octave;
  }

  public function setValue($value) {
    $this->value = $value;
    return $this;
  }

  public function setLength($length) {
    $this->length = $length;
    return $this;
  }

  public function setOctave($octave) {
    $this->octave = $octave;
    return $this;
  }

//  public function equals(Note $note) {
//    return ($note->getValue() == $this->getValue());
//  }
//
//  public function strictEquals(Note $note) {
//    return ($note->getFrequency() == $this->getFrequency() && $note->getVelocity() == $this->getVelocity());
//  }
//
//  public function veryStrictEquals(Note $note) {
//    return ($note->getFrequency() == $this->frequency && $note->getVelocity() == $this->velocity && $note->getArticulation() == $this->articulation);
//  }
//
//  public function getTick($keySig, $octaveBase) {
//    if ($this->frequency == -1 || $this->frequency == 0) {
//      return 0;
//    }
//    else {
//
//      $octave = $this->frequency / 12;
//      $note = $this->frequency % 12;
//
//      $solfaNote = $note - $this->getDoh($keySig);
////        if (getDoh(keySig) < 10) {
//////            noteCorrection = -1;
////        }
////        else {
//////            noteCorrection = 0;
////        }
//
//      if ($solfaNote < 0) {
//        $solfaNote += 12;
//        $noteCorrection = -1;
//      }
//      else {
//        $noteCorrection = 0;
//      }
//
//      $solfaOctave = $octave - $octaveBase + $noteCorrection;
//      //System.out.printf("Doh: %d, solfaNote: %d, solfaOctave: %d%n", getDoh(keySig), solfaNote, solfaOctave);
//
////            System.out.printf("%d %d %d 8ve:%d\n", frequency, keySig, octaveBase, solfaOctave);
//
//      return $solfaOctave;
////            switch (solfaOctave) {
////                case -2:
////                    return tonic[solfaNote] + downTick1;
////                case -1:
////                    return tonic[solfaNote] + downTick0;
////                case 0:
////                    return tonic[solfaNote];
////                case 1:
////                    return tonic[solfaNote] + upTick0;
////                case 2:
////                    return tonic[solfaNote] + upTick1;
////                default:
////                    return tonic[solfaNote];
////            }
//    }
//  }
//
//  public function getBareText($keySig) {
//    if ($this->frequency == -1) {
//      return "-";
//    }
//    else {
//      if ($this->frequency == 0) {
//        return "x";
//      }
//      else {
//
////            $octave = frequency / 12;
//        $note = $this->frequency % 12;
//
//        $solfaNote = $note - $this->getDoh($keySig);
////        $noteCorrection;
////        if ($this->getDoh($keySig) < 10) {
//////            $noteCorrection = -1;
////        }
////        else {
//////            $noteCorrection = 0;
////        }
//        if ($solfaNote < 0) {
//          $solfaNote += 12;
////            $noteCorrection = -1;
//        }
//        else {
////            $noteCorrection = 0;
//        }
//
//        return static::$TONIC[$solfaNote];
//      }
//    }
//  }
//
//  // Make this function inline
//  public function getDoh($keySig) {
//    return ($keySig < 0) ? (5 * -$keySig) % 12 : (7 * $keySig) % 12;
//  }
//
}
