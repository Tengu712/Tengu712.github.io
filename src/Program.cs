namespace Ssg;

public class Program
{
    public static void Main()
    {
        new Pages.Root.Posts.Post("ai-illustration").Generate();
        new Pages.Root.Posts.Post("allocate-descriptor-sets").Generate();
    }
}
