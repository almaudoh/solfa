/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package org.anieanie.music.solfa;

import javax.swing.plaf.metal.MetalTextFieldUI;
import javax.swing.text.DefaultEditorKit;
import javax.swing.text.Document;
import javax.swing.text.Element;
import javax.swing.text.View;
import javax.swing.text.ViewFactory;
import org.anieanie.music.solfa.SolfaDocument.*;
import org.anieanie.music.solfa.SolfaTableView.BeatView;
import org.anieanie.music.solfa.SolfaTableView.ChordView;

/**
 *
 * @author Aniebiet
 */
public class SolfaEditorKit extends DefaultEditorKit implements ViewFactory {

    public SolfaEditorKit() {
	super();
    }

    @Override
    public Document createDefaultDocument() {
        return new SolfaDocument();
    }

    @Override
    public ViewFactory getViewFactory() {
        return new MetalTextFieldUI();
        //return this;
    }

    @Override
    public String getContentType() {
        System.out.println("getContentType");
        return "text/solfa";
    }

    public View create(Element elem) {
        if (elem.getClass().equals(BarElement.class)) {
            return new SolfaTableView(elem);
        } else if (elem.getClass().equals(ChordElement.class)) {
            return new ChordView(elem);
        } else if (elem.getClass().equals(BeatElement.class)) {
            return new BeatView(elem);
        } else {
            return null;
        }
    }
    
}
