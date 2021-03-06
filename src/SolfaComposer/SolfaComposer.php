/*
 * SolfaComposer.java
 *
 * Created on September 4, 2007, 11:55 AM
 */
package org.anieanie.solfacomposer;

import examples.javakit.JavaContext;
import examples.javakit.JavaEditorKit;
import examples.javakit.Token;
import java.awt.Color;
import java.io.File;
import java.io.IOException;
import javax.sound.midi.InvalidMidiDataException;
import javax.sound.midi.MidiSystem;
import javax.sound.midi.Sequence;
import javax.swing.JEditorPane;
import javax.swing.JFileChooser;
import javax.swing.text.EditorKit;
import javax.swing.text.Style;
import javax.swing.text.StyleConstants;
import org.anieanie.music.solfa.SolfaMidi;
import org.anieanie.music.solfa.SolfaScript;
import org.anieanie.music.solfa.SolfaContext;

/**
 *
 * @author  Aniebiet
 */
public class SolfaComposer extends javax.swing.JFrame {

    /** Creates new form SolfaComposer */
    public SolfaComposer() {
        initComponents();
    }

    /** Creates new form SolfaComposer */
    public SolfaComposer(SolfaScript script) {
        this.script = script;
        initComponents();
    }

    public EditorKit getEditorKit() {
        JavaEditorKit kit = new JavaEditorKit();
        JavaContext styles = kit.getStylePreferences();
        Style s;
        s = styles.getStyleForScanValue(Token.COMMENT.getScanValue());
        StyleConstants.setForeground(s, new Color(102, 153, 153));
        s = styles.getStyleForScanValue(Token.STRINGVAL.getScanValue());
        StyleConstants.setForeground(s, new Color(102, 153, 102));
        Color keyword = new Color(102, 102, 255);
        for (int code = 70; code <= 130; code++) {
            s = styles.getStyleForScanValue(code);
            if (s != null) {
                StyleConstants.setForeground(s, keyword);
            }
        }
        return kit;
    }

    /** This method is called from within the constructor to
     * initialize the form.
     * WARNING: Do NOT modify this code. The content of this method is
     * always regenerated by the Form Editor.
     */
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        editFrame = new javax.swing.JFrame();
        jScrollPane1 = new javax.swing.JScrollPane();
        solfaEditor = new javax.swing.JEditorPane();
        fileChooser = new javax.swing.JFileChooser();
        fileChooserDialog = new javax.swing.JDialog();
        desktopPane = new javax.swing.JDesktopPane();
        jScrollPane2 = new javax.swing.JScrollPane();
        jEditorPane1 = new javax.swing.JEditorPane();
        menuBar1 = new javax.swing.JMenuBar();
        fileMenu1 = new javax.swing.JMenu();
        openMenuItem1 = new javax.swing.JMenuItem();
        saveMenuItem1 = new javax.swing.JMenuItem();
        saveAsMenuItem1 = new javax.swing.JMenuItem();
        exitMenuItem1 = new javax.swing.JMenuItem();
        editMenu1 = new javax.swing.JMenu();
        cutMenuItem1 = new javax.swing.JMenuItem();
        copyMenuItem1 = new javax.swing.JMenuItem();
        pasteMenuItem1 = new javax.swing.JMenuItem();
        deleteMenuItem1 = new javax.swing.JMenuItem();
        helpMenu1 = new javax.swing.JMenu();
        contentMenuItem1 = new javax.swing.JMenuItem();
        aboutMenuItem1 = new javax.swing.JMenuItem();

        solfaEditor.setContentType("text/html");
        jScrollPane1.setViewportView(solfaEditor);

        org.jdesktop.layout.GroupLayout editFrameLayout = new org.jdesktop.layout.GroupLayout(editFrame.getContentPane());
        editFrame.getContentPane().setLayout(editFrameLayout);
        editFrameLayout.setHorizontalGroup(
            editFrameLayout.createParallelGroup(org.jdesktop.layout.GroupLayout.LEADING)
            .add(org.jdesktop.layout.GroupLayout.TRAILING, jScrollPane1, org.jdesktop.layout.GroupLayout.DEFAULT_SIZE, 400, Short.MAX_VALUE)
        );
        editFrameLayout.setVerticalGroup(
            editFrameLayout.createParallelGroup(org.jdesktop.layout.GroupLayout.LEADING)
            .add(jScrollPane1, org.jdesktop.layout.GroupLayout.DEFAULT_SIZE, 300, Short.MAX_VALUE)
        );

