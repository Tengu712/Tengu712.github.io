using Ssg.Components;

namespace Ssg.Pages.Root.Pages.Touhou.ClearTableComponents;

public class AllDiffs
{
    public static IComponent CreateTable()
    {
        var tableNode = new Node("table").AddAttribute("id", "all-diffs");

        var upperTrNode = AllDiffs.createWorkTablesTr(0, 7);
        var lowerTrNode = AllDiffs.createWorkTablesTr(7, Data.PD_ALL_DIFFS.Length);
        lowerTrNode
            .AddChild(new Node("td")
                .AddAttribute("class", "h-100")
                .AddChild(AllDiffs.createLegendTable()));

        tableNode
            .AddChild(new Node("tr")
                .AddChild(new Node("td")
                    .AddChild(new Node("table")
                        .AddAttribute("class", "w-100 h-100")
                        .AddChild(upperTrNode))));
        tableNode
            .AddChild(new Node("tr")
                .AddChild(new Node("td")
                    .AddChild(new Node("table")
                        .AddAttribute("class", "w-100 h-100")
                        .AddChild(lowerTrNode))));

        return tableNode;
    }

    private static Node createWorkTablesTr(int start, int end)
    {
        var trNode = new Node("tr");
        for (int i = start; i < end; ++i)
        {
            trNode
                .AddChild(new Node("td")
                .AddAttribute("class", "h-100")
                .AddChild(AllDiffs.createWorkTable(Data.PD_ALL_DIFFS[i], i + 6)));
        }
        return trNode;
    }

    private static IComponent createWorkTable(Data.PlayerData[][][] work, int th)
    {
        var workTable = new Node("table")
            .AddAttribute("class", $"work-table th{th}")
            .AddChild(new Node("tr")
                .AddChild(new Node("th")
                    .AddAttribute("colSpan", $"{work[0][0].Length + 1}")
                    .SetInnerText(Data.TITLES[th])));
        for (int diff = 0; diff < 5; ++diff)
        {
            // get chars info
            // if X chars are different from others then get 2nd chars info
            var chars = diff == 4 && work.Length == 2 ? work[1] : work[0];
            // chars
            for (int k = 0; k < chars.Length; ++k)
            {
                var trNode = new Node("tr");
                if (k == 0)
                {
                    trNode
                        .AddChild(new Node("td")
                            .AddAttribute("rowSpan", $"{chars.Length}")
                            .AddAttribute("class", "diff")
                            .SetInnerText(Data.DIFFS[diff].S));
                }
                foreach (var chara in chars[k])
                {
                    var td = new Node("td")
                        .AddAttribute("class", $"th{th}_{Data.DIFFS[diff].L}_{chara.E}")
                        .SetInnerText(chara.S);
                    // for th8 X
                    if (th == 8 && diff == 4)
                    {
                        td.AddAttribute("colSpan", "2");
                    }
                    trNode.AddChild(td);
                }
                workTable.AddChild(trNode);
            }
        }
        // for th7 P
        if (th == 7)
        {
            // get chars info
            var chars = work[0];
            // chars
            for (int k = 0; k < chars.Length; ++k)
            {
                var trNode = new Node("tr");
                if (k == 0)
                {
                    trNode
                        .AddChild(new Node("td")
                            .AddAttribute("rowSpan", $"{chars.Length}")
                            .AddAttribute("class", "diff")
                            .SetInnerText($"P"));
                }
                foreach (var chara in chars[k])
                {
                    trNode
                        .AddChild(new Node("td")
                            .AddAttribute("class", $"th7_Phantasm_{chara.E}")
                            .SetInnerText(chara.S));
                }
                workTable.AddChild(trNode);
            }
        }
        return workTable;
    }

    private static IComponent createLegendTable()
    {
        return new Node("table")
            .AddAttribute("class", "work-table th6")
            .AddChild(new Node("tr").AddChild(new Node("th").SetInnerText("　")))
            .AddChild(new Node("tr").AddChild(new Node("td").AddAttribute("class", "nmnbnr").SetInnerText("NMNBNR")))
            .AddChild(new Node("tr").AddChild(new Node("td").AddAttribute("class", "nmnb").SetInnerText("NMNB")))
            .AddChild(new Node("tr").AddChild(new Node("td").AddAttribute("class", "nmnr").SetInnerText("NMNR")))
            .AddChild(new Node("tr").AddChild(new Node("td").AddAttribute("class", "nm").SetInnerText("NM")))
            .AddChild(new Node("tr").AddChild(new Node("td").AddAttribute("class", "nbnr").SetInnerText("NBNR")))
            .AddChild(new Node("tr").AddChild(new Node("td").AddAttribute("class", "nb").SetInnerText("NB")))
            .AddChild(new Node("tr").AddChild(new Node("td").AddAttribute("class", "c").SetInnerText("ALL")))
            .AddChild(new Node("tr").AddChild(new Node("td").AddAttribute("class", "").SetInnerText("not-cleared")));
    }
}