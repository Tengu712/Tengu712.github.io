using Ssg.Components;

namespace Ssg.Pages.Root.Pages.Touhou.ClearTableComponents;

public class LunaticOnly
{
    public static IComponent CreateTable()
    {
        var tableNode = new Node("table").AddAttribute("id", "lunatic-only");

        var th = 6;
        foreach (var work in Data.PD_LUNATIC_ONLY)
        {
            var workTr = new Node("tr").AddAttribute("class", "lunatic-only-row");
            // title
            workTr.AddChild(new Node("th").SetInnerText(Data.TITLES[th]));
            // chars
            var table = new Node("table").AddAttribute("class", $"work-table th{th}");
            foreach (var row in work)
            {
                var trNode = new Node("tr");
                foreach (var chara in row)
                {
                    trNode
                        .AddChild(new Node("td")
                            .AddAttribute("class", $"th{th}_Lunatic_{chara.E}")
                            .SetInnerText(chara.L));
                }
                table.AddChild(trNode);
            }
            workTr.AddChild(new Node("td").AddChild(table));
            tableNode.AddChild(workTr);
            th += 1;
        }

        return tableNode;
    }
}