        fileChooser.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                fileChooserActionPerformed(evt);
            }
        });

        fileChooserDialog.setTitle("Open Midi");
        fileChooserDialog.setName("openDialog"); // NOI18N

        org.jdesktop.layout.GroupLayout fileChooserDialogLayout = new org.jdesktop.layout.GroupLayout(fileChooserDialog.getContentPane());
        fileChooserDialog.getContentPane().setLayout(fileChooserDialogLayout);
        fileChooserDialogLayout.setHorizontalGroup(
            fileChooserDialogLayout.createParallelGroup(org.jdesktop.layout.GroupLayout.LEADING)
            .add(0, 583, Short.MAX_VALUE)
        );
        fileChooserDialogLayout.setVerticalGroup(
            fileChooserDialogLayout.createParallelGroup(org.jdesktop.layout.GroupLayout.LEADING)
            .add(0, 399, Short.MAX_VALUE)
        );

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);

        desktopPane.setAutoscrolls(true);

        jEditorPane1.setContentType("");
        jEditorPane1.setEditorKit(getEditorKit());
        jScrollPane2.setViewportView(jEditorPane1);

        jScrollPane2.setBounds(0, 0, 640, 560);
        desktopPane.add(jScrollPane2, javax.swing.JLayeredPane.DEFAULT_LAYER);

        fileMenu1.setText("File");

        openMenuItem1.setText("Open");
        openMenuItem1.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                openMenuItem1ActionPerformed(evt);
            }
        });
        fileMenu1.add(openMenuItem1);

        saveMenuItem1.setText("Save");
        fileMenu1.add(saveMenuItem1);

        saveAsMenuItem1.setText("Save As ...");
        fileMenu1.add(saveAsMenuItem1);

        exitMenuItem1.setText("Exit");
        exitMenuItem1.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                exitMenuItem1ActionPerformed(evt);
            }
        });
        fileMenu1.add(exitMenuItem1);

        menuBar1.add(fileMenu1);

        editMenu1.setText("Edit");

        cutMenuItem1.setText("Cut");
        cutMenuItem1.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                cutMenuItem1ActionPerformed(evt);
            }
        });
        editMenu1.add(cutMenuItem1);

        copyMenuItem1.setText("Copy");
        editMenu1.add(copyMenuItem1);

        pasteMenuItem1.setText("Paste");
        editMenu1.add(pasteMenuItem1);

        deleteMenuItem1.setText("Delete");
        editMenu1.add(deleteMenuItem1);

        menuBar1.add(editMenu1);

        helpMenu1.setText("Help");

        contentMenuItem1.setText("Contents");
        helpMenu1.add(contentMenuItem1);

        aboutMenuItem1.setText("About");
        helpMenu1.add(aboutMenuItem1);

        menuBar1.add(helpMenu1);

        setJMenuBar(menuBar1);

        org.jdesktop.layout.GroupLayout layout = new org.jdesktop.layout.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(org.jdesktop.layout.GroupLayout.LEADING)
            .add(desktopPane, org.jdesktop.layout.GroupLayout.DEFAULT_SIZE, 641, Short.MAX_VALUE)
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(org.jdesktop.layout.GroupLayout.LEADING)
            .add(desktopPane, org.jdesktop.layout.GroupLayout.DEFAULT_SIZE, 561, Short.MAX_VALUE)
        );

        java.awt.Dimension screenSize = java.awt.Toolkit.getDefaultToolkit().getScreenSize();
        setBounds((screenSize.width-649)/2, (screenSize.height-616)/2, 649, 616);
    }// </editor-fold>//GEN-END:initComponents

    private void fileChooserActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_fileChooserActionPerformed
// TODO add your handling code here:
    }//GEN-LAST:event_fileChooserActionPerformed

    private void exitMenuItem1ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_exitMenuItem1ActionPerformed
