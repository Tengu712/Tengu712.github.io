namespace Ssg.Components;

public class Quoteblock : IComponent
{
    private readonly string? cite;
    private readonly IComponent[] children;

    public Quoteblock(string? cite, IComponent[] children)
    {
        this.cite = cite;
        this.children = children;
    }

    public void OutputRequirements(StreamWriter sw)
    {
        sw.WriteLine("<link rel='stylesheet' type='text/css' href='/req/components/quoteblock.css'>");
        foreach (IComponent child in this.children)
        {
            child.OutputRequirements(sw);
        }
    }

    public void Output(StreamWriter sw)
    {
        var node = new Node("blockquote").AddAttribute("class", "quoteblock-quoteblock");
        foreach (IComponent child in this.children)
        {
            node.AddChild(child);
        }
        if (this.cite != null)
        {
            node.AddChild(new Node("cite").SetInnerText(this.cite));
        }
        node.Output(sw);
    }
}
