namespace Ssg;

public class Program
{
    public static void Main()
    {
        // top
        new Pages.Root.Posts.Index().Generate();
        // posts
        new Pages.Root.Posts.Post("ai-illustration").Generate();
        new Pages.Root.Posts.Post("allocate-descriptor-sets").Generate();
        new Pages.Root.Posts.Post("solink-speed").Generate();
        new Pages.Root.Posts.Post("com-in-rust").Generate();
        new Pages.Root.Posts.Post("stdout-speed").Generate();
        new Pages.Root.Posts.Post("enum-windows").Generate();
        new Pages.Root.Posts.Post("windows-to-ubuntu").Generate();
        new Pages.Root.Posts.Post("start").Generate();
        // pages
        new Pages.Root.Pages.Index().Generate();
        new Pages.Root.Pages.Programming.License().Generate();
        new Pages.Root.Pages.Touhou.ClearTable().Generate();
        new Pages.Root.Pages.Touhou.FanbooksIHave().Generate();
        new Pages.Root.Pages.Touhou.GensouNoYukue().Generate();
        new Pages.Root.Pages.Touhou.NamerakaNaUchuuToSonoTeki().Generate();
        // about
        new Pages.Root.About.About().Generate();
    }
}
