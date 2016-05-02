<?php

namespace KodeHauz\Tests\Solfa;
use KodeHauz\Solfa\Bar;
use KodeHauz\Solfa\Beat;
use KodeHauz\Solfa\SolfaNoteFactory;
use KodeHauz\Solfa\TextConverter;

/**
 * @coversClass \KodeHauz\TextConverter
 */
class TextConverterTest extends \PHPUnit_Framework_TestCase {

  protected $names;

  public function setUp() {
    $this->names = array_combine(TextConverter::$NOTATION['tonic'], TextConverter::$NOTATION['names']);
  }

  /**
   * @covers ::fromSolfaBeat
   */
  public function testFromSolfaBeat() {
    $solfa_beats = array();
    $solfa_beats[] = $this->getBeatFromNotes('d.250 r.250 m.250 f.250');
    $solfa_beats[] = $this->getBeatFromNotes('s.250 l.250 t.250 d.251');
    $this->assertEquals('d,r.m,f', TextConverter::fromSolfaBeat($solfa_beats[0]));
    $this->assertEquals('s,l.t,d\'', TextConverter::fromSolfaBeat($solfa_beats[1]));
  }

  public function testFromSolfaBar() {
    $solfa_beats = array();
    $solfa_beats[] = $this->getBeatFromNotes('d.250 r.250 m.250 f.250');
    $solfa_beats[] = $this->getBeatFromNotes('s.250 l.250 t.250 d.251');
    $solfa_beats[] = $this->getBeatFromNotes('l.250 f.250 m.250 r.250');
    $solfa_beats[] = $this->getBeatFromNotes('d.501 l.250 t.250');
    $solfa_bar2 = new Bar($solfa_beats);
    $this->assertEquals('d,r.m,f:s,l.t,d\'/l,f.m,r:d\'.l,t', TextConverter::fromSolfaBar($solfa_bar2));

    // Mix up different note types.
    $solfa_beats = array();
    $solfa_beats[] = $this->getBeatFromNotes('d1.01');
    $solfa_beats[] = $this->getBeatFromNotes('s.50-1 l.25-1 d.250');
    $solfa_beats[] = $this->getBeatFromNotes('r1.00');
    $solfa_beats[] = $this->getBeatFromNotes('l.50-1 t.50-1');
    $solfa_bar2 = new Bar($solfa_beats);
    $this->assertEquals('d\':s?.l?,d/r:l?.t?', TextConverter::fromSolfaBar($solfa_bar2));
  }

  protected function getBeatFromNotes($string) {
    $notes = array();
    foreach (explode(' ', $string) as $note_string) {
      $note = $note_string[0];
      $length = floatval(substr($note_string, 1, 3));
      $octave = intval(substr($note_string, 4));
      $notes[] = call_user_func_array(array(SolfaNoteFactory::class, $this->names[$note]), array($length, $octave));
    }
    return new Beat($notes);
  }

}
