<?php

namespace KodeHauz\Solfa;
use KodeHauz\Solfa\Track;

/**
 * Converts solfa into text representations and vice-versa.
 */
class TextConverter {

  const HALF_PUNCT = ".";
  const QUARTER_PUNCT = ",";

  const SINGLE_BEAT_MARK = ":";
  const SINGLE_BAR_MARK = "|";
  const HALF_BAR_MARK = "/";

  const DOWN_TICK_2 = -2;
  const DOWN_TICK_1 = -1;
  const NO_TICK = 0;
  const UP_TICK_1 = 1;
  const UP_TICK_2 = 2;

  const REST = -2;
  const SUSTAIN = -1;

  public static $TICKS = array(
    -4 => "-4",
    -3 => "-3",
    -2 => "-2",
    -1 => "?",
    0 => "",
    1 => "'",
    2 => "2",
    3 => "3",
    4 => "4"
  );

  public static $NOTATION = array(
    'normal' => array('C', 'C#', 'D', 'Eb', 'E', 'F', 'F#', 'G', 'Ab', 'A', 'Bb', 'B', -1 => '-', -2 => ' '),
    'tonic' => array('d', 'de', 'r', 're', 'm', 'f', 'fe', 's', 'se', 'l', 'le', 't', -1 => '-', -2 => ' '),
    'tonic2' => array('d', 'ra', 'r', 'ma', 'm', 'f', 'ba', 's', 'la', 'l', 'ta', 't', -1 => '-', -2 => ' '),
    'names' => array('doh', 'dee', 'ray', 'ree', 'mee', 'fah', 'fee', 'soh', 'see', 'lah', 'lee', 'tee', -1 => '-', -2 => ' '),
    'names2' => array('doh', 'raw', 'ray', 'maw', 'mee', 'fah', 'baw', 'soh', 'law', 'lah', 'taw', 'tee', -1 => '-', -2 => ' '),
  );

  public static function getNoteName(Note $note) {
    return static::$NOTATION['tonic'][$note->getValue()];
  }

  /**
   * Gets the solfa beat as a string.
   */
  public static function fromSolfaBeat(Beat $beat) {
    $string = '';
    $total_length = 0;
    foreach ($beat->getNotes() as $note) {
      $total_length += $note->getLength();
      if ($total_length > 0.5) {
        $total_length -= 0.5;
      }
      $string .= static::getNoteName($note) . static::getMarkForOctave($note->getOctave()) . static::getMarkForLength($total_length);
    }
    return trim($string, static::HALF_PUNCT . static::QUARTER_PUNCT);
  }

  public static function fromSolfaBar(Bar $bar) {
    $string = '';
    $beat_count = 0;
    $beats_per_bar = $bar->getBeatsPerBar();
    foreach ($bar->getBeats() as $beat) {
      $beat_count++;
      if ($beats_per_bar > 2 && $beat_count === $beats_per_bar / 2) {
        $mark = static::HALF_BAR_MARK;
      }
      else {
        $mark = static::SINGLE_BEAT_MARK;
      }
      $string .= static::fromSolfaBeat($beat) . $mark;
    }
    return trim($string, static::HALF_BAR_MARK . static::SINGLE_BEAT_MARK);
  }

  public static function fromSolfaTrack(Track $track) {
    $string = '';
    $total_length = 0;
    foreach ($track->getBars() as $bar) {
      $string .= static::fromSolfaBar($bar) . static::SINGLE_BAR_MARK;
    }
    return trim($string, static::SINGLE_BAR_MARK);
  }

  public function printHTML(Track $track) {
    // Move this later to a separate print routine
//        $string = '<table>';
//        foreach ($line : lines) {
////            line.printLine();
//            System.out.print(line.getAsHtmlRow(context));
//        }
//        System.out.print('</table>\n');
//          return $string;
  }

  public function getHTML() {
    // Move this later to a separate print routine
//        StringBuffer buf = new StringBuffer("<html><body><h2>");
//        buf.append(context.getRootStyle().getAttribute(MetaEvent.describe(MetaEvent.TEXT))).append("</h2><h3 align='left'>");
//        buf.append(context.getRootStyle().getAttribute(MetaEvent.describe(MetaEvent.KEY_SIGNATURE))).append("&nbsp;");
//        buf.append(context.getRootStyle().getAttribute(MetaEvent.describe(MetaEvent.TIME_SIGNATURE))).append("</h3>");
//        buf.append("<table border=1 cellspacing=0 cellpadding=4 style=\"border-collapse:collapse;font-size:10px;font-family:Arial;text-align:center\" align=\"center\">");
//        for (Track line : lines) {
////            line.printLine(context);
//            buf.append(line.getAsHtmlRow(context));
//        }
//
//        buf.append("</table></body></html>\n");
//        System.out.println(buf);
//        return "public String getHTML() {\nreturn buf.toString();\n}\n";
////        return buf.toString();
  }

