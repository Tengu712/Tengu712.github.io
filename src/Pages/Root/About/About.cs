using Ssg.Components;
using Ssg.IO;

namespace Ssg.Pages.Root.About;

public class About : ANormalPage
{
    private readonly IComponent content;

    public About() => this.content = new FromXml("./xml/about/about.xml");

    protected override string getPath() => "/about/";

    protected override void outputHead(IWriter writer)
    {
        this.content.OutputRequirements(writer);
        writer.Write("<title>About</title>");
    }

    protected override void outputContent(IWriter writer) => this.content.Output(writer);
}
