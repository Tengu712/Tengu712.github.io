using Ssg.Components;
using Ssg.IO;
using Ssg.Utils;

namespace Ssg.Pages.Root.Posts;

public class Index : ANormalPage
{
    private readonly IComponent[] indices;

    public Index()
    {
        var ids = PostsXmlFinder.GetInstance().GetIds();
        this.indices = new IComponent[ids.Length];
        for (int i = 0; i < ids.Length; ++i)
        {
            var data = PostsXmlFinder.GetInstance().Get(ids[i]);
            this.indices[i] = new PostIndex(data);
        }
    }

    protected override string getImage() => "https://img.skdassoc.work/top.png";

    protected override string getPath() => $"/";

    protected override void outputHead(IWriter writer)
    {
        foreach (var com in this.indices)
        {
            com.OutputRequirements(writer);
        }
        writer.Write($"<title>天狗会議録</title>");
    }

    protected override void outputContent(IWriter writer)
    {
        foreach (var com in this.indices)
        {
            com.Output(writer);
        }
    }
}
