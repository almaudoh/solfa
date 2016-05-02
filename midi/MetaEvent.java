/*
 * MetaEvent.java
 *
 * Created on August 28, 2007, 2:48 PM
 *
 * To change this template, choose Tools | Template Manager
 * and open the template in the editor.
 */
package org.anieanie.midi;

/**
 *
 * @author Aniebiet
 */
public class MetaEvent {

    public static final byte TEXT = 0x01;
    public static final byte COPYRIGHT = 0x02;
    public static final byte TRACK_NAME = 0x03;
    public static final byte INSTRUMENT = 0x04;
    public static final byte LYRIC = 0x05;
    public static final byte MARKER = 0x06;
    public static final byte CUE_POINT = 0x07;
    public static final byte PROGRAM_NAME = 0x08;
    public static final byte DEVICE_NAME = 0x09;
    public static final byte END_OF_TRACK = 0x2F;
    public static final byte TEMPO = 0x51;
    public static final byte SMPTE_OFFSET = 0x54;
    public static final byte TIME_SIGNATURE = 0x58;
    public static final byte KEY_SIGNATURE = 0x59;
    public static final byte PROPRIETARY = 0x7F;
    protected byte[] datarray;
    protected int type;

    // Ready made byte arrays for use
    // TIMESIGs
    public static final byte[] TIMESIG_2_2 = {2, 1, 24, 8};
    public static final byte[] TIMESIG_2_4 = {2, 2, 24, 8};
    public static final byte[] TIMESIG_4_4 = {4, 2, 24, 8};
    public static final byte[] TIMESIG_3_2 = {3, 1, 24, 8};
    public static final byte[] TIMESIG_3_4 = {3, 2, 24, 8};
    public static final byte[] TIMESIG_3_8 = {3, 3, 24, 8};
    public static final byte[] TIMESIG_6_8 = {6, 3, 24, 8};

    // KEYSIGs
    public static final byte[] KEYSIG_C_MAJ = {0, 0};
    public static final byte[] KEYSIG_C_MIN = {0, 1};
    public static final byte[] KEYSIG_G_MAJ = {1, 0};
    public static final byte[] KEYSIG_G_MIN = {1, 1};
    public static final byte[] KEYSIG_D_MAJ = {2, 0};
    public static final byte[] KEYSIG_D_MIN = {2, 1};
    public static final byte[] KEYSIG_A_MAJ = {3, 0};
    public static final byte[] KEYSIG_A_MIN = {3, 1};
    public static final byte[] KEYSIG_E_MAJ = {4, 0};
    public static final byte[] KEYSIG_E_MIN = {4, 1};
    public static final byte[] KEYSIG_B_MAJ = {5, 0};
    public static final byte[] KEYSIG_B_MIN = {5, 1};
    public static final byte[] KEYSIG_Fx_MAJ = {6, 0};
    public static final byte[] KEYSIG_Fx_MIN = {6, 1};
    public static final byte[] KEYSIG_F_MAJ = {-1, 0};
    public static final byte[] KEYSIG_F_MIN = {-1, 1};
    public static final byte[] KEYSIG_Bb_MAJ = {-2, 0};
    public static final byte[] KEYSIG_Bb_MIN = {-2, 1};
    public static final byte[] KEYSIG_Eb_MAJ = {-3, 0};
    public static final byte[] KEYSIG_Eb_MIN = {-3, 1};
    public static final byte[] KEYSIG_Ab_MAJ = {-4, 0};
    public static final byte[] KEYSIG_Ab_MIN = {-4, 1};
    public static final byte[] KEYSIG_Db_MAJ = {-5, 0};
    public static final byte[] KEYSIG_Db_MIN = {-5, 1};
    public static final byte[] KEYSIG_Gb_MAJ = {-6, 0};
    public static final byte[] KEYSIG_Gb_MIN = {-6, 1};

    // TEMPOs
    public static final byte[] tempoByteArray(int bpm) {
        long mpq = 60000000L / bpm;
        byte[] ret = new byte[3];
        ret[2] = (byte) (mpq & 0x000000FF);
        ret[1] = (byte) (mpq >> 8 & 0x000000FF);
        ret[0] = (byte) (mpq >> 16 & 0x000000FF);
        return ret;
    }

    public static final MetaEvent getInstance(int type, byte[] data) {
        MetaEvent inst = new MetaEvent();
        return inst.createInstance(type, data);
    }

    /** Creates a new instance of MetaEvent */
    private MetaEvent() {
    }

    protected MetaEvent(int type, byte[] data) {
        this(type, data, 0, data.length);
    }

