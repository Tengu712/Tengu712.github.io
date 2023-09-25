using Ssg.IO;

namespace Ssg.Components;

public class Footer : IComponent
{
    public void OutputRequirements(IWriter writer) =>
        writer.Write("<link rel='stylesheet' type='text/css' href='/req/components/footer.css'>");

    public void Output(IWriter writer)
    {
        new Node("div")
            .AddAttribute("class", "footer-footer")
            .SetInnerText("2022-2023, Tengu712, Skydog Association")
            .Output(writer);
    }
}
