namespace Ssg.Components;

public interface IComponent
{
    /// <summary>
    /// A method to append tags in head to the stream of the currently writing file.
    /// </summary>
    void OutputRequirements(StreamWriter sw);
    /// <summary>
    /// A method to append tags in body to the stream of the currently writing file.
    /// </summary>
    void Output(StreamWriter sw);
}