    protected MetaEvent(int type, byte[] data, int start, int length) {
        this.type = type;
        datarray = new byte[length];
        if (data != null) {
            System.arraycopy(data, start, datarray, 0, length);
        }
    }

    public byte getData(int index) {
        return datarray[index];
    }

    public void printString() {
        StringBuilder sb = new StringBuilder();
        sb.append("FF ").append(Integer.toHexString(type));
        for (int i = 0; i < datarray.length; i++) {
            if (datarray[i] < 0) {
                sb.append(" ").append(Integer.toHexString(datarray[i]).substring(6));
            } else {
                sb.append(" ").append(Integer.toHexString(datarray[i]));
            }
        }
        System.out.println(sb.toString());
    }

    @Override
    public String toString() {
        StringBuilder sb = new StringBuilder("FF ");
        sb.append(Integer.toHexString(type).toUpperCase());
        if (datarray != null) {
            for (int i = 0; i < datarray.length; i++) {
                if (datarray[i] < 0) {
                    sb.append(" ").append(Integer.toHexString(datarray[i]).substring(6));
                } else {
                    sb.append(" ").append(Integer.toHexString(datarray[i]));
                }
            }
        }
        return sb.toString();
    }

    public String describe() {
        return MetaEvent.describe(type);
    }

    protected final MetaEvent createInstance(int type, byte[] data) {
        switch (type) {
            case TEXT:
            case COPYRIGHT:
            case TRACK_NAME:
            case INSTRUMENT:
            case LYRIC:
            case MARKER:
            case CUE_POINT:
            case PROGRAM_NAME:
            case DEVICE_NAME:
                return new MetaEvent.TextMetaEvent(type, data);
            case END_OF_TRACK:
                return new MetaEvent.GenericMetaEvent(type, data);
            case TEMPO:
                return new MetaEvent.Tempo(data);
            case SMPTE_OFFSET:
                return new MetaEvent.GenericMetaEvent(type, data);
            case TIME_SIGNATURE:
                return new MetaEvent.TimeSignature(data);
            case KEY_SIGNATURE:
                return new MetaEvent.KeySignature(data);
            case PROPRIETARY:
                return new MetaEvent.GenericMetaEvent(type, data);
            default:
                return new MetaEvent.GenericMetaEvent(type, data);
        }
    }

    public static final String describe(int type) {
        switch (type) {
            case TEXT:
                return "Text";
            case COPYRIGHT:
                return "Copyright";
            case TRACK_NAME:
                return "Track Name";
            case INSTRUMENT:
                return "Instrument";
            case LYRIC:
                return "Lyric";
            case MARKER:
                return "Marker";
            case CUE_POINT:
                return "Cue Point";
            case PROGRAM_NAME:
                return "Program Name";
            case DEVICE_NAME:
                return "Device Name";
            case END_OF_TRACK:
                return "End of Track";
            case TEMPO:
                return "Tempo";
            case SMPTE_OFFSET:
                return "SMPTE Offset";
            case TIME_SIGNATURE:
                return "Time Signature";
            case KEY_SIGNATURE:
                return "Key Signature";
            case PROPRIETARY:
                return "Proprietary";
            default:
                return Integer.toHexString(type);
        }
    }

    /**
     * <b>Key Signature</b><br/>
     * FF 59 02 <b>sf mi</b> <br/>
     * <b>sf</b> = -7 for 7 flats, -1 for 1 flat, etc, 0 for key of c, 1 for 1 sharp, etc.<br/>
     * <b>mi</b> = 0 for major, 1 for minor
     */
    public class KeySignature extends MetaEvent {

//        private byte[] datarray;
        public final String[] STRINGFORM = {"B", "Gb", "Db", "Ab", "Eb", "Bb", "F", "C", "G", "D", "A", "E", "B", "F#", "C#"};

        public KeySignature(byte[] data) {
            super(MetaEvent.KEY_SIGNATURE, data, 0, 2);
//            datarray = new byte[2];
//            System.arraycopy(data, 0, datarray, 0, 2);
            if (datarray[0] < -7 || datarray[0] > 7) {
                datarray[0] = 0;//datarray[0]%7;

            }
            if (datarray[1] < 0 || datarray[1] > 1) {
                datarray[1] = 0;
            }
        }

        public KeySignature() {
            this(new byte[2]);
        }

        @Override
        public String toString() {
            StringBuilder buf = new StringBuilder("Key ");
            buf.append(STRINGFORM[datarray[0] + 7]).append(" ").append((datarray[1] == 0) ? "major" : "minor");
            return buf.toString();
        }
    }

