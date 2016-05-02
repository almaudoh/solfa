<?php

namespace KodeHauz\Solfa;

/**
 *
 * @author Aniebiet
 */
class SolfaNoteFactory {

  const DOH = 0;
  const DEE = 1;
  const RAY = 2;
  const REE = 3;
  const MEE = 4;
  const FAH = 5;
  const FEE = 6;
  const SOH = 7;
  const SEE = 8;
  const LAH = 9;
  const LEE = 10;
  const TEE = 11;

  //����?
  // The octave from which each part begins.
  // {"Soprano", "Alto", "Tenor", "Bass"}
  public static $PART_OCTAVE_BASE = array(
    'soprano' => 5,
    'alto' => 5,
    'tenor' => 4,
    'bass' => 4,
  );

  public static function sustainNote($length = 1) {
    return new Note(-1, $length, 0, '-');
  }
  public static function emptyNote($length = 1) {
    return new Note(-2, $length, 0, ' ');
  }

  public static function doh($length = 1, $octave = 0) {
    return new Note(SolfaNoteFactory::DOH, $length, $octave);
  }

  public static function dee($length = 1, $octave = 0) {
    return new Note(SolfaNoteFactory::DEE, $length, $octave);
  }

  public static function ray($length = 1, $octave = 0) {
    return new Note(SolfaNoteFactory::RAY, $length, $octave);
  }

  public static function ree($length = 1, $octave = 0) {
    return new Note(SolfaNoteFactory::REE, $length, $octave);
  }

  public static function mee($length = 1, $octave = 0) {
    return new Note(SolfaNoteFactory::MEE, $length, $octave);
  }

  public static function fah($length = 1, $octave = 0) {
    return new Note(SolfaNoteFactory::FAH, $length, $octave);
  }

  public static function fee($length = 1, $octave = 0) {
    return new Note(SolfaNoteFactory::FEE, $length, $octave);
  }

  public static function soh($length = 1, $octave = 0) {
    return new Note(SolfaNoteFactory::SOH, $length, $octave);
  }

  public static function see($length = 1, $octave = 0) {
    return new Note(SolfaNoteFactory::SEE, $length, $octave);
  }

  public static function lah($length = 1, $octave = 0) {
    return new Note(SolfaNoteFactory::LAH, $length, $octave);
  }

  public static function lee($length = 1, $octave = 0) {
    return new Note(SolfaNoteFactory::LEE, $length, $octave);
  }

  public static function tee($length = 1, $octave = 0) {
    return new Note(SolfaNoteFactory::TEE, $length, $octave);
  }

  public function getTick($keySig, $octaveBase) {
    if ($this->frequency == -1 || $this->frequency == 0) {
      return 0;
    }
    else {

      $octave = $this->frequency / 12;
      $note = $this->frequency % 12;

      $solfaNote = $note - $this->getDoh($keySig);
//        if (getDoh(keySig) < 10) {
////            noteCorrection = -1;
//        }
//        else {
////            noteCorrection = 0;
//        }

      if ($solfaNote < 0) {
        $solfaNote += 12;
        $noteCorrection = -1;
      }
      else {
        $noteCorrection = 0;
      }

      $solfaOctave = $octave - $octaveBase + $noteCorrection;
      //System.out.printf("Doh: %d, solfaNote: %d, solfaOctave: %d%n", getDoh(keySig), solfaNote, solfaOctave);

//            System.out.printf("%d %d %d 8ve:%d\n", frequency, keySig, octaveBase, solfaOctave);

      return $solfaOctave;
//            switch (solfaOctave) {
//                case -2:
//                    return tonic[solfaNote] + downTick1;
//                case -1:
//                    return tonic[solfaNote] + downTick0;
//                case 0:
//                    return tonic[solfaNote];
//                case 1:
//                    return tonic[solfaNote] + upTick0;
//                case 2:
//                    return tonic[solfaNote] + upTick1;
//                default:
//                    return tonic[solfaNote];
//            }
    }
  }

  public function getBareText($keySig) {
    if ($this->frequency == -1) {
      return "-";
    }
    else {
      if ($this->frequency == 0) {
        return "x";
      }
      else {

//            $octave = frequency / 12;
        $note = $this->frequency % 12;

        $solfaNote = $note - $this->getDoh($keySig);
//        $noteCorrection;
//        if ($this->getDoh($keySig) < 10) {
////            $noteCorrection = -1;
//        }
//        else {
////            $noteCorrection = 0;
//        }
        if ($solfaNote < 0) {
          $solfaNote += 12;
//            $noteCorrection = -1;
        }
        else {
//            $noteCorrection = 0;
        }

        return static::$TONIC[$solfaNote];
      }
    }
  }

  // Make this function inline
  public function getDoh($keySig) {
    return ($keySig < 0) ? (5 * -$keySig) % 12 : (7 * $keySig) % 12;
  }

}
