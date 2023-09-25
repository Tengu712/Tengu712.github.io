using Ssg.IO;

using System.Xml;

namespace Ssg.Components;

/// <summary>
/// A class that parses XmlNode into an IComponent. 
/// It replaces custom tags within the XmlNode with Components.
/// </summary>
public class FromXml : IComponent
{
    private readonly IComponent content;

    public FromXml(XmlNode node) => this.content = FromXml.parseContent(node);

    public FromXml(string xmlPath)
    {
        var xmlDoc = new XmlDocument();
        xmlDoc.Load(xmlPath);

        var node = xmlDoc.SelectSingleNode("main");
        if (node == null)
        {
            throw new Exception($"[ error ] FromXml(): <main> not found. : {xmlPath}");
        }

        this.content = FromXml.parseContent(node);
    }

    private static IComponent parseContent(XmlNode node)
    {
        switch (node.Name)
        {
            case "Tombstone":
                return new Tombstone();

            case "InlineMath":
                return new InlineMath(node.InnerText);

            case "BlockMath":
                return new BlockMath(node.InnerText);

            case "Codeblock":
                return new Codeblock(node.Attributes?["lang"]?.Value, node.InnerText);

            case "Quoteblock":
                return new Quoteblock(node.Attributes?["cite"]?.Value, FromXml.parseChildren(node));

            default:
                var res = new Node(node.Name);
                if (node.Attributes != null)
                {
                    foreach (XmlAttribute attribute in node.Attributes)
                    {
                        res.AddAttribute(attribute.Name, attribute.Value);
                    }
                }
                if (node.ChildNodes.Count == 0)
                {
                    res.SetInnerText(node.InnerText);
                    return res;
                }
                res.AddChildren(FromXml.parseChildren(node));
                return res;
        }
    }

    private static IComponent[] parseChildren(XmlNode node)
    {
        var children = new IComponent[node.ChildNodes.Count];
        for (int i = 0; i < node.ChildNodes.Count; ++i)
        {
            if (node.ChildNodes[i]!.NodeType == XmlNodeType.Text)
            {
                children[i] = new Node("span").SetInnerText(node.ChildNodes[i]!.InnerText);
            }
            else
            {
                children[i] = FromXml.parseContent(node.ChildNodes[i]!);
            }
        }
        return children;
    }

    public void OutputRequirements(IWriter writer) => this.content.OutputRequirements(writer);
    public void Output(IWriter writer) => this.content.Output(writer);
}
