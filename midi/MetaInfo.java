/*
 * MetaInfo.java
 *
 * Created on August 30, 2007, 11:15 AM
 *
 * To change this template, choose Tools | Template Manager
 * and open the template in the editor.
 */

package org.anieanie.midi;

import org.anieanie.midi.MetaEvent.KeySignature;
import org.anieanie.midi.MetaEvent.Tempo;
import org.anieanie.midi.MetaEvent.TimeSignature;

/**
 *
 * @author Aniebiet
 */
public class MetaInfo {
    public KeySignature keysig;
    public TimeSignature timesig;
    public Tempo tempo;
    
    /**
     * Creates a new instance of MetaInfo
     */
    public MetaInfo() {
    }
    
    /**
     * Creates a new instance of MetaInfo copying from existing MetaInfo
     */        
    public MetaInfo(MetaInfo info) {
//        keysig = new byte[info.keysig.length]; 
//        System.arraycopy(info.keysig,0,keysig,0,info.keysig.length);
//        
//        timesig = new byte[info.timesig.length]; 
//        System.arraycopy(info.timesig,0,timesig,0,info.timesig.length);
//        
//        tempo = new byte[info.tempo.length]; 
//        System.arraycopy(info.tempo,0,tempo,0,info.tempo.length);
//        
//        System.out.println(keysig);
//        System.out.println(timesig);
//        System.out.println(tempo);
    }
    
}
