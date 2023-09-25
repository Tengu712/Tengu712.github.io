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
            case "Codeblock":
                return new Codeblock(node.Attributes?["lang"]?.Value, node.InnerText);
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
                foreach (XmlNode child in node.ChildNodes)
                {
                    if (child.NodeType == XmlNodeType.Text)
                    {
                        res.AddChild(new Node("span").SetInnerText(child.InnerText));
                    }
                    else
                    {
                        res.AddChild(FromXml.parseContent(child));
                    }
                }
                return res;
        }
    }

    public void OutputRequirements(StreamWriter sw) => this.content.OutputRequirements(sw);
    public void Output(StreamWriter sw) => this.content.Output(sw);
}
