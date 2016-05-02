/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.anieanie.music.solfa;

import java.util.Enumeration;
import javax.swing.text.AttributeSet;
import javax.swing.text.MutableAttributeSet;
import javax.swing.text.Style;
import javax.swing.text.StyleContext;
import org.anieanie.midi.MetaEvent;

/**
 *
 * @author Aniebiet
 */
public class SolfaContext extends StyleContext {

    public static void runTest() {
        SolfaContext test = new SolfaContext();
        Style root = test.getRootStyle();
        root.addAttribute("name", "Aniebiet Udoh");
        root.addAttribute("KeySig", MetaEvent.getInstance(MetaEvent.KEY_SIGNATURE, null));
        root.addAttribute("TimeSig", MetaEvent.getInstance(MetaEvent.TIME_SIGNATURE, null));
        root.addAttribute("Tempo", MetaEvent.getInstance(MetaEvent.TEMPO, null));
        root.addAttribute("TrackName", MetaEvent.getInstance(MetaEvent.TRACK_NAME, "Default".getBytes()));

        Style s1 = test.createLineStyle("track1");
        s1.addAttribute("TrackName", MetaEvent.getInstance(MetaEvent.TRACK_NAME, "Soprano".getBytes()));

        Style s2 = test.createLineStyle("track2");
        s2.addAttribute("TrackName", MetaEvent.getInstance(MetaEvent.TRACK_NAME, "Alto".getBytes()));

        Style s3 = test.createLineStyle("track3");
        s3.addAttribute("TrackName", MetaEvent.getInstance(MetaEvent.TRACK_NAME, "Tenor".getBytes()));

        Style s4 = test.createLineStyle("track4");
        s4.addAttribute("TrackName", MetaEvent.getInstance(MetaEvent.TRACK_NAME, "Bass".getBytes()));

        addMetaEventAttribute(test.createBeatStyle(0), MetaEvent.TIME_SIGNATURE, MetaEvent.TIMESIG_3_4);
        addMetaEventAttribute(test.createBeatStyle(10), MetaEvent.TEMPO, MetaEvent.tempoByteArray(80));
        addMetaEventAttribute(test.createBeatStyle(20), MetaEvent.TEMPO, MetaEvent.tempoByteArray(120));
        addMetaEventAttribute(test.createBeatStyle(20), MetaEvent.TIME_SIGNATURE, MetaEvent.TIMESIG_4_4);

        System.out.println(s1.getAttribute("Tempo"));
        System.out.println(s1.getAttribute("TrackName"));
        System.out.println(s2.getAttribute("KeySig"));
        System.out.println(s3.getAttribute("TimeSig"));
        System.out.println(s4.getAttribute("name"));
        System.out.println(s3.getAttribute("TrackName"));
        System.out.println(root.getAttribute("name"));
        System.out.println(root.getAttribute("Name"));

        byte[] nsig = {3, 2, 24, 8};
        s3.addAttribute("TimeSig", MetaEvent.getInstance(MetaEvent.TIME_SIGNATURE, nsig));
        System.out.println(s3.getAttribute("TimeSig"));
        s3.removeAttribute("TimeSig");
        System.out.println(s3.getAttribute("TimeSig"));
        s3.removeAttribute("TrackName");
        System.out.println(s3.getAttribute("TrackName"));

        System.out.println(test.getCurrentBeatStyle().getAttribute("Tempo"));
        System.out.println(test.getBeatStyle(10).getAttribute("Tempo"));
        System.out.println(test.getBeatStyle(15).getAttribute(MetaEvent.describe(MetaEvent.TIME_SIGNATURE)));
        System.out.println(test.getBeatStyle(19).getAttribute(MetaEvent.describe(MetaEvent.TIME_SIGNATURE)));
        System.out.println(test.getBeatStyle(20).getAttribute(MetaEvent.describe(MetaEvent.TIME_SIGNATURE)));
    }
    
    public static void addMetaEventAttribute(MutableAttributeSet mas, int type, byte[] data) {
        MetaEvent evt = MetaEvent.getInstance(type, data);
        mas.addAttribute(evt.describe(), evt);
    }
    public static final String ROOT_STYLE = "ROOT";
//    private Style endstyle;
    private Style currstyle;
    private Style rootstyle;
    private ChainedIndexedStyle beatstyle;
    private AttributeSet temp;

