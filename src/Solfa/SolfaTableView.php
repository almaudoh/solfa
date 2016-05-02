/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.anieanie.music.solfa;

import java.awt.Color;
import java.awt.Component;
import java.awt.Font;
import java.awt.FontMetrics;
import java.awt.Graphics;
import java.awt.Graphics2D;
import java.awt.Rectangle;
import java.awt.Shape;
import javax.swing.JComponent;
import javax.swing.SizeRequirements;
import javax.swing.text.BadLocationException;
import javax.swing.text.Element;
import javax.swing.text.Position;
import javax.swing.text.Position.Bias;
import javax.swing.text.Segment;
import javax.swing.text.TableView;
import javax.swing.text.Utilities;
import javax.swing.text.View;
import sun.swing.SwingUtilities2;


/**
 *
 * @author Aniebiet
 */
public class SolfaTableView extends TableView {

    public SolfaTableView(Element elem) {
        super(elem);
    }

    /**
     * Lays out the columns to fit within the given target span.
     * Returns the results through {@code offsets} and {@code spans}.
     *
     * @param targetSpan the given span for total of all the table
     *  columns
     * @param reqs the requirements desired for each column.  This
     *  is the column maximum of the cells minimum, preferred, and
     *  maximum requested span
     * @param spans the return value of how much to allocated to
     *  each column
     * @param offsets the return value of the offset from the
     *  origin for each column
     */
    /**
     * I need to override this to create physical rows corresponding
     * to logical rows. This can simply be done by creating an array of
     * "linebreaks" which specify the column at which the logical row
     * will be broken into a new physical row. 
     * 
     * @param targetSpan
     * @param offsets
     * @param spans
     * @param reqs
     */
    @Override
    protected void layoutColumns(int targetSpan, int[] offsets, int[] spans,
            SizeRequirements[] reqs) {
        // allocate using the convenience method on SizeRequirements
        SizeRequirements.calculateTiledPositions(targetSpan, null, reqs,
                offsets, spans);
    }

    public class SolfaTableRow extends TableRow {

        public SolfaTableRow(Element elem) {
            super(elem);
        }
    }

    public static class ChordView extends TableView {

        public ChordView(Element elem) {
            super(elem);
        }
    }

    public static class BeatView extends View {

        /**
         * Constructs a new PartView wrapped on an element.
         *
         * @param elem the element
         */
        public BeatView(Element elem) {
            super(elem);
        }

        private String getText() {
            return getElement().getName();
        }

        /**
         * Checks to see if the font metrics and longest line
         * are up-to-date.
         * 
         * @since 1.4
         */
//        protected void updateMetrics() {
//            Component host = getContainer();
//            Font f = host.getFont();
//            if (font != f) {
//                // The font changed, we need to recalculate the
//                // longest line.
//                calculateLongestLine();
////                tabSize = getTabSize() * metrics.charWidth('m');
//            }
//        }

        // ---- View methods ----------------------------------------------------
        /**
         * Determines the preferred span for this view along an
         * axis.
         *
         * @param axis may be either View.X_AXIS or View.Y_AXIS
         * @return   the span the view would like to be rendered into >= 0.
         *           Typically the view is told to render into the span
         *           that is returned, although there is no guarantee.  
         *           The parent may choose to resize or break the view.
         * @exception IllegalArgumentException for an invalid axis
         */
        public float getPreferredSpan(int axis) {
//            updateMetrics();
            switch (axis) {
                case View.X_AXIS:
                    return getBeatWidth();
                case View.Y_AXIS:
                    return getElement().getElementCount() * metrics.getHeight();
                default:
                    throw new IllegalArgumentException("Invalid axis: " + axis);
            }
        }

