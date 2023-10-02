using Ssg.Components;
using Ssg.IO;

namespace Ssg.Pages.Root.Pages;

public class Index : ANormalPage
{
    private readonly IComponent content;

    public Index() => this.content = new FromXml("./xml/pages/index.xml");

    protected override string getPath() => "/pages/";

    protected override void outputHead(IWriter writer)
    {
        this.content.OutputRequirements(writer);
        writer.Write("<link rel='stylesheet' type='text/css' href='/req/calendar.css'>");
        writer.Write("<title>Pages</title>");
    }

    protected override void outputContent(IWriter writer) => this.content.Output(writer);
}
