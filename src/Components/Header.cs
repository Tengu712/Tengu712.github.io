namespace Ssg.Components;

public class Header : IComponent
{
    public void OutputRequirements(StreamWriter sw) =>
        sw.WriteLine("<link rel='stylesheet' type='text/css' href='/req/components/header.css'>");

    public void Output(StreamWriter sw)
    {
        new Node("div")
          .AddAttribute("class", "header-header")
          .AddChild(new Node("a").AddAttribute("href", "/").SetInnerText("天狗会議録"))
          .AddChild(new Node("a").AddAttribute("href", "/").SetInnerText("Posts"))
          .AddChild(new Node("a").AddAttribute("href", "/pages/").SetInnerText("Pages"))
          .AddChild(new Node("a").AddAttribute("href", "/about/").SetInnerText("About"))
          .Output(sw);
        new Node("div")
          .AddAttribute("class", "header-spacer")
          .Output(sw);
    }
}