        /**
         * Renders using the given rendering surface and area on that surface.
         * The view may need to do layout and create child views to enable
         * itself to render into the given allocation.
         *
         * @param g the rendering surface to use
         * @param a the allocated region to render into
         *
         * @see View#paint
         */
        public void paint(Graphics g, Shape a) {
//            Shape originalA = a;
//            Rectangle alloc = (Rectangle) a;
//            tabBase = alloc.x;
//            JTextComponent host = (JTextComponent) getContainer();
//            Highlighter h = host.getHighlighter();
//            g.setFont(host.getFont());
//            sel0 = host.getSelectionStart();
//            sel1 = host.getSelectionEnd();
//            unselected = (host.isEnabled()) ? host.getForeground() : host.getDisabledTextColor();
//            Caret c = host.getCaret();
//            selected = c.isSelectionVisible() && h != null ? host.getSelectedTextColor() : unselected;
////            updateMetrics();
//
//            // If the lines are clipped then we don't expend the effort to
//            // try and paint them.  Since all of the lines are the same height
//            // with this object, determination of what lines need to be repainted
//            // is quick.
//            Rectangle clip = g.getClipBounds();
//            int fontHeight = metrics.getHeight();
//            int heightBelow = (alloc.y + alloc.height) - (clip.y + clip.height);
//            int linesBelow = Math.max(0, heightBelow / fontHeight);
//            int heightAbove = clip.y - alloc.y;
//            int linesAbove = Math.max(0, heightAbove / fontHeight);
//            int linesTotal = alloc.height / fontHeight;
//
//            if (alloc.height % fontHeight != 0) {
//                linesTotal++;
//            }
//            // update the visible lines
            Rectangle lineArea = lineToRect(a, 0);
            int y = lineArea.y + metrics.getAscent();
            int x = lineArea.x;
////            Element map = getElement();
////            int lineCount = map.getElementCount();
////            int endLine = Math.min(lineCount, linesTotal - linesBelow);
////            lineCount--;
//            LayeredHighlighter dh = (h instanceof LayeredHighlighter) ? (LayeredHighlighter) h : null;
//            for (int line = linesAbove; line < endLine; line++) {
//                if (dh != null) {
//                    Element lineElement = map.getElement(line);
//                    if (line == lineCount) {
//                        dh.paintLayeredHighlights(g, lineElement.getStartOffset(),
//                                lineElement.getEndOffset(),
//                                originalA, host, this);
//                    } else {
//                        dh.paintLayeredHighlights(g, lineElement.getStartOffset(),
//                                lineElement.getEndOffset() - 1,
//                                originalA, host, this);
//                    }
//                }
//                drawLine(line, g, x, y);
//                y += fontHeight;
//                if (line == 0) {
//                    // This should never really happen, in so far as if
//                    // firstLineOffset is non 0, there should only be one
//                    // line of text.
//                    x -= firstLineOffset;
//                }
//            }
            Graphics2D g2d = (Graphics2D) g;
//            if (this != null) {
            Component component = this.getContainer();
            if (component instanceof JComponent) {
//                return (JComponent)component;
                SwingUtilities2.drawString((JComponent) component, g2d, getText(), x, y);
            } else {
//            }
                g2d.drawString(getText(), x, y);
            }
        }

