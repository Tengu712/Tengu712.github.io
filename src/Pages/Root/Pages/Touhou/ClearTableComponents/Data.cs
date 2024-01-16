namespace Ssg.Pages.Root.Pages.Touhou.ClearTableComponents;

public class Data
{
    public static readonly string[] TITLES = new string[] {
        "",
        "靈異伝",
        "封魔録",
        "夢時空",
        "幻想郷",
        "怪綺談",
        "紅魔郷",
        "妖々夢",
        "永夜抄",
        "花映塚",
        "風神録",
        "地霊殿",
        "星蓮船",
        "神霊廟",
        "輝針城",
        "紺珠伝",
        "天空璋",
        "鬼形獣",
        "虹龍洞",
    };

    // ===================================================================================================================================================== //

    public class DiffData
    {
        public string L { get; init; } = "";
        public string S { get; init; } = "";
    }

    public static readonly DiffData[] DIFFS = new DiffData[] {
        new DiffData { L = "Easy", S = "E" },
        new DiffData { L = "Normal", S = "N" },
        new DiffData { L = "Hard", S = "H" },
        new DiffData { L = "Lunatic", S = "L" },
        new DiffData { L = "Extra", S = "X" },
    };

    // ===================================================================================================================================================== //

    public class PlayerData
    {
        public string S { get; init; } = "";
        public string E { get; init; } = "";
        public string L { get; init; } = "";
    }

    // reimu
    public static readonly PlayerData REIMU = new PlayerData { S = "霊", E = "Reimu", L = "霊夢" };
    public static readonly PlayerData REIMU_A = new PlayerData { S = "霊A", E = "ReimuA", L = "霊夢A" };
    public static readonly PlayerData REIMU_B = new PlayerData { S = "霊B", E = "ReimuB", L = "霊夢B" };
    public static readonly PlayerData REIMU_C = new PlayerData { S = "霊C", E = "ReimuC", L = "霊夢C" };
    public static readonly PlayerData REIMU_SPRING = new PlayerData { S = "霊春", E = "ReimuSpring", L = "霊夢(春)" };
    public static readonly PlayerData REIMU_SUMMER = new PlayerData { S = "霊夏", E = "ReimuSummer", L = "霊夢(夏)" };
    public static readonly PlayerData REIMU_AUTUMN = new PlayerData { S = "霊秋", E = "ReimuAutumn", L = "霊夢(秋)" };
    public static readonly PlayerData REIMU_WINTER = new PlayerData { S = "霊冬", E = "ReimuWinter", L = "霊夢(冬)" };

    // marisa
    public static readonly PlayerData MARISA = new PlayerData { S = "魔", E = "Marisa", L = "魔理沙" };
    public static readonly PlayerData MARISA_A = new PlayerData { S = "魔A", E = "MarisaA", L = "魔理沙A" };
    public static readonly PlayerData MARISA_B = new PlayerData { S = "魔B", E = "MarisaB", L = "魔理沙B" };
    public static readonly PlayerData MARISA_C = new PlayerData { S = "魔C", E = "MarisaC", L = "魔理沙C" };
    public static readonly PlayerData MARISA_SPRING = new PlayerData { S = "魔春", E = "MarisaSpring", L = "魔理沙(春)" };
    public static readonly PlayerData MARISA_SUMMER = new PlayerData { S = "魔夏", E = "MarisaSummer", L = "魔理沙(夏)" };
    public static readonly PlayerData MARISA_AUTUMN = new PlayerData { S = "魔秋", E = "MarisaAutumn", L = "魔理沙(秋)" };
    public static readonly PlayerData MARISA_WINTER = new PlayerData { S = "魔冬", E = "MarisaWinter", L = "魔理沙(冬)" };

