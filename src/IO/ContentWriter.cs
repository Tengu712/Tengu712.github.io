namespace Ssg.IO;

/// <summary>
/// This class is no longer just a StreamWriter wrapper.
/// </summary>
public class ContentWriter : IWriter
{
    private readonly StreamWriter sw;
    public ContentWriter(StreamWriter sw) => this.sw = sw;
    public void Write(string str) => this.sw.Write(str);
}
