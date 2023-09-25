using Ssg.IO;

namespace Ssg.Components;

public class Headline : IComponent
{
    private readonly string title;
    private readonly string[] tags;
    private readonly string date;

    public Headline(string title, string[] tags, string date)
    {
        this.title = title;
        this.tags = tags;
        this.date = date;
    }

    public void OutputRequirements(IWriter writer) =>
        writer.Write("<link rel='stylesheet' type='text/css' href='/req/components/headline.css'>");

    public void Output(IWriter writer)
    {
        var tagsNode = new Node("div");
        tagsNode.AddAttribute("class", "headline-tags");
        foreach (string tag in this.tags)
        {
            tagsNode.AddChild(new Node("span").SetInnerText($"#{tag}"));
        }
        tagsNode.AddChild(new Node("span").SetInnerText(this.date));

        new Node("div")
            .AddChild(new Node("h1").SetInnerText(this.title))
            .AddChild(tagsNode)
            .AddChild(new Node("hr"))
            .Output(writer);
    }
}