    public SolfaContext() {
//        bstyles = new StyleContext.NamedStyle();
        rootstyle = new StyleContext.NamedStyle(ROOT_STYLE, null);
//        beat0style = createBeatStyle(0); // Create a default index style linked to the root
        beatstyle = new ChainedIndexedStyle("BEAT_STYLE", rootstyle);
        currstyle = beatstyle;
    }

    public void imposeLineStyle(Style lstyle) {
        temp = beatstyle.getResolveParent();
        beatstyle.setResolveParent(lstyle);
//        temp = beat0style.getResolveParent();
//        beat0style.setResolveParent(lstyle);
//        lstyle.setResolveParent(temp);
    }

    public void deposeLineStyle() {
        beatstyle.setResolveParent(temp);
//        beat0style.setResolveParent(temp);
    }

    public Style createBeatStyle(int beat) {
        currstyle = beatstyle.addStyle(beat);
        return currstyle;
//        Style[] styls = getSorroundingBeatStyles(beat); // Get existing index style if any
//
//        if (styls[0] == null) {
//            currstyle = new StyleContext.NamedStyle(String.valueOf(beat), rootstyle);
//            endstyle = currstyle;
//            return currstyle;
//        } else if (Integer.parseInt(styls[0].getName()) == beat) {
//            currstyle = styls[0];
//            return styls[0];
//        } else {
//            Style styl = new StyleContext.NamedStyle(String.valueOf(beat), styls[0]);
//            if (styls[1] != null) {
//                styls[1].setResolveParent(styl);
//            } else {
//                endstyle = styl;
//            }
//            currstyle = styl;
//            return styl;
//        }
    }

    public Style removeBeatStyle(int beat) {
        currstyle = beatstyle.removeStyle(beat);
        return currstyle;
//        Style[] styls = getSorroundingBeatStyles(beat); // Get existing index style if any
//
//        if (styls[0] == null) {
//            return null;
//        } else if (Integer.parseInt(styls[0].getName()) == beat) {
//            if (styls[1] == null) {
//                endstyle = (Style) styls[0].getResolveParent();
//                currstyle = endstyle;
//            } else {
//                styls[1].setResolveParent(styls[0].getResolveParent());
//                currstyle = (Style) styls[0].getResolveParent();
//            }
//            removeStyle(styls[0].getName());
//            return currstyle;
//        } else {
//            return null;
//        }
    }

    public Style createLineStyle(String name) {
        return addStyle(name, rootstyle);
//        return new StyleContext.NamedStyle(name, rootstyle);
    }

    public Style getRootStyle() {
        return rootstyle;
    }

    public Style getCurrentBeatStyle() {
        return currstyle;
    }

    public Style getLineStyle(String name) {
        return getStyle(name);
    }

    public Style getBeatStyle(int beat) {
//        Style styl = endstyle;
//        while (styl != null && Integer.parseInt(styl.getName()) > beat) {
//            styl = (Style) styl.getResolveParent();
//        }
//        return styl;
        return beatstyle.getStyle(beat);
    }
    
