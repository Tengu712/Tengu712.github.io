using Ssg.Components;

namespace Ssg.Pages.Root.Pages.Touhou;

public class NamerakaNaUchuuToSonoTeki : ANormalPage
{
    private readonly IComponent content;

    public NamerakaNaUchuuToSonoTeki() => this.content = new FromXml("./xml/pages/touhou/nameraka-na-uchuu-to-sono-teki.xml");

    protected override string getPath() => "/pages/touhou/nameraka-na-uchuu-to-sono-teki/";

    protected override void outputHead(StreamWriter sw)
    {
        this.content.OutputRequirements(sw);
        sw.WriteLine("<title>『なめらかな宇宙と、その敵。』解説</title>");
    }

    protected override void outputContent(StreamWriter sw) => this.content.Output(sw);
}