    // sakuya
    public static readonly PlayerData SAKUYA = new PlayerData { S = "咲", E = "Sakuya", L = "咲夜" };
    public static readonly PlayerData SAKUYA_A = new PlayerData { S = "咲A", E = "SakuyaA", L = "咲夜A" };
    public static readonly PlayerData SAKUYA_B = new PlayerData { S = "咲B", E = "SakuyaB", L = "咲夜B" };

    // sanae
    public static readonly PlayerData SANAE = new PlayerData { S = "早", E = "Sanae", L = "早苗" };
    public static readonly PlayerData SANAE_A = new PlayerData { S = "早A", E = "SanaeA", L = "早苗A" };
    public static readonly PlayerData SANAE_B = new PlayerData { S = "早B", E = "SanaeB", L = "早苗B" };

    // youmu
    public static readonly PlayerData YOUMU = new PlayerData { S = "妖", E = "Youmu", L = "妖夢" };
    public static readonly PlayerData YOUMU_A = new PlayerData { S = "妖A", E = "YoumuA", L = "妖夢A" };
    public static readonly PlayerData YOUMU_B = new PlayerData { S = "妖B", E = "YoumuB", L = "妖夢B" };
    public static readonly PlayerData YOUMU_C = new PlayerData { S = "妖C", E = "YoumuC", L = "妖夢C" };

    // cirno
    public static readonly PlayerData CIRNO = new PlayerData { S = "チ", E = "Cirno", L = "チルノ" };
    public static readonly PlayerData CIRNO_SPRING = new PlayerData { S = "チ春", E = "CirnoSpring", L = "チルノ(春)" };
    public static readonly PlayerData CIRNO_SUMMER = new PlayerData { S = "チ夏", E = "CirnoSummer", L = "チルノ(夏)" };
    public static readonly PlayerData CIRNO_AUTUMN = new PlayerData { S = "チ秋", E = "CirnoAutumn", L = "チルノ(秋)" };
    public static readonly PlayerData CIRNO_WINTER = new PlayerData { S = "チ冬", E = "CirnoWinter", L = "チルノ(冬)" };

    // Aya
    public static readonly PlayerData AYA = new PlayerData { S = "文", E = "Aya", L = "文" };
    public static readonly PlayerData AYA_SPRING = new PlayerData { S = "文春", E = "AyaSpring", L = "文(春)" };
    public static readonly PlayerData AYA_SUMMER = new PlayerData { S = "文夏", E = "AyaSummer", L = "文(夏)" };
    public static readonly PlayerData AYA_AUTUMN = new PlayerData { S = "文秋", E = "AyaAutumn", L = "文(秋)" };
    public static readonly PlayerData AYA_WINTER = new PlayerData { S = "文冬", E = "AyaWinter", L = "文(冬)" };

    // other
    public static readonly PlayerData REISEN = new PlayerData { S = "鈴", E = "Reisen", L = "鈴仙" };
    public static readonly PlayerData LYRICA = new PlayerData { S = "リ", E = "Lyrica", L = "リリカ" };
    public static readonly PlayerData MYSTIA = new PlayerData { S = "ミ", E = "Mystia", L = "ミスティア" };
    public static readonly PlayerData TEI = new PlayerData { S = "て", E = "Tei", L = "てゐ" };
    public static readonly PlayerData MEDICINE = new PlayerData { S = "メ", E = "Medicine", L = "メディスン" };
    public static readonly PlayerData YUUKA = new PlayerData { S = "香", E = "Yuuka", L = "幽香" };
    public static readonly PlayerData KOMACHI = new PlayerData { S = "小", E = "Komachi", L = "小町" };
    public static readonly PlayerData EIKI = new PlayerData { S = "映", E = "Eiki", L = "映姫" };

