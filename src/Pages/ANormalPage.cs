using Ssg.Components;
using Ssg.IO;

namespace Ssg.Pages;

/// <summary>
/// [Template Method Pattern]
/// </summary>
public abstract class ANormalPage : APage
{
    protected override void output(StreamWriter sw)
    {
        var hw = new HeadWriter(sw);
        var cw = new ContentWriter(sw);

        var header = new Header();
        var footer = new Footer();

        sw.Write("<!DOCTYPE html>");
        sw.Write("<html lang='ja'>");
        sw.Write("<head>");
        sw.Write("<meta charset='utf-8'>");
        sw.Write("<meta name='viewport' content='width=device-width, initial-scale=1, minimum-scale=1, user-scalable=yes'>");
        sw.Write("<link rel='stylesheet' type='text/css' href='/req/default.css'>");
        sw.Write("<link rel='stylesheet' type='text/css' href='/req/normal.css'>");
        header.OutputRequirements(hw);
        footer.OutputRequirements(hw);
        this.outputHead(hw);
        sw.Write("</head>");
        sw.Write("<body class='normal-body'>");
        header.Output(cw);
        sw.Write("<div class='normal-content-wrapper'>");
        var image = this.getImage();
        if (image.Length > 0)
        {
            sw.Write($"<img class='normal-catch-image' src='{image}' />");
        }
        sw.Write("<div class='normal-content'>");
        this.outputContent(cw);
        sw.Write("</div>");
        sw.Write("</div>");
        footer.Output(cw);
        sw.Write("</body>");
        sw.Write("</html>");
    }

    protected virtual string getImage() => "";

    protected abstract void outputHead(IWriter writer);
    protected abstract void outputContent(IWriter writer);
}
