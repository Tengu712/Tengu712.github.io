namespace Ssg.Components;

public class Footer : IComponent
{
    public void OutputRequirements(StreamWriter sw) =>
        sw.WriteLine("<link rel='stylesheet' type='text/css' href='/req/components/footer.css'>");

    public void Output(StreamWriter sw)
    {
        new Node("div")
            .AddAttribute("class", "footer-footer")
            .SetInnerText("2022-2023, Tengu712, Skydog Association")
            .Output(sw);
    }
}
