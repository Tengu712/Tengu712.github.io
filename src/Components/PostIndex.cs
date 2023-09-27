using Ssg.IO;
using Ssg.Utils;

namespace Ssg.Components;

public class PostIndex : IComponent
{
    private readonly PostData data;

    public PostIndex(PostData data) => this.data = data;

    public void OutputRequirements(IWriter writer) =>
        writer.Write("<link rel='stylesheet' type='text/css' href='/req/components/post-index.css'>");

    public void Output(IWriter writer) {
        var tagsNode = new Node("div");
        tagsNode.AddAttribute("class", "post-index-tags");
        foreach (string tag in this.data.Tags)
        {
            tagsNode.AddChild(new Node("span").SetInnerText($"#{tag}"));
        }
        tagsNode.AddChild(new Node("span").SetInnerText(this.data.Date));

        new Node("div")
            .AddAttribute("class", "post-index-all")
            .AddChild(new Node("div")
                .AddAttribute("class", "post-index-title")
                .AddChild(new Node("a").AddAttribute("href", $"/posts/{this.data.Id}").SetInnerText(this.data.Title)))
            .AddChild(tagsNode)
            .Output(writer);
    }
}
