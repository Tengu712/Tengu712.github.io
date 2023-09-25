using Ssg.Components;
using Ssg.IO;

namespace Ssg.Pages.Root.Pages.Programming;

public class License : ANormalPage
{
    private readonly IComponent content;

    public License() => this.content = new FromXml("./xml/pages/programming/license.xml");

    protected override string getPath() => "/pages/programming/license/";

    protected override void outputHead(IWriter writer)
    {
        this.content.OutputRequirements(writer);
        writer.Write("<title>ライセンスあれこれ</title>");
    }

    protected override void outputContent(IWriter writer) => this.content.Output(writer);
}
