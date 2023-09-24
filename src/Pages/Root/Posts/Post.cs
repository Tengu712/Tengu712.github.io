using Ssg.Components;
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

    protected override void outputHead(StreamWriter sw)
    {
        this.headline.OutputRequirements(sw);
        this.deadline.OutputRequirements(sw);
        this.postData.Content?.OutputRequirements(sw);
        sw.WriteLine($"<title>{this.postData.Title}</title>");
    }

    protected override void outputContent(StreamWriter sw)
    {
        this.headline.Output(sw);
        this.postData.Content?.Output(sw);
        this.deadline.Output(sw);
    }
}