// TODO add your handling code here:
    }//GEN-LAST:event_exitMenuItem1ActionPerformed

    private void openMenuItem1ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_openMenuItem1ActionPerformed
// TODO add your handling code here:
//        fileChooserDialog.
//        JFileChooser chooser = new JFileChooser();
        // Note: source for ExampleFileFilter can be found in FileChooserDemo,
        // under the demo/jfc directory in the JDK.
        ExampleFileFilter filter = new ExampleFileFilter();
        filter.addExtension("mid");
        filter.addExtension("midi");
        filter.setDescription("MIDI sound files");
        fileChooser.setFileFilter(filter);
        int returnVal = fileChooser.showOpenDialog(this);
        if (returnVal == JFileChooser.APPROVE_OPTION) {
            try {
                Sequence mySeq = MidiSystem.getSequence(fileChooser.getSelectedFile());
                dumpInfo(mySeq);
                SolfaMidi solfa1 = new SolfaMidi(mySeq);
                script = solfa1.getScript();
                System.out.printf("\nBeat count: %d\n", script.getBeatCount());
                System.out.println(JEditorPane.getEditorKitClassNameForContentType("text/xml"));
                jEditorPane1.setText(script.getHTML());
//                System.out.println(jEditorPane1.getText());
//                System.out.println(editFrame.getOwner());
//                editFrame.getParent().setName(fileChooser.getSelectedFile().getName());
            } catch (InvalidMidiDataException ex) {
                ex.printStackTrace();
            } catch (IOException ex) {
                ex.printStackTrace();
            }
        }
    }//GEN-LAST:event_openMenuItem1ActionPerformed

private void cutMenuItem1ActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_cutMenuItem1ActionPerformed
// TODO add your handling code here:
    SolfaContext.runTest();
}//GEN-LAST:event_cutMenuItem1ActionPerformed

    public void dumpInfo(Sequence mySeq) {
        System.out.println("DivisionType: " + mySeq.getDivisionType());
        System.out.println("MicrosecondLength: " + mySeq.getMicrosecondLength());
        System.out.println("TickLength: " + mySeq.getTickLength());
        System.out.println("Resolution: " + mySeq.getResolution());
        System.out.println("Beats: " + (mySeq.getTickLength() / mySeq.getResolution()));
        System.out.println("Tracks: " + mySeq.getTracks().length);
        System.out.println("PatchLists: " + mySeq.getPatchList().length);
        System.out.println("");
    }
    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JMenuItem aboutMenuItem1;
    private javax.swing.JMenuItem contentMenuItem1;
    private javax.swing.JMenuItem copyMenuItem1;
    private javax.swing.JMenuItem cutMenuItem1;
    private javax.swing.JMenuItem deleteMenuItem1;
    private javax.swing.JDesktopPane desktopPane;
    private javax.swing.JFrame editFrame;
    private javax.swing.JMenu editMenu1;
    private javax.swing.JMenuItem exitMenuItem1;
    private javax.swing.JFileChooser fileChooser;
    private javax.swing.JDialog fileChooserDialog;
    private javax.swing.JMenu fileMenu1;
    private javax.swing.JMenu helpMenu1;
    private javax.swing.JEditorPane jEditorPane1;
    private javax.swing.JScrollPane jScrollPane1;
    private javax.swing.JScrollPane jScrollPane2;
    private javax.swing.JMenuBar menuBar1;
    private javax.swing.JMenuItem openMenuItem1;
    private javax.swing.JMenuItem pasteMenuItem1;
    private javax.swing.JMenuItem saveAsMenuItem1;
    private javax.swing.JMenuItem saveMenuItem1;
    private javax.swing.JEditorPane solfaEditor;
    // End of variables declaration//GEN-END:variables
    // Aniebiet's variable declarations
    private SolfaScript script;
    static File MidiFilePath = new File("/");

//    static File MidiFile=new File("C:/Documents and Settings/Aniebiet/My Documents/My Sheet Music/NoteWorthy/The Trumpet Shall Sound - Bass Solo.mid");;
//    static File MidiFile=new File("C:/Documents and Settings/Aniebiet/My Documents/My Sheet Music/MIDI/Messiah/messiah_22_(c)unknown.mid");;
}