  protected function getMarkForLength($length) {
    switch ($length) {
//      case 0:
      case 1:
        return '';
      case 0.5:
        return static::HALF_PUNCT;
      case 0.25:
        return static::QUARTER_PUNCT;
      default:
        return '';
    }
  }

  protected function getMarkForOctave($octave) {
    return static::$TICKS[$octave];
  }

  public function getScript() {
//      SolfaContext context = new SolfaContext();
//      topstyle = context.createRootStyle("root");
//      loadAttributesfromMidiTrack(seq.getTracks()[0]);
//      topstyle=context.add(topstyle, "DivisionType", seq.getDivisionType());
//      topstyle=context.addAttribute(topstyle, "DivisionType", seq.getDivisionType());
//      topstyle=context.addAttribute(topstyle, "MicrosecondLength", seq.getMicrosecondLength());
//      topstyle=context.addAttribute(topstyle, "Resolution", seq.getResolution());
//      topstyle=context.addAttribute(topstyle, "TickLength", seq.getTickLength());
//      Style topstyle = context.getRootStyle();
//      topstyle.addAttribute("DivisionType", seq.getDivisionType());
//      topstyle.addAttribute("MicrosecondLength", seq.getMicrosecondLength());
//      topstyle.addAttribute("Resolution", seq.getResolution());
//      topstyle.addAttribute("TickLength", seq.getTickLength());
//
//      // Initialize default attributes needed for parsing
//      SolfaContext.addMetaEventAttribute(topstyle, MetaEvent.TIME_SIGNATURE, null);
//      SolfaContext.addMetaEventAttribute(topstyle, MetaEvent.KEY_SIGNATURE, null);
//      SolfaContext.addMetaEventAttribute(topstyle, MetaEvent.TEMPO, null);
//
//      loadAttributesfromMidiTrack(seq.getTracks()[0], context);
//      loadBeatStylesfromMidiTrack(seq.getTracks()[0], topstyle);
//      getMetaData(seq.getTracks()[0]);
//      for (int i = 1; i < seq.getTracks().length && metaInfoIncomplete(); i++) {
//          getMetaData(seq.getTracks()[i]);
//      }
//      System.out.println(getContext());
//      System.out.printf("KeySig:%s%nTimeSig:%s%nTempo:%s%n", info.keysig, info.timesig, info.tempo);
//      System.out.println(getContext().getStyle("name"));
//      System.out.println(getContext().getStyle("root"));
//      SolfaScript script = new SolfaScript(context);
//      parseToSolfa(script);
//      return script;
  }

//    public function getContext() {
//        return context;
//    }
//public function getVisualStyles(SolfaContext context) {
//String[] vn = new String[beats.size() + 1];
//
//for (int i = 0; i < beats.size(); i++) {
//vn[i + 1] = context.getLineBeatStyle(style.getName()).getStyleMarking(i);
//}
//
//vn[0] = "";
//        return vn;
//    }

//    public function getMetaCount() { // int
//        return metas.size();
//    }
//
  public function getStyle() { // Style
    return $this->style;
  }

  public function setStyle(Style $style) { // function
    $this->style = $style;
  }

  public function getTrackInfo() { // TrackInfo
    return $this->info;
  }

