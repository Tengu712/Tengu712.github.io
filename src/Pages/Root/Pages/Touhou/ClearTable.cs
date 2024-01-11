using System.Xml;
using Ssg.Components;
using Ssg.IO;

namespace Ssg.Pages.Root.Pages.Touhou;

public class ClearTable : APlainPage
{
    class PlayerData
    {
        public string S { get; init; } = "";
        public string E { get; init; } = "";
    }

    class DiffData
    {
        public string L { get; init; } = "";
        public string S { get; init; } = "";
    }

    // reimu
    private readonly PlayerData REIMU = new PlayerData { S = "霊", E = "Reimu" };
    private readonly PlayerData REIMU_A = new PlayerData { S = "霊A", E = "ReimuA" };
    private readonly PlayerData REIMU_B = new PlayerData { S = "霊B", E = "ReimuB" };
    private readonly PlayerData REIMU_C = new PlayerData { S = "霊C", E = "ReimuC" };
    private readonly PlayerData REIMU_SPRING = new PlayerData { S = "霊春", E = "ReimuSpring" };
    private readonly PlayerData REIMU_SUMMER = new PlayerData { S = "霊夏", E = "ReimuSummer" };
    private readonly PlayerData REIMU_AUTUMN = new PlayerData { S = "霊秋", E = "ReimuAutumn" };
    private readonly PlayerData REIMU_WINTER = new PlayerData { S = "霊冬", E = "ReimuWinter" };

    // marisa
    private readonly PlayerData MARISA = new PlayerData { S = "魔", E = "Marisa" };
    private readonly PlayerData MARISA_A = new PlayerData { S = "魔A", E = "MarisaA" };
    private readonly PlayerData MARISA_B = new PlayerData { S = "魔B", E = "MarisaB" };
    private readonly PlayerData MARISA_C = new PlayerData { S = "魔C", E = "MarisaC" };
    private readonly PlayerData MARISA_SPRING = new PlayerData { S = "魔春", E = "MarisaSpring" };
    private readonly PlayerData MARISA_SUMMER = new PlayerData { S = "魔夏", E = "MarisaSummer" };
    private readonly PlayerData MARISA_AUTUMN = new PlayerData { S = "魔秋", E = "MarisaAutumn" };
    private readonly PlayerData MARISA_WINTER = new PlayerData { S = "魔冬", E = "MarisaWinter" };

    // sakuya
    private readonly PlayerData SAKUYA = new PlayerData { S = "咲", E = "Sakuya" };
    private readonly PlayerData SAKUYA_A = new PlayerData { S = "咲A", E = "SakuyaA" };
    private readonly PlayerData SAKUYA_B = new PlayerData { S = "咲B", E = "SakuyaB" };

    // sanae
    private readonly PlayerData SANAE = new PlayerData { S = "早", E = "Sanae" };
    private readonly PlayerData SANAE_A = new PlayerData { S = "早A", E = "SanaeA" };
    private readonly PlayerData SANAE_B = new PlayerData { S = "早B", E = "SanaeB" };

    // youmu
    private readonly PlayerData YOUMU = new PlayerData { S = "妖", E = "Youmu" };
    private readonly PlayerData YOUMU_A = new PlayerData { S = "妖A", E = "YoumuA" };
    private readonly PlayerData YOUMU_B = new PlayerData { S = "妖B", E = "YoumuB" };
    private readonly PlayerData YOUMU_C = new PlayerData { S = "妖C", E = "YoumuC" };

    // cirno
    private readonly PlayerData CIRNO = new PlayerData { S = "チ", E = "Cirno" };
    private readonly PlayerData CIRNO_SPRING = new PlayerData { S = "チ春", E = "CirnoSpring" };
    private readonly PlayerData CIRNO_SUMMER = new PlayerData { S = "チ夏", E = "CirnoSummer" };
    private readonly PlayerData CIRNO_AUTUMN = new PlayerData { S = "チ秋", E = "CirnoAutumn" };
    private readonly PlayerData CIRNO_WINTER = new PlayerData { S = "チ冬", E = "CirnoWinter" };

