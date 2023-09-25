using Ssg.IO;

namespace Ssg.Components;

public interface IComponent
{
    /// <summary>
    /// A method to append tags in head to the stream of the currently writing file.
    /// </summary>
    void OutputRequirements(IWriter writer);
    /// <summary>
    /// A method to append tags in body to the stream of the currently writing file.
    /// </summary>
    void Output(IWriter writer);
}