    /**
     * <b>Time Signature</b><br/>
     * FF 58 04 <b>nn dd cc bb</b><br/> 
     * Time signature is expressed as 4 numbers. <b>nn</b> and <b>dd</b> represent the "numerator" and "denominator" of the 
     * signature as notated on sheet music. The denominator is a negative power of 2: 2 = quarter note, 3 = eighth, etc. 
     * The <b>cc</b> expresses the number of MIDI clocks in a metronome click. 
     * The <b>bb</b> parameter expresses the number of notated 32nd notes in a MIDI quarter note (24 MIDI clocks). 
     * This event allows a program to relate what MIDI thinks of as a quarter, to something entirely different. 
     * For example, 6/8 time with a metronome click every 3 eighth notes and 24 clocks per quarter note would 
     * be the following event: 
     * FF 58 04 06 03 18 08 
     * <b>NOTE:</b> If there are no time signature events in a MIDI file, then the time signature is assumed to be 4/4.
     * <p>
     * In a format 0 file, the time signatures changes are scattered throughout the one MTrk. In format 1, the 
     * very first MTrk should consist of only the time signature (and tempo) events so that it could be read by 
     * some device capable of generating a "tempo map". It is best not to place MIDI events in this MTrk. 
     * In format 2, each MTrk should begin with at least one initial time signature (and tempo) event. 
     * </p>
     */
    public class TimeSignature extends MetaEvent {
//        private byte[] datarray;

        public TimeSignature(byte[] data) {
            super(MetaEvent.TIME_SIGNATURE, data, 0, 4);
//            datarray = new byte[4];
            if (data == null) { // Default values

                byte[] dt = {4, 2, 24, 8};
                System.arraycopy(dt, 0, datarray, 0, 4);
            }
//            else {
//                System.arraycopy(data, 0, datarray, 0, 4);
//            }
        }

        public TimeSignature() {
            this(null);
        }

        public int getTop() {
            return datarray[0];
        }

        public int getBottom() {
            return 1 << datarray[1];
        }

        @Override
        public String toString() {
            int top = datarray[0];
            int bot = 1 << datarray[1];
            return new StringBuilder().append(top).append("/").append(bot).toString();
        }
    }

    /** <b>Tempo</b><br/>
     * FF 51 03 <b>tt tt tt</b> <br/>
     * Indicates a tempo change. The 3 data bytes of tt tt tt are the tempo in microseconds per quarter note. 
     * In other words, the microsecond tempo value tells you how long each one of your sequencer's "quarter 
     * notes" should be. For example, if you have the 3 bytes of 07 A1 20, then each quarter note should be 
     * 0x07A120 (or 500,000) microseconds long. 
     * So, the MIDI file format expresses tempo as "the amount of time (ie, microseconds) per quarter note". 
     * <b>NOTE:</b> If there are no tempo events in a MIDI file, then the tempo is assumed to be 120 BPM 
     * <p>  
     * In a format 0 file, the tempo changes are scattered throughout the one MTrk. In format 1, the very 
     * first MTrk should consist of only the tempo (and time signature) events so that it could be read by 
     * some device capable of generating a "tempo map". It is best not to place MIDI events in this MTrk. 
     * In format 2, each MTrk should begin with at least one initial tempo (and time signature) event.
     * </p>     
     * To convert the Tempo Meta-Event's tempo (ie, the 3 bytes that specify the amount of microseconds 
     * per quarter note) to BPM: <br/>
     * <pre>
     *      BPM = 60,000,000/(tt tt tt) </pre>
     * For example, a tempo of <code>120 BPM = 07 A1 20</code> microseconds per quarter note. 
     */
    public class Tempo extends MetaEvent {

        public Tempo(byte[] data) {
            super(MetaEvent.TEMPO, data, 0, 3);
            if (data == null) { // Default values

                byte[] dt = {0x07, (byte) 0xA1, 0x20};
                System.arraycopy(dt, 0, datarray, 0, 3);
            }
            datarray[2] &= 0x000000FF;
            datarray[1] &= 0x000000FF;
            datarray[0] &= 0x000000FF;
        }

        public Tempo() {
            this(null);
        }

        public Tempo(int bpm) {
            super(MetaEvent.TEMPO, null, 0, 3);
            long mpq = 60000000L / bpm;
            datarray = new byte[3];
            datarray[2] = (byte) (mpq & 0x000000FF);
            datarray[1] = (byte) (mpq >> 8 & 0x000000FF);
            datarray[0] = (byte) (mpq >> 16 & 0x000000FF);
        }