        /**
         * Should return a shape ideal for painting based on the passed in
         * Shape <code>a</code>. This is useful if painting in a different
         * region. The default implementation returns <code>a</code>.
         */
//        Shape adjustPaintRegion(Shape a) {
//            return a;
//        }
        /**
         * Provides a mapping from the document model coordinate space
         * to the coordinate space of the view mapped to it.
         *
         * @param pos the position to convert >= 0
         * @param a the allocated region to render into
         * @return the bounding box of the given position
         * @exception BadLocationException  if the given position does not
         *   represent a valid location in the associated document
         * @see View#modelToView
         */
        public Shape modelToView(int pos, Shape a, Position.Bias b) throws BadLocationException {
            // line coordinates
//            Document doc = getDocument();
            Element beat = getElement();
            int lineIndex = beat.getElementIndex(pos);
//            if (lineIndex < 0) {
//                return lineToRect(a, 0);
//            }
//            Rectangle lineArea = lineToRect(a, lineIndex);
            Rectangle lineArea = lineToRect(a, 0);

            // determine span from the start of the line
            tabBase = lineArea.x;
//            GapContent
            Element line = beat.getElement(lineIndex);
            int p0 = line.getStartOffset();
//            Segment s = SegmentCache.getSharedSegment();
            Segment s = new Segment();
//            doc.getText(p0, pos - p0, s);
            int xOffs = Utilities.getTabbedTextWidth(s, metrics, tabBase, null, p0);
//            SegmentCache.releaseSharedSegment(s);

            // fill in the results and return
            lineArea.x += xOffs;
            lineArea.width = 1;
            lineArea.height = metrics.getHeight();
            return lineArea;
        }
        /**
         * Provides a mapping from the view coordinate space to the logical
         * coordinate space of the model.
         *
         * @param fx the X coordinate >= 0
         * @param fy the Y coordinate >= 0
         * @param a the allocated region to render into
         * @return the location within the model that best represents the
         *  given point in the view >= 0
         * @see View#viewToModel
         */
        public int viewToModel(float fx, float fy, Shape a, Position.Bias[] bias) {
//            // PENDING(prinz) properly calculate bias
//            bias[0] = Position.Bias.Forward;
//
//            Rectangle alloc = a.getBounds();
//            Document doc = getDocument();
//            int x = (int) fx;
//            int y = (int) fy;
//            if (y < alloc.y) {
//                // above the area covered by this icon, so the the position
//                // is assumed to be the start of the coverage for this view.
//                return getStartOffset();
//            } else if (y > alloc.y + alloc.height) {
//                // below the area covered by this icon, so the the position
//                // is assumed to be the end of the coverage for this view.
//                return getEndOffset() - 1;
//            } else {
//                // positioned within the coverage of this view vertically,
//                // so we figure out which line the point corresponds to.
//                // if the line is greater than the number of lines contained, then
//                // simply use the last line as it represents the last possible place
//                // we can position to.
//                Element map = doc.getDefaultRootElement();
//                int lineIndex = Math.abs((y - alloc.y) / metrics.getHeight());
//                if (lineIndex >= map.getElementCount()) {
//                    return getEndOffset() - 1;
//                }
//                Element line = map.getElement(lineIndex);
//                int dx = 0;
//                if (lineIndex == 0) {
//                    alloc.x += firstLineOffset;
//                    alloc.width -= firstLineOffset;
//                }
//                if (x < alloc.x) {
//                    // point is to the left of the line
//                    return line.getStartOffset();
//                } else if (x > alloc.x + alloc.width) {
//                    // point is to the right of the line
//                    return line.getEndOffset() - 1;
//                } else {
//                    // Determine the offset into the text
//                    try {
//                        int p0 = line.getStartOffset();
//                        int p1 = line.getEndOffset() - 1;
//                        Segment s = SegmentCache.getSharedSegment();
//                        doc.getText(p0, p1 - p0, s);
//                        tabBase = alloc.x;
//                        int offs = p0 + Utilities.getTabbedTextOffset(s, metrics,
//                                tabBase, x, this, p0);
//                        SegmentCache.releaseSharedSegment(s);
//                        return offs;
//                    } catch (BadLocationException e) {
//                        // should not happen
//                        return -1;
//                    }
//                }
//            }
            return 0;
        }
        /**
         * Gives notification that something was inserted into the document
         * in a location that this view is responsible for.
         *
         * @param changes the change information from the associated document
         * @param a the current allocation of the view
         * @param f the factory to use to rebuild if the view has children
         * @see View#insertUpdate
         */
//        public void insertUpdate(DocumentEvent changes, Shape a, ViewFactory f) {
//            updateDamage(changes, a, f);
//        }
        /**
         * Gives notification that something was removed from the document
         * in a location that this view is responsible for.
         *
         * @param changes the change information from the associated document
         * @param a the current allocation of the view
         * @param f the factory to use to rebuild if the view has children
         * @see View#removeUpdate
         */
//        public void removeUpdate(DocumentEvent changes, Shape a, ViewFactory f) {
//            updateDamage(changes, a, f);
//        }
        /**
         * Gives notification from the document that attributes were changed
         * in a location that this view is responsible for.
         *
         * @param changes the change information from the associated document
         * @param a the current allocation of the view
         * @param f the factory to use to rebuild if the view has children
         * @see View#changedUpdate
         */
//        public void changedUpdate(DocumentEvent changes, Shape a, ViewFactory f) {
//            updateDamage(changes, a, f);
//        }
        /**
         * Sets the size of the view.  This should cause 
         * layout of the view along the given axis, if it 
         * has any layout duties.
         *
         * @param width the width >= 0
         * @param height the height >= 0
         */
        public void setSize(float width, float height) {
            super.setSize(width, height);
//            updateMetrics();
        }