    // Aya
    private readonly PlayerData AYA = new PlayerData { S = "文", E = "Aya" };
    private readonly PlayerData AYA_SPRING = new PlayerData { S = "文春", E = "AyaSpring" };
    private readonly PlayerData AYA_SUMMER = new PlayerData { S = "文夏", E = "AyaSummer" };
    private readonly PlayerData AYA_AUTUMN = new PlayerData { S = "文秋", E = "AyaAutumn" };
    private readonly PlayerData AYA_WINTER = new PlayerData { S = "文冬", E = "AyaWinter" };

    // other
    private readonly PlayerData REISEN = new PlayerData { S = "鈴", E = "Reisen" };
    private readonly PlayerData LYRICA = new PlayerData { S = "リ", E = "Lyrica" };
    private readonly PlayerData MYSTIA = new PlayerData { S = "ミ", E = "Mystia" };
    private readonly PlayerData TEI = new PlayerData { S = "て", E = "Tei" };
    private readonly PlayerData MEDICINE = new PlayerData { S = "メ", E = "Medicine" };
    private readonly PlayerData YUUKA = new PlayerData { S = "香", E = "Yuuka" };
    private readonly PlayerData KOMACHI = new PlayerData { S = "小", E = "Komachi" };
    private readonly PlayerData EIKI = new PlayerData { S = "映", E = "Eiki" };

    // group
    private readonly PlayerData KEKKAI = new PlayerData { S = "結", E = "Kekkai" };
    private readonly PlayerData A_KEKKAI = new PlayerData { S = "A結", E = "AKekkai" };
    private readonly PlayerData B_KEKKAI = new PlayerData { S = "B結", E = "BKekkai" };
    private readonly PlayerData EISHOU = new PlayerData { S = "詠", E = "Eishou" };
    private readonly PlayerData A_EISHOU = new PlayerData { S = "A詠", E = "AEishou" };
    private readonly PlayerData B_EISHOU = new PlayerData { S = "B詠", E = "BEishou" };
    private readonly PlayerData KOUMA = new PlayerData { S = "紅", E = "Kouma" };
    private readonly PlayerData A_KOUMA = new PlayerData { S = "A紅", E = "AKouma" };
    private readonly PlayerData B_KOUMA = new PlayerData { S = "B紅", E = "BKouma" };
    private readonly PlayerData YUUMEI = new PlayerData { S = "冥", E = "Yuumei" };
    private readonly PlayerData A_YUUMEI = new PlayerData { S = "A冥", E = "AYuumei" };
    private readonly PlayerData B_YUUMEI = new PlayerData { S = "B冥", E = "BYuumei" };
    // human
    private readonly PlayerData A_REIMU = new PlayerData { S = "A霊", E = "AReimu" };
    private readonly PlayerData B_REIMU = new PlayerData { S = "B霊", E = "BReimu" };
    private readonly PlayerData A_MARISA = new PlayerData { S = "A魔", E = "AMarisa" };
    private readonly PlayerData B_MARISA = new PlayerData { S = "B魔", E = "BMarisa" };
    private readonly PlayerData A_SAKUYA = new PlayerData { S = "A咲", E = "ASakuya" };
    private readonly PlayerData B_SAKUYA = new PlayerData { S = "B咲", E = "BSakuya" };
    private readonly PlayerData A_YOUMU = new PlayerData { S = "A妖", E = "AYoumu" };
    private readonly PlayerData B_YOUMU = new PlayerData { S = "B妖", E = "BYoumu" };
    // evil
    private readonly PlayerData YUKARI = new PlayerData { S = "紫", E = "Yukari" };
    private readonly PlayerData A_YUKARI = new PlayerData { S = "A紫", E = "AYukari" };
    private readonly PlayerData B_YUKARI = new PlayerData { S = "B紫", E = "BYukari" };
    private readonly PlayerData ALICE = new PlayerData { S = "ア", E = "Alice" };
    private readonly PlayerData A_ALICE = new PlayerData { S = "Aア", E = "AAlice" };
    private readonly PlayerData B_ALICE = new PlayerData { S = "Bア", E = "BAlice" };
    private readonly PlayerData REMILIA = new PlayerData { S = "レ", E = "Remilia" };
    private readonly PlayerData A_REMILIA = new PlayerData { S = "Aレ", E = "ARemilia" };
    private readonly PlayerData B_REMILIA = new PlayerData { S = "Bレ", E = "BRemilia" };
    private readonly PlayerData YUYUKO = new PlayerData { S = "幽", E = "Yuyuko" };
    private readonly PlayerData A_YUYUKO = new PlayerData { S = "A幽", E = "AYuyuko" };
    private readonly PlayerData B_YUYUKO = new PlayerData { S = "B幽", E = "BYuyuko" };

