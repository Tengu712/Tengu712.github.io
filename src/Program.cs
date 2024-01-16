using Ssg.Utils;

namespace Ssg;

public class Program
{
    public static void Main()
    {
        // top
        new Pages.Root.Posts.Index().Generate();
        // posts
        foreach (var id in PostsXmlFinder.GetInstance().GetIds()) {
          new Pages.Root.Posts.Post(id).Generate();
        }
        // pages
        new Pages.Root.Pages.Index().Generate();
        new Pages.Root.Pages.Programming.License().Generate();
        new Pages.Root.Pages.Touhou.FanbooksIHave().Generate();
        new Pages.Root.Pages.Touhou.GensouNoYukue().Generate();
        new Pages.Root.Pages.Touhou.NamerakaNaUchuuToSonoTeki().Generate();
        // about
        new Pages.Root.About.About().Generate();
    }
}