        // --- TabExpander methods ------------------------------------------
        /**
         * Returns the next tab stop position after a given reference position.
         * This implementation does not support things like centering so it
         * ignores the tabOffset argument.
         *
         * @param x the current position >= 0
         * @param tabOffset the position within the text stream
         *   that the tab occurred at >= 0.
         * @return the tab stop, measured in points >= 0
         */
//        public float nextTabStop(float x, int tabOffset) {
//            if (tabSize == 0) {
//                return x;
//            }
//            int ntabs = (((int) x) - tabBase) / tabSize;
//            return tabBase + ((ntabs + 1) * tabSize);
//        }

        // --- local methods ------------------------------------------------
        /**
         * Repaint the region of change covered by the given document
         * event.  Damages the line that begins the range to cover
         * the case when the insert/remove is only on one line.  
         * If lines are added or removed, damages the whole 
         * view.  The longest line is checked to see if it has 
         * changed.
         *
         * @since 1.4
         */
//        protected void updateDamage(DocumentEvent changes, Shape a, ViewFactory f) {
//            Component host = getContainer();
////            updateMetrics();
//            Element elem = getElement();
//            DocumentEvent.ElementChange ec = changes.getChange(elem);
//
//            Element[] added = (ec != null) ? ec.getChildrenAdded() : null;
//            Element[] removed = (ec != null) ? ec.getChildrenRemoved() : null;
//            if (((added != null) && (added.length > 0)) ||
//                    ((removed != null) && (removed.length > 0))) {
//                // lines were added or removed...
//                if (added != null) {
//                    int currWide = getBeatWidth(longLine);
//                    for (int i = 0; i < added.length; i++) {
//                        int w = getBeatWidth(added[i]);
//                        if (w > currWide) {
//                            currWide = w;
//                            longLine = added[i];
//                        }
//                    }
//                }
//                if (removed != null) {
//                    for (int i = 0; i < removed.length; i++) {
//                        if (removed[i] == longLine) {
//                            calculateLongestLine();
//                            break;
//                        }
//                    }
//                }
//                preferenceChanged(null, true, true);
//                host.repaint();
//            } else {
//                Element map = getElement();
//                int line = map.getElementIndex(changes.getOffset());
//                damageLineRange(line, line, a, host);
//                if (changes.getType() == DocumentEvent.EventType.INSERT) {
//                    // check to see if the line is longer than current
//                    // longest line.
//                    int w = getBeatWidth(longLine);
//                    Element e = map.getElement(line);
//                    if (e == longLine) {
//                        preferenceChanged(null, true, false);
//                    } else if (getBeatWidth(e) > w) {
//                        longLine = e;
//                        preferenceChanged(null, true, false);
//                    }
//                } else if (changes.getType() == DocumentEvent.EventType.REMOVE) {
//                    if (map.getElement(line) == longLine) {
//                        // removed from longest line... recalc
//                        calculateLongestLine();
//                        preferenceChanged(null, true, false);
//                    }
//                }
//            }
//        }
        /**
         * Repaint the given line range.
         *
         * @param host the component hosting the view (used to call repaint)
         * @param a  the region allocated for the view to render into
         * @param line0 the starting line number to repaint.  This must
         *   be a valid line number in the model.
         * @param line1 the ending line number to repaint.  This must
         *   be a valid line number in the model.
         * @since 1.4
         */
//        protected void damageLineRange(int line0, int line1, Shape a, Component host) {
//            if (a != null) {
//                Rectangle area0 = lineToRect(a, line0);
//                Rectangle area1 = lineToRect(a, line1);
//                if ((area0 != null) && (area1 != null)) {
//                    Rectangle damage = area0.union(area1);
//                    host.repaint(damage.x, damage.y, damage.width, damage.height);
//                } else {
//                    host.repaint();
//                }
//            }
//        }
        /**
         * Determine the rectangle that represents the given line.
         *
         * @param a  the region allocated for the view to render into
         * @param line the line number to find the region of.  This must
         *   be a valid line number in the model.
         * @since 1.4
         */
        protected Rectangle lineToRect(Shape a, int line) {
            Rectangle r = null;
//            updateMetrics();
            if (metrics != null) {
                Rectangle alloc = a.getBounds();
//                if (line == 0) {
//                    alloc.x += firstLineOffset;
//                    alloc.width -= firstLineOffset;
//                }
                r = new Rectangle(alloc.x, alloc.y + (line * metrics.getHeight()),
                        alloc.width, metrics.getHeight());
            }
            return r;
        }

