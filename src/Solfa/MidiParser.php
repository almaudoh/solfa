<?php

namespace KodeHauz\Solfa;

use KodeHauz\Midi\Event\Track as MidiTrack;

/**
 * Parses files from Midi format into a structured solfa document.
 *
 * @package KodeHauz\Solfa
 */
class MidiParser {

  public function getCompiledNotes() {
    $compiled = array();
    $temp = array();
    $compiled[] = $this->notes[0];
    if ($this->notes[1] != Note::sustainNote() && !($this->notes[0] == $this->notes[1] && $this->notes[0] == Note::emptyNote())) {
      $compiled[] = static::$QUARTER_PUNCT;
      $compiled[] = $this->notes[1];
    }

    $temp[] = $this->notes[2];
    if ($this->notes[3] != Note::sustainNote() && !($this->notes[2] == $this->notes[3] && $this->notes[2] == Note::emptyNote())) {
      $temp[] = static::$QUARTER_PUNCT;
      $temp[] = $this->notes[3];
    }

    if (count($compiled) == 1 && count($temp) == 1) {
      if ($temp[0] != Note::sustainNote() && !($compiled[0] == $temp[0] && $compiled[0] == Note::emptyNote())) {
        $compiled[] = static::$HALF_PUNCT;
        $compiled[] = $temp[0];
      }
//            return ret;
    }
    else {
      $compiled[] = static::$HALF_PUNCT;
      foreach ($temp as $value) {
        $compiled[] = $value;
      }
    }

    return $compiled;
  }

  public function __toString() {
    return '';
  }