    private readonly string[] TITLES = new string[] {
        "紅魔郷",
        "妖々夢",
        "永夜抄",
        "花映塚",
        "風神録",
        "地霊殿",
        "星蓮船",
        "新霊廟",
        "輝針城",
        "紺珠伝",
        "天空璋",
        "鬼形獣",
        "虹龍洞",
    };
    private readonly DiffData[] DIFFS = new DiffData[] {
        new DiffData { L = "Easy", S = "E" },
        new DiffData { L = "Normal", S = "N" },
        new DiffData { L = "Hard", S = "H" },
        new DiffData { L = "Lunatic", S = "L" },
        new DiffData { L = "Extra", S = "X" },
    };

    protected override string getPath() => "/pages/touhou/clear-table/";

    protected override void outputHead(IWriter writer)
    {
        writer.Write("<link rel='stylesheet' type='text/css' href='/req/clear-table.css'>");
        writer.Write("<script src='/req/clear-table.js'></script>");
        writer.Write("<title>クリア機体表</title>");
    }

    protected override void outputContent(IWriter writer)
    {
        var data = new PlayerData[][][][] {
            // th6
            new PlayerData[][][] {
                new PlayerData[][] {
                    new PlayerData[] { REIMU_A, MARISA_A },
                    new PlayerData[] { REIMU_B, MARISA_B },
                },
            },
            // th7
            new PlayerData[][][] {
                new PlayerData[][] {
                    new PlayerData[] { REIMU_A, MARISA_A, SAKUYA_A },
                    new PlayerData[] { REIMU_B, MARISA_B, SAKUYA_B },
                },
            },
            // th8
            new PlayerData[][][] {
                new PlayerData[][] {
                    new PlayerData[] { A_KEKKAI, A_EISHOU, A_KOUMA, A_YUUMEI, B_KEKKAI, B_EISHOU, B_KOUMA, B_YUUMEI },
                    new PlayerData[] { A_REIMU, A_MARISA, A_SAKUYA, A_YOUMU, B_REIMU, B_MARISA, B_SAKUYA, B_YOUMU },
                    new PlayerData[] { A_YUKARI, A_ALICE, A_REMILIA, A_YUYUKO, B_YUKARI, B_ALICE, B_REMILIA, B_YUYUKO },
                },
                new PlayerData[][] {
                    new PlayerData[] { KEKKAI, EISHOU, KOUMA, YUUMEI },
                    new PlayerData[] { REIMU, MARISA, SAKUYA, YOUMU },
                    new PlayerData[] { YUKARI, ALICE, REMILIA, YUYUKO },
                },
            },
            // th9
            new PlayerData[][][] {
                new PlayerData[][] {
                    new PlayerData[] { REIMU, MARISA, SAKUYA, YOUMU, REISEN },
                    new PlayerData[] { CIRNO, LYRICA, MYSTIA, TEI, AYA },
                    new PlayerData[] { MEDICINE, YUUKA, KOMACHI, EIKI },
                },
            },
            // th10
            new PlayerData[][][] {
                new PlayerData[][] {
                    new PlayerData[] { REIMU_A, REIMU_B, REIMU_C },
                    new PlayerData[] { MARISA_A, MARISA_B, MARISA_C },
                },
            },
            // th11
            new PlayerData[][][] {
                new PlayerData[][] {
                    new PlayerData[] { REIMU_A, REIMU_B, REIMU_C },
                    new PlayerData[] { MARISA_A, MARISA_B, MARISA_C },
                },
            },
            // th12
            new PlayerData[][][] {
                new PlayerData[][] {
                    new PlayerData[] { REIMU_A, MARISA_A, SANAE_A },
                    new PlayerData[] { REIMU_B, MARISA_B, SANAE_B },
                },
            },
            // th13
            new PlayerData[][][] {
                new PlayerData[][] {
                    new PlayerData[] { REIMU, MARISA },
                    new PlayerData[] { SANAE, YOUMU },
                },
            },
            // th14
            new PlayerData[][][] {
                new PlayerData[][] {
                    new PlayerData[] { REIMU_A, MARISA_A, SAKUYA_A },
                    new PlayerData[] { REIMU_B, MARISA_B, SAKUYA_B },
                },
            },
            // th15
            new PlayerData[][][] {
                new PlayerData[][] {
                    new PlayerData[] { REIMU, MARISA },
                    new PlayerData[] { SANAE, REISEN },
                },
            },
            // th16
            new PlayerData[][][] {
                new PlayerData[][] {
                    new PlayerData[] { REIMU_SPRING, CIRNO_SPRING, AYA_SPRING, MARISA_SPRING },
                    new PlayerData[] { REIMU_SUMMER, CIRNO_SUMMER, AYA_SUMMER, MARISA_SUMMER },
                    new PlayerData[] { REIMU_AUTUMN, CIRNO_AUTUMN, AYA_AUTUMN, MARISA_AUTUMN },
                    new PlayerData[] { REIMU_WINTER, CIRNO_WINTER, AYA_WINTER, MARISA_WINTER },
                },
                new PlayerData[][] {
                    new PlayerData[] { REIMU, CIRNO, AYA, MARISA },
                },
            },
            // th17
            new PlayerData[][][] {
                new PlayerData[][] {
                    new PlayerData[] { REIMU_A, MARISA_A, YOUMU_A },
                    new PlayerData[] { REIMU_B, MARISA_B, YOUMU_B },
                    new PlayerData[] { REIMU_C, MARISA_C, YOUMU_C },
                }
            },
            // th18
            new PlayerData[][][] {
                new PlayerData[][] {
                    new PlayerData[] { REIMU, MARISA },
                    new PlayerData[] { SANAE, SAKUYA },
                },
            },
        };

        new Node("div")
            .AddAttribute("class", "ta-center")
            .AddChild(new Node("p")
                .AddChild(new Node("span").SetInnerText("SKD(天狗)の東方整数作品のクリア機体表兼リプレイ置き場です。"))
                .AddChild(new Node("br"))
                .AddChild(new Node("span").SetInnerText("同階級の実績のうち、最も古いリプレイを安置しています。")))
            .AddChild(new Node("p").SetInnerText("クリア済なのに登録していなかったり紛失していたりします。"))
            .AddChild(new Node("p")
                .AddChild(new Node("span").SetInnerText("NBについて、3M以内であれば特筆してあります。"))
                .AddChild(new Node("br"))
                .AddChild(new Node("span").SetInnerText("スコアタは紅EX魔Bしかやっていないのでありません。")))
            .AddChild(new Node("hr"))
            .Output(writer);
        new Node("br").Output(writer);

        var tableNode = new Node("table").AddAttribute("class", "main-table");
        // th6,7,8,9,10,11,12
        var upperTr = new Node("tr");
        for (int i = 0; i < 7; ++i)
        {
            upperTr.AddChild(new Node("td").AddChild(this.createWorkTable(data[i], i + 6, TITLES[i])));
        }
        tableNode.AddChild(upperTr);
        // th13,14,15,16,17,18
        var lowerTr = new Node("tr");
        for (int i = 7; i < data.Length; ++i)
        {
            lowerTr.AddChild(new Node("td").AddChild(this.createWorkTable(data[i], i + 6, TITLES[i])));
        }
        lowerTr
            .AddChild(new Node("td")
                .AddChild(new Node("table")
                    .AddAttribute("class", "th6")
                    .AddChild(new Node("tr").AddChild(new Node("th").SetInnerText("　")))
                    .AddChild(new Node("tr").AddChild(new Node("td").AddAttribute("class", "nmnbnr").SetInnerText("NMNBNR")))
                    .AddChild(new Node("tr").AddChild(new Node("td").AddAttribute("class", "nmnb").SetInnerText("NMNB")))
                    .AddChild(new Node("tr").AddChild(new Node("td").AddAttribute("class", "nmnr").SetInnerText("NMNR")))
                    .AddChild(new Node("tr").AddChild(new Node("td").AddAttribute("class", "nm").SetInnerText("NM")))
                    .AddChild(new Node("tr").AddChild(new Node("td").AddAttribute("class", "nbnr").SetInnerText("NBNR")))
                    .AddChild(new Node("tr").AddChild(new Node("td").AddAttribute("class", "nb").SetInnerText("NB")))
                    .AddChild(new Node("tr").AddChild(new Node("td").AddAttribute("class", "c").SetInnerText("ALL")))
                    .AddChild(new Node("tr").AddChild(new Node("td").AddAttribute("class", "").SetInnerText("not-cleared")))));
        tableNode.AddChild(lowerTr);
        tableNode.Output(writer);

        new Node("p")
            .AddAttribute("class", "ta-center")
            .AddChild(new Node("a").AddAttribute("href", "/pages/").SetInnerText("戻る"))
            .Output(writer);
    }

