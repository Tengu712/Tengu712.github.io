using Ssg.IO;

namespace Ssg.Pages;

/// <summary>
/// [Template Method Pattern]
/// </summary>
public abstract class APlainPage : APage
{
    protected override void output(StreamWriter sw)
    {
        var hw = new HeadWriter(sw);
        var cw = new ContentWriter(sw);

        sw.Write("<!DOCTYPE html>");
        sw.Write("<html lang='ja'>");
        sw.Write("<head>");
        sw.Write("<meta charset='utf-8'>");
        sw.Write("<meta name='viewport' content='width=device-width, initial-scale=1, minimum-scale=1, user-scalable=yes'>");
        sw.Write("<link rel='stylesheet' type='text/css' href='/req/default.css'>");
        this.outputHead(hw);
        sw.Write("</head>");
        sw.Write("<body>");
        this.outputContent(cw);
        sw.Write("</body>");
        sw.Write("</html>");
    }

    protected abstract void outputHead(IWriter writer);
    protected abstract void outputContent(IWriter writer);
}