  public function printLine(SolfaContext $context) { // function
//        System.out.println(Main.arrayAsString(parent.info.keysig));

//        for (int i=0;i<beats.length;i++) {
////            System.out.print(beats[i]);
//            if (beats[i]!=null) {
//                System.out.printf("|%s", beats[i].getText(parent.info.keysig[0]), octaveBase);
//            } else {
//                System.out.print("| ");
//            }
//        }
//        System.out.println();
//
//    String[] vn = getVisualStyles(context);
//        for (int i = 0; i < vn . length {
//          ;
//        } i++) {
//      if (vn[i] != NULL) {
//        System . out . printf("|%s", vn[i]);
//            } else {
//        System . out .print("| ");
//            }
//        }
//        System . out . println();
//
//        vn = getVisualNotes(context);
//        for (int i = 0; i < vn . length {
//          ;
//        } i++) {
//      if (vn[i] != NULL) {
//        System . out . printf("|%s", vn[i]);
//            } else {
//        System . out .print("| ");
//            }
//        }
//        System . out . println();
//    }
//
//  public function getAsHtmlRow(SolfaContext context) { // function
//        String[] vn = getVisualStyles(context);
//        StringBuffer buf = new StringBuffer("<tr>");
//        for (int i = 0; i < vn.length; i++) {
//            if (vn[i] != null && !vn[i].trim().equals("")) {
//                buf.append("<td>").append(vn[i]).append("</td>");
//            }
//
//else {
//  buf . append("<td>&nbsp;</td>");
//}
//}
//buf . append("</tr>\n");
//
//buf . append("<tr>");
//vn = getVisualNotes(context);
//for (int i = 0; i < vn . length {
//  ;
//}
//i++) {
//  if (vn[i] != NULL && !vn[i] . trim() . equals("")) {
//    buf . append("<td>") . append(vn[i]).append("</td>");
//            } else {
//    buf . append("<td>&nbsp;</td>");
//  }
//        }
//        buf . append("</tr>\n");
//        return buf . toString();
//    }
//
//    public String[] getVisualNotes(SolfaContext context) {
//  SolfaBeat bt;
//        SolfaBeat . DEFAULT_KEYSIG = -1;
//        String[] vn = new String[beats . size() + 1];
////        int i = 0;
//        for (int i = 1; i < beats . size() + 1 {
//          ;
//        } i++) {
////        for (Beat bt : beats) {
//    bt = beats . get(i - 1);
////            System.out.print(bt.toString());
////            System.out.print(bt.getText(context, this));
//    if (bt != NULL) {
//      vn[i] = bt . getText(context, this);
//            }
//    else {
//      vn[i] = " ";
//            }
//  }
////        System.out.println();
//        vn[0] = info . trackname;
//        String[] vn = new String[beats.length / 4 + 1];
//        int octaveBase = ($this->part>-1 && $this->part<4)?Note.partOctaveBase[$this->part]:((int)(info.hifreq+info.lofreq)/24);
////        System.out.print(info.toString());
////        System.out.println(octaveBase);
//
//        for (int i=0; i<beats.length; i+=4) {
//            if (beats[i]==null) {
//                vn[i/4] = Note.REST;
//            } else {
//                vn[i/4] = beats[i].getText(parent.info.keysig.getData(0), octaveBase);
//            }
//
//            if (beats[i+1]==null && beats[i]!=null) {
//                vn[i/4] += Note.QTRPUNCT + Note.REST + Note.HALFPUNCT;
//            } else if (beats[i+1]!=null && !beats[i+1].equals(Note.SUSTAIN)) {
//                vn[i/4] += Note.QTRPUNCT + beats[i+1].getText(parent.info.keysig.getData(0), octaveBase) + Note.HALFPUNCT;
//            }
//
//            if (beats[i+2]==null) {
//                if (vn[i/4].endsWith(Note.HALFPUNCT)) {
//                    vn[i/4] += Note.REST;
//                } else {
//                    if (beats[i+1]!=null) {
//                        vn[i/4] += Note.HALFPUNCT + Note.REST;
//                    }
//                }
//            } else if (!beats[i+2].equals(Note.SUSTAIN)) {
//                if (!vn[i/4].endsWith(Note.HALFPUNCT)) {
////                if (beats[i+1]!=null && beats[i+1].equals(Note.SUSTAIN)) {
//                    vn[i/4] += Note.HALFPUNCT;
//                }
//                vn[i/4] += beats[i+2].getText(parent.info.keysig.getData(0), octaveBase);
//            } else {
//                if (vn[i/4].endsWith(Note.HALFPUNCT)) {
////                if (!beats[i+1].equals(Note.SUSTAIN) && beats[i+2].equals(Note.SUSTAIN)) {
//                    vn[i/4] += beats[i+2].getText(parent.info.keysig.getData(0), octaveBase);
//                }
//            }
//
//            if (i+3<beats.length) {
//                if (beats[i+3]==null) {
//                    if (beats[i+2]!=null) {
//                        if (!vn[i/4].endsWith(Note.HALFPUNCT)) {
//                            vn[i/4] += Note.HALFPUNCT;
//                        }
//                        vn[i/4] += Note.QTRPUNCT + Note.REST;
//                    }
//                } else if (!(beats[i+3].equals(Note.SUSTAIN))) {
//                    if (!vn[i/4].endsWith(Note.HALFPUNCT)) {
////                if (beats[i+2]!=null && beats[i+2].equals(Note.SUSTAIN) && beats[i+1].equals(Note.SUSTAIN)) {
//                        vn[i/4] += Note.HALFPUNCT;
//                    }
//                    vn[i/4] += Note.QTRPUNCT + beats[i+3].getText(parent.info.keysig.getData(0), octaveBase);
//                }
//            }
//        }
//        return new String[10];
        return vn;
    }
}
