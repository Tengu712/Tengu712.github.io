namespace Ssg.IO;

public interface IWriter
{
    /// <summary>
    /// A method to write `str` to a file stream without newline characters.
    /// </summary>
    void Write(string str);
}