        public int getBPM() {
            int x = (datarray[0] << 16) & 0x00FF0000;
            int y = (datarray[1] << 8) & 0x0000FF00;
            int z = datarray[2] & 0x000000FF;
            int mpq = x + y + z;
            return 60000000 / mpq;
        }

        public int getMPQ() {
            int x = (datarray[0] << 16) & 0x00FF0000;
            int y = (datarray[1] << 8) & 0x0000FF00;
            int z = datarray[2] & 0x000000FF;
            return x + y + z;
        }

        @Override
        public String toString() {
            int x = (datarray[0] << 16) & 0x00FF0000;
            int y = (datarray[1] << 8) & 0x0000FF00;
            int z = datarray[2] & 0x000000FF;
            int mpq = x + y + z;
            int bpm = 60000000 / mpq;
            return new StringBuilder().append(bpm).append(" bpm").toString();
        }
    }

    /**
     * <b>Text</b><br/>
     * FF 01 <b>len text</b><br/>
     * Any amount of text (amount of bytes = len) for any purpose. 
     * <p>
     * It's best to put this event at the beginning of an MTrk. Although this text could be used for any purpose, 
     * there are other text-based Meta-Events for such things as orchestration, lyrics, track name, etc. 
     * This event is primarily used to add "comments" to a MIDI file which a program would be expected to ignore 
     * when loading that file. 
     * <p>
     * Note that len could be a series of bytes since it is expressed as a variable length quantity. 
     * <p>
     * 
     * <b>Copyright</b><br/>
     * FF 02 <b>len text</b><br/>
     * A copyright message. 
     * <p>
     * It's best to put this event at the beginning of an MTrk. 
     * <p>
     * Note that len could be a series of bytes since it is expressed as a variable length quantity. 
     * <p>
     * 
     * <b>Sequence/Track Name</b><br/>
     * FF 03 <b>len text</b><br/>
     * The name of the sequence or track. 
     * <p>
     * It's best to put this event at the beginning of an MTrk. 
     * <p>
     * Note that len could be a series of bytes since it is expressed as a variable length quantity. 
     * <p>
     * 
     * <b>Instrument</b><br/>
     * FF 04 <b>len text</b><br/> 
     * The name of the instrument (ie, MIDI module) being used to play the track. This may be different 
     * than the Sequence/Track Name. For example, maybe the name of your sequence (ie, Mtrk) is "Butterfly", 
     * but since the track is played upon a Roland S-770, you may also include an Instrument Name of "Roland S-770".
     * <p>
     * It's best to put one (or more) of this event at the beginning of an MTrk to provide the user with 
     * identification of what instrument(s) is playing the track. Usually, the instruments (ie, patches, 
     * tones, banks, etc) are setup on the audio devices via MIDI Program Change and MIDI Bank Select 
     * Controller events within the MTrk. So, this event exists merely to provide the user with visual 
     * feedback of what instruments are used for a track. </p><p>
     * <p>
     * Note that len could be a series of bytes since it is expressed as a variable length quantity.</p>
     * <p>
     *
     * <b>Lyric</b><br/>
     * FF 05 <b>len text</b><br/>
     * A song lyric which occurs on a given beat. 
     * <p>
     * A single Lyric MetaEvent should contain only one syllable. 
     * <p>
     * Note that len could be a series of bytes since it is expressed as a variable length quantity. 
     * <p>
     * 
     * <b>Marker</b><br/>
     * FF 06 <b>len text</b><br/>
     * The text for a marker which occurs on a given beat. 
     * <p>
     * Marker events might be used to denote a loop start and loop end (ie, where the sequence loops 
     * back to a previous event). 
     * <p>
     * Note that len could be a series of bytes since it is expressed as a variable length quantity. 
     * <p>
     * 
     * <b>Cue Point</b><br/>
     * FF 07 <b>len text</b><br/>
     * The text for a cue point which occurs on a given beat. 
     * <p>
     * A Cue Point might be used to denote where a WAVE (ie, sampled sound) file starts playing, 
     * for example, where the text would be the WAVE's filename. 
     * <p>
     * Note that len could be a series of bytes since it is expressed as a variable length quantity.
     * <p>
     * 
     * <b>Program Name</b><br/>
     * FF 08 <b>len text</b><br/>
     * The name of the program (ie, patch) used to play the MTrk. 
     * <p>
     * This may be different than the Sequence/Track Name. For example, maybe the name of your sequence 
     * (ie, Mtrk) is "Butterfly", but since the track is played upon an electric piano patch, you may also 
     * include a Program Name of "ELECTRIC PIANO".
     * <p>
     * Usually, the instruments (ie, patches, tones, banks, etc) are setup on the audio devices via MIDI 
     * Program Change and MIDI Bank Select Controller events within the MTrk. So, this event exists merely 
     * to provide the user with visual feedback of what particular patch is used for a track. But it can 
     * also give a hint to intelligent software if patch remapping needs to be done. For example, if the 
     * MIDI file was created on a non-General MIDI instrument, then the MIDI Program Change event will 
     * likely contain the wrong value when played on a General MIDI instrument. Intelligent software can 
     * use the Program Name event to look up the correct value for the MIDI Program Change event.
     * <p>
     * Note that len could be a series of bytes since it is expressed as a variable length quantity.
     * <p>
     * 
     * <b>Device (Port) Name</b><br/>
     * FF 09 <b>len text</b><br/>
     * The name of the MIDI device (port) where the track is routed. 
     * <p>
     * This replaces the "MIDI Port" Meta-Event which some sequencers formally used to route MIDI tracks 
     * to various MIDI ports (in order to support more than 16 MIDI channels). 
     * <p>
     * For example, assume that you have a MIDI interface that has 4 MIDI output ports. They are listed as 
     * "MIDI Out 1", "MIDI Out 2", "MIDI Out 3", and "MIDI Out 4". If you wished a particular MTrk to use 
     * "MIDI Out 1" then you would put a Port Name Meta-event at the beginning of the MTrk, with "MIDI Out 1" 
     * as the text. 
     * <p>
     * All MIDI events that occur in the MTrk, after a given Port Name event, will be routed to that port.
     * In a format 0 MIDI file, it would be permissible to have numerous Port Name events intermixed with MIDI 
     * events, so that the one MTrk could address numerous ports. But that would likely make the MIDI file much 
     * larger than it need be. The Port Name event is useful primarily in format 1 MIDI files, where each MTrk 
     * gets routed to one particular port. 
     * <p>
     * Note that len could be a series of bytes since it is expressed as a variable length quantity.
     */
    public class TextMetaEvent extends MetaEvent {

