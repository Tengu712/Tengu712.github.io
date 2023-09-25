namespace Ssg.IO;

/// <summary>
/// A class to prevent the duplication of 'dependencies' written in the head, such as links and scripts.
/// </summary>
public class HeadWriter : IWriter
{
    private readonly StreamWriter sw;
    private readonly HashSet<string> needs;

    public HeadWriter(StreamWriter sw)
    {
        this.sw = sw;
        needs = new HashSet<string>();
    }

    public void Write(string str)
    {
        if (needs.Contains(str))
        {
            return;
        }
        needs.Add(str);
        this.sw.Write(str);
    }
}
