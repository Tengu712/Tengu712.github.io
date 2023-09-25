using Ssg.IO;

namespace Ssg.Components;

/// <summary>
/// [Builder Pattern]
/// A class for create a DOM node simply.
/// </summary>
public class Node : IComponent
{
    private readonly string name;
    private readonly bool selfClosing;

    private string innerText;
    private IList<string> attributes;
    private IList<IComponent> children;

    public Node(string name)
    {
        this.name = name;
        this.innerText = "";
        this.attributes = new List<string>();
        this.children = new List<IComponent>();
        this.selfClosing = name.Equals("br") || name.Equals("hr") || name.Equals("img");
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

    public Node AddChildren(IComponent[] children)
    {
        foreach (IComponent child in children)
        {
            this.children.Add(child);
        }
        return this;
    }

    public void OutputRequirements(IWriter writer)
    {
        foreach (IComponent child in this.children)
        {
            child.OutputRequirements(writer);
        }
    }

    public void Output(IWriter writer)
    {
        writer.Write($"<{this.name}");
        foreach (string attribute in this.attributes)
        {
            writer.Write(" ");
            writer.Write(attribute);
        }
        writer.Write(">");

        if (this.selfClosing)
        {
            if (this.children.Count > 0)
            {
                Console.Write($"[ warning ] Node.Output(): this {this.name} node is self-closing-node but this has {this.children.Count} children.");
            }
            return;
        }

        foreach (IComponent child in this.children)
        {
            child.Output(writer);
        }
        writer.Write($"{this.innerText}</{this.name}>");
    }
}
