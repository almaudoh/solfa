<?php

namespace KodeHauz\Solfa;

/**
 * Converts solfa into text representations and vice-versa.
 *
 */
class SolfaScript {
    Vector<SolfaLine> lines;
//    MetaInfo info;
    SolfaContext context;
    Style topstyle;

    public SolfaScript(SolfaContext context) {
        this.context = context;
        lines = new Vector();
    }
    
    public int getLineCount() {
        return lines.size();
    }
    
    public int getBeatCount() {
        int c = 0;
        for (SolfaLine l : lines) {
            if (l.getBeatCount()>c) c=l.getBeatCount();
        }
        return c;
    }
    
    

    public SolfaContext getContext() {
        return context;
    }
    
    public void addSolfaLine(SolfaLine line) {
        lines.add(line);
    }

    public void printSolfa() {
        for (SolfaLine line : lines) {
            line.printLine(context);
        }
    }

    public void printHTML() {
        // Move this later to a separate print routine
        System.out.print("<table>");
        for (SolfaLine line : lines) {
//            line.printLine();
            System.out.print(line.getAsHtmlRow(context));
        }
        System.out.print("</table>\n");
    }

    public String getHTML() {
        // Move this later to a separate print routine
        StringBuffer buf = new StringBuffer("<html><body><h2>");
        buf.append(context.getRootStyle().getAttribute(MetaEvent.describe(MetaEvent.TEXT))).append("</h2><h3 align='left'>");
        buf.append(context.getRootStyle().getAttribute(MetaEvent.describe(MetaEvent.KEY_SIGNATURE))).append("&nbsp;");
        buf.append(context.getRootStyle().getAttribute(MetaEvent.describe(MetaEvent.TIME_SIGNATURE))).append("</h3>");
        buf.append("<table border=1 cellspacing=0 cellpadding=4 style=\"border-collapse:collapse;font-size:10px;font-family:Arial;text-align:center\" align=\"center\">");
        for (SolfaLine line : lines) {
//            line.printLine(context);
            buf.append(line.getAsHtmlRow(context));
        }

        buf.append("</table></body></html>\n");
        System.out.println(buf);
        return "public String getHTML() {\nreturn buf.toString();\n}\n";
//        return buf.toString();
    }

}