    public ChainedIndexedStyle getLineBeatStyle(String name) {
        Style lstyl = getLineStyle(name);
        Style bstyl=(Style)lstyl.getAttribute("BEAT_STYLE");
        if (bstyl==null || !(bstyl instanceof ChainedIndexedStyle)) {
            bstyl = new ChainedIndexedStyle(null, lstyl);
            lstyl.addAttribute("BEAT_STYLE", bstyl);
        }
        ChainedIndexedStyle styl = (ChainedIndexedStyle) bstyl;
        return styl;
    }
    
//    public Style addLineBeatStyle(int beat, String name) {
//        return getLineBeatStyle(name).addStyle(beat);
//    }

//    public Style removeLineBeatStyle(int beat, String name) {
//        Style lstyl = getLineStyle(name);
//        Style bstyl=(Style)lstyl.getAttribute("BEAT_STYLE");
//        if (bstyl==null || !(bstyl instanceof ChainedIndexedStyle)) {
//            bstyl = new ChainedIndexedStyle(null, lstyl);
//            lstyl.addAttribute("BEAT_STYLE", bstyl);
//        }
//        ChainedIndexedStyle styl = (ChainedIndexedStyle) bstyl;
//        return getLineBeatStyle(name).removeStyle(beat);
//    }
//
//    public Style getLineBeatStyle(int beat, String name) {
//        Style lstyl = getLineStyle(name);
//        Style bstyl=(Style)lstyl.getAttribute("BEAT_STYLE");
//        if (bstyl==null || !(bstyl instanceof ChainedIndexedStyle)) {
//            bstyl = new ChainedIndexedStyle(null, lstyl);
//            lstyl.addAttribute("BEAT_STYLE", bstyl);
//        }
//        ChainedIndexedStyle styl = (ChainedIndexedStyle) bstyl;
//        return getLineBeatStyle(name).getStyle(beat);
//    }

//    private Style[] getSorroundingBeatStyles(int beat) {
//        Style lstyl = null;
//        Style styl = endstyle;
//        while (styl != null && Integer.parseInt(styl.getName()) > beat) {
//            lstyl = styl;
//            styl = (Style) styl.getResolveParent();
//        }
//        Style[] ret = {styl, lstyl};
//        return ret;
//        if (bstyles.get(index) != null) {
//            return bstyles.get(index);
//        } else {
//            int lastidx=0;
//            for (int idx : bstyles.keySet()) {
//                if (idx<index && idx>lastidx) lastidx=idx;
//            }
//            return bstyles.get(lastidx);
//        }
//        }
//    }

    public class ChainedIndexedStyle extends StyleContext.NamedStyle {

        private Style endstyle;
        private Style beginstyle;

        public ChainedIndexedStyle(String name, Style parent) {
            super(name, parent);
            beginstyle = new StyleContext.NamedStyle(String.valueOf(0), parent);
            endstyle = beginstyle;
        }

        @Override
        public void setResolveParent(AttributeSet parent) {
            super.setResolveParent(parent);
            if (beginstyle!=null) beginstyle.setResolveParent(parent);
        }
        
        public String getStyleMarking(int index) {
            Style st = getStyle(index);
            if (Integer.parseInt(st.getName()) == index) {
                return st.getName();
            } else {
                return "";
            }
        }

        public Style getStyle(int index) {
            Style styl = endstyle;
            while (styl != null && Integer.parseInt(styl.getName()) > index) {
                styl = (Style) styl.getResolveParent();
            }
            return styl;
        }

        public Style addStyle(int index) {
            Style[] styls = getSorroundingStyles(index); // Get existing index style if any

            if (styls[0] == null) {
                beginstyle = new StyleContext.NamedStyle(String.valueOf(index), null);
                endstyle = beginstyle;
                return beginstyle;
            } else if (Integer.parseInt(styls[0].getName()) == index) {
                return styls[0];
            } else {
                Style styl = new StyleContext.NamedStyle(String.valueOf(index), styls[0]);
                if (styls[1] != null) {
                    styls[1].setResolveParent(styl);
                } else {
                    endstyle = styl;
                }
                return styl;
            }
        }

        public Style removeStyle(int index) {
            Style[] styls = getSorroundingStyles(index); // Get existing index style if any

            if (styls[0] == null) {
                return null;
            } else if (Integer.parseInt(styls[0].getName()) == index) {
                if (styls[1] == null) {
                    endstyle = (Style) styls[0].getResolveParent();
                } else {
                    styls[1].setResolveParent(styls[0].getResolveParent());
                }
                if (styls[0] == beginstyle) {
                    beginstyle = styls[1];
                }
                SolfaContext.this.removeStyle(styls[0].getName());
                if (beginstyle == null) {
                    endstyle = null;
                    return null;
                } else {
                    return currstyle;
                }
            } else {
                return null;
            }
        }

        private Style[] getSorroundingStyles(int index) {
            Style lstyl = null;
            Style styl = endstyle;
            while (styl != null && Integer.parseInt(styl.getName()) > index) {
                lstyl = styl;
                styl = (Style) styl.getResolveParent();
            }
            Style[] ret = {styl, lstyl};
            return ret;
        }
    }
}
