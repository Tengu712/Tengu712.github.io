using Ssg.Components;

namespace Ssg.Pages.Root.Pages;

public class Index : ANormalPage
{
    private readonly IComponent content;

    public Index() => this.content = new FromXml("./xml/pages/index.xml");

    protected override string getPath() => "/pages/";

    protected override void outputHead(StreamWriter sw)
    {
        this.content.OutputRequirements(sw);
        sw.WriteLine("<title>Pages</title>");
    }

    protected override void outputContent(StreamWriter sw) => this.content.Output(sw);
}
