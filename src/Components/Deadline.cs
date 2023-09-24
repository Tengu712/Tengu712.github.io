using Ssg.Utils;

namespace Ssg.Components;

public class Deadline : IComponent
{
    private readonly string id;

    public Deadline(string id) => this.id = id;

    public void OutputRequirements(StreamWriter sw) =>
        sw.WriteLine("<link rel='stylesheet' type='text/css' href='/req/components/deadline.css'>");

    public void Output(StreamWriter sw)
    {
        var next = PostsXmlFinder.GetInstance().GetNextOf(this.id);
        var prev = PostsXmlFinder.GetInstance().GetPrevOf(this.id);

        new Tombstone().Output(sw);
        new Node("hr").Output(sw);
        new Node("div")
            .AddAttribute("class", "deadline-links")
            .AddChild(next != null ? this.createLink(next, "Next Article") : new Node("div"))
            .AddChild(prev != null ? this.createLink(prev, "Prev Article") : new Node("div"))
            .Output(sw);
    }

    private IComponent createLink(PostData postData, string text) =>
        new Node("div")
            .AddChild(new Node("div").SetInnerText(text))
            .AddChild(new Node("div").AddChild(new Node("a").AddAttribute("href", $"/posts/{postData.Id}/").SetInnerText(postData.Title)));
}