    // group
    public static readonly PlayerData KEKKAI = new PlayerData { S = "結", E = "Kekkai", L = "結界組" };
    public static readonly PlayerData A_KEKKAI = new PlayerData { S = "A結", E = "AKekkai", L = "√A 結界組" };
    public static readonly PlayerData B_KEKKAI = new PlayerData { S = "B結", E = "BKekkai", L = "√B 結界組" };
    public static readonly PlayerData EISHOU = new PlayerData { S = "詠", E = "Eishou", L = "詠唱組" };
    public static readonly PlayerData A_EISHOU = new PlayerData { S = "A詠", E = "AEishou", L = "√A 詠唱組" };
    public static readonly PlayerData B_EISHOU = new PlayerData { S = "B詠", E = "BEishou", L = "√B 詠唱組" };
    public static readonly PlayerData KOUMA = new PlayerData { S = "紅", E = "Kouma", L = "紅魔組" };
    public static readonly PlayerData A_KOUMA = new PlayerData { S = "A紅", E = "AKouma", L = "√A 紅魔組" };
    public static readonly PlayerData B_KOUMA = new PlayerData { S = "B紅", E = "BKouma", L = "√B 紅魔組" };
    public static readonly PlayerData YUUMEI = new PlayerData { S = "冥", E = "Yuumei", L = "幽冥組" };
    public static readonly PlayerData A_YUUMEI = new PlayerData { S = "A冥", E = "AYuumei", L = "√A 幽冥組" };
    public static readonly PlayerData B_YUUMEI = new PlayerData { S = "B冥", E = "BYuumei", L = "√B 幽冥組" };
    // human
    public static readonly PlayerData A_REIMU = new PlayerData { S = "A霊", E = "AReimu", L = "√A 霊夢" };
    public static readonly PlayerData B_REIMU = new PlayerData { S = "B霊", E = "BReimu", L = "√B 霊夢" };
    public static readonly PlayerData A_MARISA = new PlayerData { S = "A魔", E = "AMarisa", L = "√A 魔理沙" };
    public static readonly PlayerData B_MARISA = new PlayerData { S = "B魔", E = "BMarisa", L = "√B 魔理沙" };
    public static readonly PlayerData A_SAKUYA = new PlayerData { S = "A咲", E = "ASakuya", L = "√A 咲夜" };
    public static readonly PlayerData B_SAKUYA = new PlayerData { S = "B咲", E = "BSakuya", L = "√B 咲夜" };
    public static readonly PlayerData A_YOUMU = new PlayerData { S = "A妖", E = "AYoumu", L = "√A 妖夢" };
    public static readonly PlayerData B_YOUMU = new PlayerData { S = "B妖", E = "BYoumu", L = "√B 妖夢" };
    // evil
    public static readonly PlayerData YUKARI = new PlayerData { S = "紫", E = "Yukari", L = "紫" };
    public static readonly PlayerData A_YUKARI = new PlayerData { S = "A紫", E = "AYukari", L = "√A 紫" };
    public static readonly PlayerData B_YUKARI = new PlayerData { S = "B紫", E = "BYukari", L = "√B 紫" };
    public static readonly PlayerData ALICE = new PlayerData { S = "ア", E = "Alice", L = "アリス" };
    public static readonly PlayerData A_ALICE = new PlayerData { S = "Aア", E = "AAlice", L = "√A アリス" };
    public static readonly PlayerData B_ALICE = new PlayerData { S = "Bア", E = "BAlice", L = "√B アリス" };
    public static readonly PlayerData REMILIA = new PlayerData { S = "レ", E = "Remilia", L = "レミリア" };
    public static readonly PlayerData A_REMILIA = new PlayerData { S = "Aレ", E = "ARemilia", L = "√A レミリア" };
    public static readonly PlayerData B_REMILIA = new PlayerData { S = "Bレ", E = "BRemilia", L = "√B レミリア" };
    public static readonly PlayerData YUYUKO = new PlayerData { S = "幽", E = "Yuyuko", L = "幽々子" };
    public static readonly PlayerData A_YUYUKO = new PlayerData { S = "A幽", E = "AYuyuko", L = "√A 幽々子" };
    public static readonly PlayerData B_YUYUKO = new PlayerData { S = "B幽", E = "BYuyuko", L = "√B 幽々子" };

