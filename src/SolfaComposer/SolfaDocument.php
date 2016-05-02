/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package org.anieanie.music.solfa;

import javax.swing.text.AbstractDocument.Content;
import javax.swing.text.AttributeSet;
import javax.swing.text.DefaultStyledDocument;
import javax.swing.text.AbstractDocument.BranchElement;
import javax.swing.text.BadLocationException;
import javax.swing.text.Element;
import javax.swing.text.GapContent;
import javax.swing.text.Segment;
import javax.swing.text.StyleContext;
import javax.swing.undo.UndoableEdit;

/**
 *
 * @author Aniebiet
 */
public class SolfaDocument extends DefaultStyledDocument {
    SolfaMidi midi;
    
    /**
     * Creates a new instance of SolfaDocument
     */
    public SolfaDocument () {
        super(new SolfaContent(), new StyleContext());
    }

    public SolfaDocument(StyleContext styles) {
        super(new SolfaContent(), styles);
    }

    public SolfaDocument(Content c, StyleContext styles) {
        super(c, styles);
    }
    
    /**
     * Creates a new instance of SolfaDocument
     */
    public SolfaDocument (SolfaMidi midi) {
    }

    // --- AbstractDocument methods ----------------------------

    /**
     * Updates document structure as a result of text insertion.  This
     * will happen within a write lock.  The superclass behavior of
     * updating the line map is executed followed by marking any comment
     * areas that should backtracked before scanning.
     *
     * @param chng the change event
     * @param attr the set of attributes
     */
//    protected void insertUpdate(DefaultDocumentEvent chng, AttributeSet attr) {
//	super.insertUpdate(chng, attr);
//	
//	// update comment marks
//	Element root = getDefaultRootElement();
//	DocumentEvent.ElementChange ec = chng.getChange(root);
//	if (ec != null) {
//	    Element[] added = ec.getChildrenAdded();
//	    boolean inComment = false;
//	    for (int i = 0; i < added.length; i++) {
//                System.out.println(added[i].getName());
//		Element elem = added[i];
//		int p0 = elem.getStartOffset();
//		int p1 = elem.getEndOffset();
//		String s;
//		try {
//		    s = getText(p0, p1 - p0);
//		} catch (BadLocationException bl) {
//		    s = null; 
//		}
//		if (inComment) {
//		    MutableAttributeSet a = (MutableAttributeSet) elem.getAttributes();
////		    a.addAttribute(CommentAttribute, CommentAttribute);
//		    int index = s.indexOf("*/");
//		    if (index >= 0) {
//			// found an end of comment, turn off marks
//			inComment = false;
//		    }
//		} else {
//		    // scan for multiline comment
//		    int index = s.indexOf("/*");
//		    if (index >= 0) {
//			// found a start of comment, see if it spans lines
//			index = s.indexOf("*/", index);
//			if (index < 0) {
//			    // it spans lines
//			    inComment = true;
//			}
//		    }
//		}
//	    }
//	}
//    }

    /**
     * Updates any document structure as a result of text removal.
     * This will happen within a write lock.  The superclass behavior of
     * updating the line map is executed followed by placing a lexical
     * update command on the analyzer queue.
     *
     * @param chng the change event
     */
//    protected void removeUpdate(DefaultDocumentEvent chng) {
//	super.removeUpdate(chng);
//	
//	// update comment marks
//    }

    public class BarElement extends BranchElement {
        public BarElement(Element parent, AttributeSet att) {
            super(parent, att);            
        }        
    }
    
    public class ChordElement extends BranchElement {
        public ChordElement(Element parent, AttributeSet att) {
            super(parent, att);
        }
    }

    public class BeatElement extends LeafElement {
        public BeatElement(Element parent, AttributeSet att, int offs0, int offs1) {
            super(parent, att, offs0, offs1);
        }
    }
    
    public static class SolfaContent extends GapContent {
        private SolfaNote[] notes;
        
        public SolfaContent(int initLen) {
            super(initLen);
            notes = new SolfaNote[getArrayLength()];
            //Need to parse existing content into SolfaNote array
        }

        public SolfaContent() {
            super();
        }

        @Override
        protected int getArrayLength() {
            return super.getArrayLength();
        }

        @Override
        public void getChars(int where, int len, Segment chars) throws BadLocationException {
            super.getChars(where, len, chars);
        }

        @Override
        protected Object allocateArray(int len) {
//            SolfaNote[] notes1 = notes;
//            notes = new SolfaNote[len];
//            if (notes1!=null && notes1.length>0) 
//                System.arraycopy(notes, 0, notes1, 0, Math.min(notes.length, notes1.length));
//            return super.allocateArray(len);
            return new SolfaBeat[len];
        }

        @Override
        public UndoableEdit insertString(int where, String str) throws BadLocationException {
            // Need to filter the string so that only permitted characters are allowed
            // Test code
            System.out.println(str);
            str = str.replaceAll("[^drmfsltd,.:]", "");
            // Need to update the underlying solfanote array with changes
            return super.insertString(where, str);
        }
        
        @Override
        public UndoableEdit remove(int where, int nitems) throws BadLocationException {
            // Need to update the underlying solfanote array with changes
            return super.remove(where, nitems);
        }
    }
}
