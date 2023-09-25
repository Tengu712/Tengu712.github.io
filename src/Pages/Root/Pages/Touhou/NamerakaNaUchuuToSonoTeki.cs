using Ssg.Components;
using Ssg.IO;

namespace Ssg.Pages.Root.Pages.Touhou;

public class NamerakaNaUchuuToSonoTeki : ANormalPage
{
    private readonly IComponent content;

    public NamerakaNaUchuuToSonoTeki() => this.content = new FromXml("./xml/pages/touhou/nameraka-na-uchuu-to-sono-teki.xml");

    protected override string getPath() => "/pages/touhou/nameraka-na-uchuu-to-sono-teki/";

    protected override void outputHead(IWriter writer)
    {
        this.content.OutputRequirements(writer);
        writer.Write("<title>『なめらかな宇宙と、その敵。』解説</title>");
    }

    protected override void outputContent(IWriter writer) => this.content.Output(writer);
}
