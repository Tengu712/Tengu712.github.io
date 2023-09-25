using Ssg.Components;

namespace Ssg.Pages.Root.Pages.Touhou;

public class GensouNoYukue : ANormalPage
{
    private readonly IComponent content;

    public GensouNoYukue() => this.content = new FromXml("./xml/pages/touhou/gensou-no-yukue.xml");

    protected override string getPath() => "/pages/touhou/gensou-no-yukue/";

    protected override void outputHead(StreamWriter sw)
    {
        this.content.OutputRequirements(sw);
        sw.WriteLine("<title>『幻想の行方』解説</title>");
    }

    protected override void outputContent(StreamWriter sw) => this.content.Output(sw);
}
