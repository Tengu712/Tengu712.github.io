using Ssg.Components;
using Ssg.IO;
using Ssg.Pages.Root.Pages.Touhou.ClearTableComponents;

namespace Ssg.Pages.Root.Pages.Touhou;

public class ClearTable : APlainPage
{
    protected override string getPath() => "/pages/touhou/clear-table/";

    protected override void outputHead(IWriter writer)
    {
        writer.Write("<link rel='stylesheet' type='text/css' href='/req/clear-table.css?20240116'>");
        writer.Write("<script src='/req/clear-table.js'></script>");
        writer.Write("<title>クリア機体表</title>");
    }

    protected override void outputContent(IWriter writer)
    {
        new Node("div")
            .AddAttribute("class", "ta-center")
            .AddChild(new Node("p")
                .AddChild(new Node("span").SetInnerText("SKD(天狗)の東方整数作品のクリア機体表兼リプレイ置き場です。"))
                .AddChild(new Node("br"))
                .AddChild(new Node("span").SetInnerText("同階級の実績のうち、最も古いリプレイを安置しています。"))
                .AddChild(new Node("br"))
                .AddChild(new Node("span").SetInnerText("NBについて、3M以内であれば特筆してあります。")))
            .AddChild(new Node("p")
                .AddChild(new Node("a").AddAttribute("id", "show-all-diffs").SetInnerText("全機体表"))
                .AddChild(new Node("span").SetInnerText("　"))
                .AddChild(new Node("a").AddAttribute("id", "show-lunatic-only").SetInnerText("Lunatic表"))
                .AddChild(new Node("span").SetInnerText("　"))
                .AddChild(new Node("a").AddAttribute("id", "show-timeline").SetInnerText("時系列")))
            .AddChild(new Node("hr"))
            .Output(writer);
        new Node("br").Output(writer);

        AllDiffs.CreateTable().Output(writer);
        LunaticOnly.CreateTable().Output(writer);
        new Node("table")
            .AddAttribute("id", "timeline")
            .Output(writer);

        new Node("p")
            .AddAttribute("class", "ta-center")
            .AddChild(new Node("a").AddAttribute("href", "/pages/").SetInnerText("戻る"))
            .Output(writer);
    }
}