  public function toCompiledString() {
//    Vector str = getCompiledNotes();
//        StringBuffer buf = new StringBuffer();
//        for (int i = 0; i < str . size(){;}i++) {
//      buf . append(str . get(i) . toString());
//    }
//      return buf . toString();
  }

//    public String getText(int part, TrackInfo info, MetaInfo info2) {
  public function getText(SolfaContext $context, SolfaLine $parent) {
//        StringBuffer buf = new StringBuffer(7);
//        int octaveBase = (parent.getPart() > -1 && parent.getPart() < 4) ? static::partOctaveBase[parent.getPart()] : ((int) (parent.getTrackInfo().getHighestFrequency() + parent.getTrackInfo().getLowestFrequency()) / 24);
////        System.out.println(context.getLineBeatStyle(parent.getStyle().getName()));
//        Style styl = context.getLineBeatStyle(parent.getStyle().getName());
//        MetaEvent.KeySignature keySig = (MetaEvent.KeySignature) styl.getAttribute(MetaEvent.describe(MetaEvent.KEY_SIGNATURE));
//        int keysig = keySig.getData(0);
//
////        if ($this->notes[0] != null) {
////            buf.append($this->notes[0].getText(keysig, octaveBase));
////        }
////        for (int i = 1; i < 4; i++) {
////            if ($this->notes[i] != null) {
////                buf.append(',').append($this->notes[i].getText(keysig, octaveBase));
////            } else {
////                buf.append(", ");
////            }
////        }
////
//        Vector str = getCompiledNotes();
//        Object o;
//        for (int i=0;i<str.size();i++) {
//            o=str.get(i);
//            if (o instanceof SolfaNote) {
//                buf.append(((SolfaNote)o).getText(keysig, octaveBase));
////                System.out.print(((Note)o).getText(keysig, octaveBase));
//            }
//
//            else {
//              buf . append(str . get(i) . toString());
//            //                System.out.print(str.get(i).toString());
//            }
//}

//        buf = new StringBuffer(4);
//        if ($this->notes[0]==null) {
//            buf.append(static::$REST);
//        } else if ($this->notes[0].equals(Note::sustainNote())) {
//            buf.append(Note::sustainNote().getBareText(keysig));
//        } else {
//            buf.append($this->notes[0].getText(keysig));
//        }
//
////        if ($this->notes[1]==$this->notes[0] && $this->notes[0]==null || $this->notes[0]==Note::sustainNote()) {
//        if ($this->notes[1]!=Note::sustainNote()) {
//
//        } else {
//
//        }
// First pass, each quarter beat
//        String resp = buf.toString();
//        Pattern s1 = Pattern.compile("-,-");
//        Pattern r1 = Pattern.compile(" , ");
//        Pattern a1 = Pattern.compile("[a-zA-Z]{1,2}([]), ");
//
//        resp=s1.matcher(resp).replaceAll("-");
//        resp=r1.matcher(resp).replaceAll(" ");
//
//        Pattern s2 = Pattern.compile("-.-");
//        Pattern r2 = Pattern.compile(" . ");
//        Pattern a2 = Pattern.compile(" . ");
//
//        resp=s2.matcher(resp).replaceAll("-");
//        resp=r2.matcher(resp).replaceAll(" ");
//
//        buf.append(':');

//        for (int i=0; i<$this->notes.length; i+=4) {
//            if ($this->notes[i]==null) {
//                buf.append(static::$REST);
//            } else {
//                buf.append($this->notes[i].getText(info2.keySig[0], octaveBase));
//            }
//
//            if ($this->notes[i+1]==null) {
//                if ($this->notes[i]!=null) {
//                    buf.append(static::$QUARTER_PUNCT).append(static::$REST).append(static::$HALF_PUNCT);
//            } else if ($this->notes[i+1]!=null && !$this->notes[i+1].equals(Note::sustainNote())) {
//                vn[i/4] += static::$QUARTER_PUNCT + $this->notes[i+1].getText(parent.info.keySig[0], octaveBase) + static::$HALF_PUNCT;
//            }
//
//            if ($this->notes[i+2]==null) {
//                if (vn[i/4].endsWith(static::$HALF_PUNCT)) {
//                    vn[i/4] += static::$REST;
//                } else {
//                    if ($this->notes[i+1]!=null) {
//                        vn[i/4] += static::$HALF_PUNCT + static::$REST;
//                    }
//                }
//            } else if (!$this->notes[i+2].equals(Note::sustainNote())) {
//                if (!vn[i/4].endsWith(static::$HALF_PUNCT)) {
////                if ($this->notes[i+1]!=null && $this->notes[i+1].equals(Note::sustainNote())) {
//                    vn[i/4] += static::$HALF_PUNCT;
//                }
//                vn[i/4] += $this->notes[i+2].getText(parent.info.keySig[0], octaveBase);
//            } else {
//                if (vn[i/4].endsWith(static::$HALF_PUNCT)) {
////                if (!$this->notes[i+1].equals(Note::sustainNote()) && $this->notes[i+2].equals(Note::sustainNote())) {
//                    vn[i/4] += $this->notes[i+2].getText(parent.info.keySig[0], octaveBase);
//                }
//            }
//
//            if (i+3<$this->notes.length) {
//                if ($this->notes[i+3]==null) {
//                    if ($this->notes[i+2]!=null) {
//                        if (!vn[i/4].endsWith(static::$HALF_PUNCT)) {
//                            vn[i/4] += static::$HALF_PUNCT;
//                        }
//                        vn[i/4] += static::$QUARTER_PUNCT + static::$REST;
//                    }
//                } else if (!($this->notes[i+3].equals(Note::sustainNote()))) {
//                    if (!vn[i/4].endsWith(static::$HALF_PUNCT)) {
////                if ($this->notes[i+2]!=null && $this->notes[i+2].equals(Note::sustainNote()) && $this->notes[i+1].equals(Note::sustainNote())) {
//                        vn[i/4] += static::$HALF_PUNCT;
//                    }
//                    vn[i/4] += static::$QUARTER_PUNCT + $this->notes[i+3].getText(parent.info.keySig[0], octaveBase);
//                }
//            }
//        }
//return buf.toString();
}
//    protected function parseTrack(Track $tr, Sequence $seq, long $timeSigD) {
protected function parseTrack(MidiTrack $midi_track) {
  $bars = array();
  $track = new Track();
  $track->setName($midi_track->get)
  return $track;
//  MidiEvent me;
//  MidiMessage mm;
//  ShortMessage sms;
//  MetaMessage met;

//  SolfaContext c = script.getContext();
//  Style lstyl = c.createLineStyle("track" + tnum + "_style");
//  SolfaContext.addMetaEventAttribute(lstyl, MetaEvent.TRACK_NAME, lstyl.getName().getBytes());
//  SolfaLine line = new Track(lstyl);

        int len = tickToQuarterBeat((Long) c.getRootStyle().getAttribute("TickLength"), c);

        SolfaNote[] notes = new Note[len + 5];
        SolfaLine.TrackInfo info = line.getTrackInfo();

        // Flags
        boolean inNote = false;
        int nct = 0;
        int box;
        int lastbox = 0;
        for (int i = 0; i < tr.size(); i++) {
    me = tr.get(i);
    mm = me.getMessage();
    box = tickToQuarterBeat(me.getTick(), c);

    if (mm instanceof ShortMessage) {
      sms = (ShortMessage) mm;
                switch (sms.getStatus() & 0xF0) {
                  case ShortMessage.CHANNEL_PRESSURE:
                    //Command value for Channel Pressure (Aftertouch) message (0xD0, or 208)
//                        System.out.print(" Channel Pressure! ");
                    break;
                  case ShortMessage.CONTROL_CHANGE:
                    //Command value for Control Change message (0xB0, or 176)
//                        System.out.print(" Control Change! ");
                    break;
                  case ShortMessage.NOTE_ON:
                    //Command value for Note On message (0x90, or 144)
                    if (sms.getData2() > 0) {    // Velocity of zero is equivalent to Note Off
//                            System.out.printf("\nBox[%d]", box);
//                            System.out.printf(" Note on! %d %d ", sms.getData1(), sms.getData2());
                      int freq = sms.getData1();
                            int vel = sms.getData2();
                            // Set Highest and lowest frequency
                            if (freq > info.hifreq) {
                              info.hifreq = freq;
                            }
                            if (freq < info.lofreq) {
                              info.lofreq = freq;
                            }
//                            box = (int) (beat * 4); // + GAP_ALLOWANCE);

                            if (inNote) {
                              for (int k = lastbox + 1; k < box; k++) {
                                if (notes[k] == null) {
                                  notes[k] = SolfaNote.SUSTAIN;
                                    }
                                }
                            }
                            if (notes[box] == null) {
                        notes[box] = new Note(freq, vel);
                            }
                            inNote = true;
                            lastbox = box;
                            break;
                        } else {
                      /* Velocity of 0 is equal to noteoff,
                       * so fall through to note off section
                       */
//                            inNote = false;
                    }
                  case ShortMessage.NOTE_OFF:
                    //Command value for Note Off message (0x80, or 128)
//                        System.out.printf("\nBox[%d]", box);
//                        System.out.printf(" Note off! %d %d ", sms.getData1(), sms.getData2());
//                        box = beat;
                    if (inNote) {
                      for (int k = lastbox + 1; k <= box; k++) {
                        if (notes[k] == null) {
                          notes[k] = SolfaNote.SUSTAIN;
                                }
                            }
                        }
                    inNote = false;
                    lastbox = box;
                    nct++;  // Increment number of notes in track (a note is marked by its end)
                    break;
                  case ShortMessage.PITCH_BEND:
                    //Command value for Pitch Bend message (0xE0, or 224)
//                        System.out.print(" Pitch Bend! ");
                    break;
                  case ShortMessage.POLY_PRESSURE:
                    //Command value for Polyphonic Key Pressure (Aftertouch) message (0xA0, or 128)
//                        System.out.print(" Poly Pressure! ");
                    break;
                  case ShortMessage.PROGRAM_CHANGE:
                    //Command value for Program Change message (0xC0, or 192)
//                        System.out.print(" Program Change! ");
                    break;
                  default:
                    switch (sms.getStatus()) {
                      case ShortMessage.ACTIVE_SENSING:
                        //Status byte for Active Sensing message (0xFE, or 254).
                        break;
                      case ShortMessage.CONTINUE:
                                //Status byte for Continue message (0xFB, or 251).
                                break;
                      case ShortMessage.END_OF_EXCLUSIVE:
                        //Status byte for End of System Exclusive message (0xF7, or 247).
                        break;
                      case ShortMessage.MIDI_TIME_CODE:
                        //Status byte for MIDI Time Code Quarter Frame message (0xF1, or 241).
                        break;
                      case ShortMessage.SONG_POSITION_POINTER:
                        //Status byte for Song Position Pointer message (0xF2, or 242).
                        break;
                      case ShortMessage.SONG_SELECT:
                        //Status byte for MIDI Song Select message (0xF3, or 243).
                        break;
                      case ShortMessage.START:
                        //Status byte for Start message (0xFA, or 250).
                        break;
                      case ShortMessage.STOP:
                        //Status byte for Stop message (0xFC, or 252).
                        break;
                      case ShortMessage.SYSTEM_RESET:
                        //Status byte for System Reset message (0xFF, or 255).
                        break;
                      case ShortMessage.TIMING_CLOCK:
                        //Status byte for Timing Clock messagem (0xF8, or 248).
                        break;
                      case ShortMessage.TUNE_REQUEST:
                        break;
                      default:
                        break;
                    }
                }
            } else if (mm instanceof SysexMessage) {
      //System.out.print(((SysexMessage)mm).getData()[0]);
//                System.out.print(" SysexMessage\n");
    } else if (mm instanceof MetaMessage) {
      met = (MetaMessage) mm;
//                MetaEvent evt = MetaEvent.getInstance(met.getType(), met.getData());
//                line.addBeatStyle(beat, evt);
//                System.out.println(MetaEvent.getInstance(met.getType(), met.getData()));

                // Separate root level, track level and beat level metas
                switch (((MetaMessage) mm).getType()) {
        // Overall root level
      case MetaEvent.COPYRIGHT:
                    case MetaEvent.SMPTE_OFFSET:
                        SolfaContext.addMetaEventAttribute(c.getRootStyle(), met.getType(), met.getData());
                        break;
                    // Root level beats
                    case MetaEvent.TEMPO:
                    case MetaEvent.TIME_SIGNATURE:
                    case MetaEvent.CUE_POINT:
                        SolfaContext.addMetaEventAttribute(c.createBeatStyle(box), met.getType(), met.getData());
                        break;
                    // Overall track level
                    case MetaEvent.TRACK_NAME:
                    case MetaEvent.DEVICE_NAME:
                        SolfaContext.addMetaEventAttribute(lstyl, met.getType(), met.getData());
                        break;
                    // Track level beats
                    case MetaEvent.KEY_SIGNATURE:
                    case MetaEvent.TEXT:
                    case MetaEvent.LYRIC:
                    case MetaEvent.MARKER:
                    case MetaEvent.PROGRAM_NAME:
                    case MetaEvent.INSTRUMENT:
                    case MetaEvent.PROPRIETARY:
                    case MetaEvent.END_OF_TRACK:
                        SolfaContext.addMetaEventAttribute(c.getLineBeatStyle(lstyl.getName()).addStyle(box), met.getType(), met.getData());
                        break;
                }
            } else {
    }
  }  // END: for (int i = 0; i < tr.size(); i++)

//        AttributeSet s = c.getCurrentBeatStyle();
//        MetaEvent.KeySignature keysig = (MetaEvent.KeySignature) s.getAttribute(MetaEvent.describe(MetaEvent.KEY_SIGNATURE));
//        if (keysig == null) {
//            Beat.DEFAULT_KEYSIG = 4;   // Default timeSignature = 4/4;
//
//        } else {
//            Beat.DEFAULT_KEYSIG = keysig.getData(0);
//        }

        // Create beats based on the notes
        SolfaBeat sbeat;
        int xtra = 0;
        for (int i = 0; i < notes.length; i += 4) {
    sbeat = new Beat();
    if (i + 3 >= notes.length) {
      xtra++;
    } else {
      sbeat.addNote(0, notes[i]);
                sbeat.addNote(1, notes[i + 1]);
                sbeat.addNote(2, notes[i + 2]);
                sbeat.addNote(3, notes[i + 3]);
//                System.out.print(sbeat.toString());
                line.addBeat(sbeat);
            }
  }
        // Update number of notes in line
        line.getStyle().addAttribute("NoteCount", nct);

        System.out.printf("Extra: %d\n", xtra);
        line.updatePart();
        return line;
    }
/**
 * $this loads the MIDI track attributes at tick==0;
 *
 * @returns true if something was loaded
 */
protected function loadAttributesfromMidiTrack(Track $tr, SolfaContext $context) {
  MidiEvent me;
        MidiMessage mm;
        MetaMessage met;
        int smct = 0;
        boolean loaded = false;

        for (int i = 0; i < tr.size(); i++) {
    me = tr.get(i);
    mm = me.getMessage();
    if (mm instanceof ShortMessage) {
      smct += 1;
    } else if (mm instanceof SysexMessage) {
      System.out.print(" SysexMessage");
            } else if (mm instanceof MetaMessage) {
      met = (MetaMessage) mm;
                if (me.getTick() == 0) {
                  SolfaContext.addMetaEventAttribute(context.getRootStyle(), met.getType(), met.getData());
                  loaded = true;
                } else {
                  int beat = tickToQuarterBeat(me.getTick(), context);
                    SolfaContext.addMetaEventAttribute(context.createBeatStyle(beat), met.getType(), met.getData());
                    loaded = true;
                }
            }
  }
//        System.out.println(context.getRootStyle().getAttribute("Track Name").toString());
        return loaded;
    }

public function tickToQuarterBeat(long $tick, SolfaContext $context) {
  AttributeSet s = context.getCurrentBeatStyle();
        MetaEvent.TimeSignature timesig = (MetaEvent.TimeSignature) s.getAttribute(MetaEvent.describe(MetaEvent.TIME_SIGNATURE));
        int timeSigD;
        if (timesig == null) {
          timeSigD = 4;   // Default timeSignature = 4/4;

        } else {
          timeSigD = timesig.getBottom();
        }

        // Parameters
        // Formulas:
        // beatSize (ppb) = ppq * qpb (ppb = pulses/beat; ppq = pulses/quarter; qpb=quarternotes/beat)
        //                = ppq * 4 / timeSigD
        // "Resolution" in ppq or ppf (pulses/frame)
        // ticks/beat (ppq) = ticks/frame (ppf) * frames/sec * microsec/beat * sec/microsec
        //              ppq = ppf * - SMPTE{0} * raw tempo * 10e-6

        int ppq = (Integer) s.getAttribute("Resolution");
        float dt;
        if ((dt = seq.getDivisionType()) != Sequence.PPQ) {
          ppq = (int) (ppq * dt * ((MetaEvent.Tempo) s.getAttribute("Tempo")).getMPQ());
        }

        int qbeatSize = ppq / timeSigD;
//        Note[] notes = new Note[(int) (((Long) s.getAttribute("TickLength")) / beatSize) * 4];
//        Track.TrackInfo info = line.getTrackInfo();
//        metas = new Vector<MetaEvent>();
        // Flags
//        System.out.printf("\n %d / %d = %d", tick, qbeatSize, (int) (tick / qbeatSize));
        return (int) (tick / qbeatSize);
//        return (int) tick;
    }

public function parseToSolfa(SolfaScript $script) {
  if (seq == null) {
    return;
  }
  Track[] tracks = seq.getTracks();
        SolfaLine line;
        for (int i = 0; i < tracks.length; i++) {
    line = parseTrack(i, tracks[i], script);
            script.addSolfaLine(line);
//            lines[i] = new Track(tracks[i], context);
        }
    }

//    protected function metaInfoIncomplete() {
//        return (info.keysig == null || info.tempo == null || info.tempo == null);
//    }
}