        /**
         * Iterate over the lines represented by the child elements
         * of the element this view represents, looking for the line
         * that is the longest.  The <em>longLine</em> variable is updated to
         * represent the longest line contained.  The <em>font</em> variable
         * is updated to indicate the font used to calculate the 
         * longest line.
         */
//        private void calculateLongestLine() {
//            Component c = getContainer();
//            font = c.getFont();
//            metrics = c.getFontMetrics(font);
//            Document doc = getDocument();
//            Element lines = getElement();
//            int n = lines.getElementCount();
//            int maxWidth = -1;
//            for (int i = 0; i < n; i++) {
//                Element line = lines.getElement(i);
//                int w = getBeatWidth(line);
//                if (w > maxWidth) {
//                    maxWidth = w;
//                    longLine = line;
//                }
//            }
//        }
        /**
         * Calculate the width of the line represented by
         * the given element.  It is assumed that the font
         * and font metrics are up-to-date.
         */
        private int getBeatWidth() {
            int w;
//            Element beat = getElement();
//            int n = beat.getElementCount();
////            int maxWidth = -1;
//            beat.getElement(n).getEndOffset();
//            for (int i = 0; i < n; i++) {
//                Element note = beat.getElement(i);
//                w += note.getLineWidth(line);
//                if (w > maxWidth) {
//                    maxWidth = w;
//                    longLine = line;
//                }
//            }
            char[] arr = getText().toCharArray();
            Segment s = new Segment(arr, 0, arr.length);
//            try {
                w = Utilities.getTabbedTextWidth(s, metrics, 0, null, 0);
//            } catch (BadLocationException ble) {
//                w = 0;
//            }
            return w;
        }

        // --- member variables -----------------------------------------------
        /**
         * Font metrics for the current font.
         */
        protected FontMetrics metrics;
        /**
         * The current longest line.  This is used to calculate
         * the preferred width of the view.  Since the calculation
         * is potentially expensive we try to avoid it by stashing
         * which line is currently the longest.
         */
        //Element longline;
        /**
         * Font used to calculate the longest line... if this 
         * changes we need to recalculate the longest line
         */
        Font font;
        Segment lineBuffer;
//        int tabSize;
        int tabBase;
        int sel0;
        int sel1;
        Color unselected;
        Color selected;
        /**
         * Offset of where to draw the first character on the first line.
         * This is a hack and temporary until we can better address the problem
         * of text measuring. This field is actually never set directly in
         * PlainView, but by FieldView.
         */
        int firstLineOffset;
    }
    
    public static class NoteView extends View {

        @Override
        public float getPreferredSpan(int axis) {
            throw new UnsupportedOperationException("Not supported yet.");
        }

        @Override
        public Shape modelToView(int pos, Shape a, Bias b) throws BadLocationException {
            throw new UnsupportedOperationException("Not supported yet.");
        }

        @Override
        public void paint(Graphics g, Shape allocation) {
            throw new UnsupportedOperationException("Not supported yet.");
        }

        @Override
        public int viewToModel(float x, float y, Shape a, Bias[] biasReturn) {
            throw new UnsupportedOperationException("Not supported yet.");
        }

        public NoteView(Element elem) {
            super(elem);
        }
        
    }
}
