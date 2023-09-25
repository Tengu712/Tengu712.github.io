using System.Xml;
using Ssg.Components;
using Ssg.IO;

namespace Ssg.Pages.Root.Pages.Touhou;

public class FanbooksIHave : APlainPage
{
    private const string DATA_XMLPATH = "./xml/pages/touhou/fanbooks-i-have-data.xml";

    private readonly XmlNodeList bookNodes;

    public FanbooksIHave()
    {
        var xmlDoc = new XmlDocument();
        xmlDoc.Load(FanbooksIHave.DATA_XMLPATH);

        var bookNodes = xmlDoc.SelectNodes("books/book");
        if (bookNodes == null)
        {
            throw new Exception($"[ error ] FanbooksIHave(): <books> or <book> not found. : {FanbooksIHave.DATA_XMLPATH}");
        }
        this.bookNodes = bookNodes;
    }

    protected override string getPath() => "/pages/touhou/fanbooks-i-have/";

    protected override void outputHead(IWriter writer)
    {
        writer.Write("<link rel='stylesheet' type='text/css' href='/req/fanbooks-i-have.css'>");
        writer.Write("<title>紙媒体で所有する・かつ既読の東方同人誌</title>");
    }

    protected override void outputContent(IWriter writer)
    {
        new Node("h1")
            .SetInnerText("紙媒体で所有する・かつ既読の東方同人誌")
            .Output(writer);
        new Node("p")
            .AddChild(new Node("span").SetInnerText("「∀本∈{'{'}表中にある{'}'}, 紙媒体として所有している∧読了している」であって"))
            .AddChild(new Node("br"))
            .AddChild(new Node("span").SetInnerText("「∀本∈{'{'}紙媒体として所有している∧読了している{'}'}, 表中にある」でないことに留意せよ。"))
            .Output(writer);
        new Node("p")
            .AddAttribute("class", "ta-right")
            .SetInnerText("2023/6/21更新")
            .Output(writer);

        var table = new Node("table")
            .AddChild(new Node("tr")
                .AddChild(new Node("th").SetInnerText("サークル名"))
                .AddChild(new Node("th").SetInnerText("作者名").AddAttribute("class", "hidable"))
                .AddChild(new Node("th").SetInnerText("題名"))
                .AddChild(new Node("th").SetInnerText("発行日").AddAttribute("class", "hidable")));
        var prevCircle = "";
        foreach (XmlNode bookNode in this.bookNodes)
        {
            // TODO: throw exception.
            var circle = bookNode.SelectSingleNode("c")!.InnerText;
            var author = bookNode.SelectSingleNode("a")!.InnerText;
            var title = bookNode.SelectSingleNode("t")!.InnerText;
            var date = bookNode.SelectSingleNode("d")!.InnerText;
            table
                .AddChild(new Node("tr")
                    .AddAttribute("class", circle.Equals(prevCircle) ? "" : "topline")
                    .AddChild(new Node("td").SetInnerText(circle))
                    .AddChild(new Node("td").SetInnerText(author).AddAttribute("class", "hidable"))
                    .AddChild(new Node("td").SetInnerText(title))
                    .AddChild(new Node("td").SetInnerText(date).AddAttribute("class", "hidable")));
            prevCircle = circle;
        }
        table.Output(writer);

        new Node("p")
            .AddAttribute("class", "ta-center")
            .AddChild(new Node("a").AddAttribute("href", "/pages/").SetInnerText("戻る"))
            .Output(writer);
    }
}
