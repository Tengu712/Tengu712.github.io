namespace Ssg.Components;

/// <summary>
/// [Builder Pattern]
/// A class for create a DOM node simply.
/// </summary>
public class Node : IComponent
{
    private readonly string name;

    private string innerText;
    private IList<string> attributes;
    private IList<IComponent> children;

    public Node(string name)
    {
        this.name = name;
        this.innerText = "";
        this.attributes = new List<string>();
        this.children = new List<IComponent>();
    }

    public Node SetInnerText(string innerText)
    {
        this.innerText = innerText;
        return this;
    }

    public Node AddAttribute(string key, string value)
    {
        this.attributes.Add($"{key}='{value}'");
        return this;
    }

    public Node AddChild(IComponent child)
    {
        this.children.Add(child);
        return this;
    }

    public void OutputRequirements(StreamWriter sw)
    {
        foreach (IComponent child in this.children)
        {
            child.OutputRequirements(sw);
        }
    }

    public void Output(StreamWriter sw)
    {
        sw.Write($"<{this.name}");
        foreach (string attribute in this.attributes)
        {
            sw.Write(" ");
            sw.Write(attribute);
        }
        sw.Write(">");
        foreach (IComponent child in this.children)
        {
            child.Output(sw);
        }
        sw.WriteLine($"{this.innerText}</{this.name}>");
    }
}
