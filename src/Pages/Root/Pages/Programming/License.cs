using Ssg.Components;

namespace Ssg.Pages.Root.Pages.Programming;

public class License : ANormalPage
{
    private readonly IComponent content;

    public License() => this.content = new FromXml("./xml/pages/programming/license.xml");

    protected override string getPath() => "/pages/programming/license/";

    protected override void outputHead(StreamWriter sw)
    {
        this.content.OutputRequirements(sw);
        sw.WriteLine("<title>ライセンスあれこれ</title>");
    }

    protected override void outputContent(StreamWriter sw) => this.content.Output(sw);
}