        public TextMetaEvent(int type, byte[] data) {
            super(type, data);
        }

        @Override
        public String toString() {
//            return new StringBuilder(getMetaText()).append(" [").append(describe()).append(']').toString();
//        }
//        
//        public String getMetaText() {
            StringBuilder ret = new StringBuilder();
            for (int i = 0; i < datarray.length; i++) {
                ret.append((char) datarray[i]);
            }
            return ret.toString();
        }
    }

    public class Dynamic {

        private static final int FORTISSISSIMO = 5;
        private static final int FORTISSIMO = 4;
        private static final int FORTE = 3;
        private static final int MEZZOFORTE = 2;
        private static final int MEZZOPIANO = 1;
        private static final int PIANO = 0;
        private static final int PIANISSIMO = -1;
        private static final int PIANISSISSIMO = -2;
    }

    public class Expression {
    }

    public class GenericMetaEvent extends MetaEvent {

        public GenericMetaEvent (int type, byte[] data) {
            super(type, data);
        }
    }
    /**
     * <b>End of Track</b><br/>
     * FF 2F 00<br/>
     * This event is not optional. It must be the last event in every MTrk. It's used as a definitive marking of 
     * the end of an MTrk. Only 1 per MTrk. 
     */
    /**
     * <b>SMPTE Offset</b><br/>
     * FF 54 05 <b>hr mn se fr ff</b><br/>
     * Designates the SMPTE start time (hours, minutes, seconds, frames, subframes) of the MTrk. It should be at 
     * the start of the MTrk. The hour should not be encoded with the SMPTE format as it is in MIDI Time Code. 
     * In a format 1 file, the SMPTE OFFSET must be stored with the tempo map (ie, the first MTrk), and has no 
     * meaning in any other MTrk. The ff field contains fractional frames in 100ths of a frame, even in SMPTE 
     * based MTrks which specify a different frame subdivision for delta-times (ie, different from the subframe 
     * setting in the MThd).
     */
    /**
     * <b>Proprietary Event</b><br/>
     * FF 7F <b>len data<b><br/>
     * This can be used by a program to store proprietary data. The first byte(s) should be a unique ID of some 
     * sort so that a program can identify whether the event belongs to it, or to some other program. A 4 character 
     * (ie, ascii) ID is recommended for such. 
     * <p>
     * Note that len could be a series of bytes since it is expressed as a variable length quantity. 
     */
}
