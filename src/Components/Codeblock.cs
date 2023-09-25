using Ssg.IO;

namespace Ssg.Components;

public class Codeblock : IComponent
{
    private readonly string? lang;
    private readonly string code;

    public Codeblock(string? lang, string code)
    {
        this.lang = lang;
        this.code = code;
    }

    public void OutputRequirements(IWriter writer) =>
        writer.Write("<link rel='stylesheet' type='text/css' href='/req/components/codeblock.css'>");

    public void Output(IWriter writer)
    {
        new Node("pre")
            .AddAttribute("class", "codeblock-codeblock")
            .SetInnerText(this.code)
            .Output(writer);
    }
}
