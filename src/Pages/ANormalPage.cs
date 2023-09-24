using Ssg.Components;

namespace Ssg.Pages;

/// <summary>
/// [Template Method Pattern]
/// </summary>
public abstract class ANormalPage : APage
{
    protected override void output(StreamWriter sw)
    {
        var header = new Header();
        var footer = new Footer();

        sw.WriteLine("<!DOCTYPE html>");
        sw.WriteLine("<html lang='ja'>");
        sw.WriteLine("<head>");
        sw.WriteLine("<meta charset='utf-8'>");
        sw.WriteLine("<meta name='viewport' content='width=device-width, initial-scale=1, minimum-scale=1, user-scalable=yes'>");
        sw.WriteLine("<link rel='stylesheet' type='text/css' href='/req/default.css'>");
        sw.WriteLine("<link rel='stylesheet' type='text/css' href='/req/normal.css'>");
        header.OutputRequirements(sw);
        footer.OutputRequirements(sw);
        this.outputHead(sw);
        sw.WriteLine("</head>");
        sw.WriteLine("<body class='normal-body'>");
        header.Output(sw);
        sw.WriteLine("<div class='normal-content'>");
        this.outputContent(sw);
        sw.WriteLine("</div>");
        footer.Output(sw);
        sw.WriteLine("</body>");
        sw.WriteLine("</html>");
    }

    protected abstract void outputHead(StreamWriter sw);
    protected abstract void outputContent(StreamWriter sw);
}
