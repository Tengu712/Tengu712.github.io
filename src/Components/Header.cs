using Ssg.IO;

namespace Ssg.Components;

public class Header : IComponent
{
    public void OutputRequirements(IWriter writer) =>
        writer.Write("<link rel='stylesheet' type='text/css' href='/req/components/header.css'>");

    public void Output(IWriter writer)
    {
        new Node("div")
          .AddAttribute("class", "header-header")
          .AddChild(new Node("a").AddAttribute("href", "/").SetInnerText("天狗会議録"))
          .AddChild(new Node("a").AddAttribute("href", "/").SetInnerText("Posts"))
          .AddChild(new Node("a").AddAttribute("href", "/pages/").SetInnerText("Pages"))
          .AddChild(new Node("a").AddAttribute("href", "/about/").SetInnerText("About"))
          .Output(writer);
        new Node("div")
          .AddAttribute("class", "header-spacer")
          .Output(writer);
    }
}