    private IComponent createWorkTable(PlayerData[][][] work, int th, string title)
    {
        var workTable = new Node("table")
            .AddAttribute("class", $"th{th}")
            .AddChild(new Node("tr")
                .AddChild(new Node("th")
                    .AddAttribute("colSpan", $"{work[0][0].Length + 1}")
                    .SetInnerText($"{title}")));
        // E,N,H,L,X
        for (int diff = 0; diff < this.DIFFS.Length; ++diff)
        {
            var chars = work[0];
            if (diff == 4 && work.Length == 2)
            {
                chars = work[1];
            }
            // chars
            for (int k = 0; k < chars.Length; ++k)
            {
                var trNode = new Node("tr");
                if (k == 0)
                {
                    trNode.AddChild(new Node("td").AddAttribute("rowSpan", $"{chars.Length}").AddAttribute("class", "diff").SetInnerText($"{this.DIFFS[diff].S}"));
                }
                foreach (var chara in chars[k])
                {
                    trNode.AddChild(new Node("td").AddAttribute("class", $"th{th}_{this.DIFFS[diff].L}_{chara.E}").SetInnerText(chara.S));
                }
                workTable.AddChild(trNode);
            }
        }
        // for th7 P
        if (th == 7)
        {
            var chars = work[0];
            // chars
            for (int k = 0; k < chars.Length; ++k)
            {
                var trNode = new Node("tr");
                if (k == 0)
                {
                    trNode.AddChild(new Node("td").AddAttribute("rowSpan", $"{chars.Length}").AddAttribute("class", "diff").SetInnerText($"P"));
                }
                foreach (var chara in chars[k])
                {
                    trNode.AddChild(new Node("td").AddAttribute("class", $"th7_Phantasm_{chara.E}").SetInnerText(chara.S));
                }
                workTable.AddChild(trNode);
            }
        }
        return workTable;
    }
}
