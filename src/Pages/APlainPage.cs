namespace Ssg.Pages;

/// <summary>
/// [Template Method Pattern]
/// </summary>
public abstract class APlainPage : APage
{
    protected override void output(StreamWriter sw)
    {
        sw.WriteLine("<!DOCTYPE html>");
        sw.WriteLine("<html lang='ja'>");
        sw.WriteLine("<head>");
        sw.WriteLine("<meta charset='utf-8'>");
        sw.WriteLine("<meta name='viewport' content='width=device-width, initial-scale=1, minimum-scale=1, user-scalable=yes'>");
        sw.WriteLine("<link rel='stylesheet' type='text/css' href='/req/default.css'>");
        this.outputHead(sw);
        sw.WriteLine("</head>");
        sw.WriteLine("<body>");
        this.outputContent(sw);
        sw.WriteLine("</body>");
        sw.WriteLine("</html>");
    }

    protected abstract void outputHead(StreamWriter sw);
    protected abstract void outputContent(StreamWriter sw);
}
