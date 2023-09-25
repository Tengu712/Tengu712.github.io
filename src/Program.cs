namespace Ssg;

public class Program
{
    public static void Main()
    {
        new Pages.Root.Posts.Post("ai-illustration").Generate();
        new Pages.Root.Posts.Post("allocate-descriptor-sets").Generate();
        // pages
        new Pages.Root.Pages.Index().Generate();
        new Pages.Root.Pages.Programming.License().Generate();
        new Pages.Root.Pages.Touhou.GensouNoYukue().Generate();
        new Pages.Root.Pages.Touhou.NamerakaNaUchuuToSonoTeki().Generate();
        // about
        new Pages.Root.About.About().Generate();
    }
}
