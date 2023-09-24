namespace Ssg.Components;

public class Tombstone : IComponent
{
    public void OutputRequirements(StreamWriter sw) { }
    public void Output(StreamWriter sw) =>
        new Node("p").AddAttribute("class", "ta-right").SetInnerText("■").Output(sw);
}
