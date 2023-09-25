using Ssg.IO;

namespace Ssg.Components;

public class Tombstone : IComponent
{
    public void OutputRequirements(IWriter writer) { }
    public void Output(IWriter writer) =>
        new Node("p").AddAttribute("class", "ta-right").SetInnerText("■").Output(writer);
}
