using Ssg.Components;
using Ssg.IO;
using Ssg.Utils;

namespace Ssg.Pages.Root.Posts;

/// <summary>
/// A class for generating a Post page from XML.
/// <summary>
public class Post : ANormalPage
{
    private readonly PostData postData;
    private readonly IComponent headline;
    private readonly IComponent deadline;

    public Post(string id)
    {
        this.postData = PostsXmlFinder.GetInstance().Get(id);
        this.headline = new Headline(this.postData.Title, this.postData.Tags, this.postData.Date);
        this.deadline = new Deadline(this.postData.Id);
    }

    protected override string getPath() => $"/posts/{this.postData.Id}/";

    protected override void outputHead(IWriter writer)
    {
        this.headline.OutputRequirements(writer);
        this.deadline.OutputRequirements(writer);
        this.postData.Content?.OutputRequirements(writer);
        writer.Write($"<title>{this.postData.Title}</title>");
    }

    protected override void outputContent(IWriter writer)
    {
        this.headline.Output(writer);
        this.postData.Content?.Output(writer);
        this.deadline.Output(writer);
    }
}
