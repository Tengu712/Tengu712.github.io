using Ssg.Components;
using Ssg.IO;

namespace Ssg.Pages.Root.Pages.Touhou;

public class GensouNoYukue : ANormalPage
{
    private readonly IComponent content;

    public GensouNoYukue() => this.content = new FromXml("./xml/pages/touhou/gensou-no-yukue.xml");

    protected override string getPath() => "/pages/touhou/gensou-no-yukue/";

    protected override void outputHead(IWriter writer)
    {
        this.content.OutputRequirements(writer);
        writer.Write("<title>『幻想の行方』解説</title>");
    }

    protected override void outputContent(IWriter writer) => this.content.Output(writer);
}
