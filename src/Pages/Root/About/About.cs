using Ssg.Components;

namespace Ssg.Pages.Root.About;

public class About : ANormalPage
{
    private readonly IComponent content;

    public About() => this.content = new FromXml("./xml/about/about.xml");

    protected override string getPath() => "/about/";

    protected override void outputHead(StreamWriter sw)
    {
        this.content.OutputRequirements(sw);
        sw.WriteLine("<title>About</title>");
    }

    protected override void outputContent(StreamWriter sw) => this.content.Output(sw);
}