    // ===================================================================================================================================================== //

    public static readonly PlayerData[][][][] PD_ALL_DIFFS = new PlayerData[][][][] {
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

    // ===================================================================================================================================================== //

    public static readonly PlayerData[][][] PD_LUNATIC_ONLY = new PlayerData[][][] {
        // th6
        new PlayerData[][] {
            new PlayerData[] { REIMU_A, REIMU_B, MARISA_A, MARISA_B },
        },
        // th7
        new PlayerData[][] {
            new PlayerData[] { REIMU_A, MARISA_A, SAKUYA_A },
            new PlayerData[] { REIMU_B, MARISA_B, SAKUYA_B },
        },
        // th8
        new PlayerData[][] {
            new PlayerData[] { A_KEKKAI, A_EISHOU, A_KOUMA, A_YUUMEI },
            new PlayerData[] { A_REIMU, A_MARISA, A_SAKUYA, A_YOUMU },
            new PlayerData[] { A_YUKARI, A_ALICE, A_REMILIA, A_YUYUKO },
            new PlayerData[] { B_KEKKAI, B_EISHOU, B_KOUMA, B_YUUMEI },
            new PlayerData[] { B_REIMU, B_MARISA, B_SAKUYA, B_YOUMU },
            new PlayerData[] { B_YUKARI, B_ALICE, B_REMILIA, B_YUYUKO },
        },
        // th9
        new PlayerData[][] {
            new PlayerData[] { REIMU, MARISA, SAKUYA, YOUMU },
            new PlayerData[] { REISEN, CIRNO, LYRICA, MYSTIA },
            new PlayerData[] { TEI, AYA, MEDICINE, YUUKA },
            new PlayerData[] { KOMACHI, EIKI },
        },
        // th10
        new PlayerData[][] {
            new PlayerData[] { REIMU_A, REIMU_B, REIMU_C },
            new PlayerData[] { MARISA_A, MARISA_B, MARISA_C },
        },
        // th11
        new PlayerData[][] {
            new PlayerData[] { REIMU_A, REIMU_B, REIMU_C },
            new PlayerData[] { MARISA_A, MARISA_B, MARISA_C },
        },
        // th12
        new PlayerData[][] {
            new PlayerData[] { REIMU_A, MARISA_A, SANAE_A },
            new PlayerData[] { REIMU_B, MARISA_B, SANAE_B },
        },
        // th13
        new PlayerData[][] {
            new PlayerData[] { REIMU, MARISA, SANAE, YOUMU },
        },
        // th14
        new PlayerData[][] {
            new PlayerData[] { REIMU_A, MARISA_A, SAKUYA_A },
            new PlayerData[] { REIMU_B, MARISA_B, SAKUYA_B },
        },
        // th15
        new PlayerData[][] {
            new PlayerData[] { REIMU, MARISA, SANAE, REISEN },
        },
        // th16
        new PlayerData[][] {
            new PlayerData[] { REIMU_SPRING, CIRNO_SPRING, AYA_SPRING, MARISA_SPRING },
            new PlayerData[] { REIMU_SUMMER, CIRNO_SUMMER, AYA_SUMMER, MARISA_SUMMER },
            new PlayerData[] { REIMU_AUTUMN, CIRNO_AUTUMN, AYA_AUTUMN, MARISA_AUTUMN },
            new PlayerData[] { REIMU_WINTER, CIRNO_WINTER, AYA_WINTER, MARISA_WINTER },
        },
        // th17
        new PlayerData[][] {
            new PlayerData[] { REIMU_A, MARISA_A, YOUMU_A },
            new PlayerData[] { REIMU_B, MARISA_B, YOUMU_B },
            new PlayerData[] { REIMU_C, MARISA_C, YOUMU_C },
        },
        // th18
        new PlayerData[][] {
            new PlayerData[] { REIMU, MARISA, SANAE, SAKUYA },
        },
    };
}
