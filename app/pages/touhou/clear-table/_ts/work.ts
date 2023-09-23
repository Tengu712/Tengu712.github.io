import * as D from './diff'
import * as P from './player'

export type Element = {
  no: string,
  title: string,
  diffs: D.Diff[],
  players: (_: number) => P.Player[][],
  releasable?: true,
}

export const WORKS: Element[] = [
  {
    no: 'th6',
    title: '紅魔郷',
    diffs: D.ENHLX,
    players: (_) => [[P.REIMU_A, P.MARISA_A], [P.REIMU_B, P.MARISA_B]],
  },
  {
    no: 'th7',
    title: '妖々夢',
    diffs: D.ENHLXP,
    players: (_) => [[P.REIMU_A, P.MARISA_A, P.SAKUYA_A], [P.REIMU_B, P.MARISA_B, P.SAKUYA_B]],
    releasable: true,
  },
  {
    no: 'th8',
    title: '永夜抄',
    diffs: D.ENHLX,
    players: (d) => d < 4
      ? [
        [P.A_KEKKAI, P.A_EISHOU, P.A_KOUMA, P.A_YUUMEI, P.B_KEKKAI, P.B_EISHOU, P.B_KOUMA, P.B_YUUMEI],
        [P.A_REIMU, P.A_MARISA, P.A_SAKUYA, P.A_YOUMU, P.B_REIMU, P.B_MARISA, P.B_SAKUYA, P.B_YOUMU],
        [P.A_YUKARI, P.A_ALICE, P.A_REMILIA, P.A_YUYUKO, P.B_YUKARI, P.B_ALICE, P.B_REMILIA, P.B_YUYUKO]
      ]
      : [
        [P.KEKKAI, P.EISHOU, P.KOUMA, P.YUUMEI],
        [P.REIMU, P.MARISA, P.SAKUYA, P.YOUMU],
        [P.YUKARI, P.ALICE, P.REMILIA, P.YUYUKO],
      ],
  },
  {
    no: 'th9',
    title: '花映塚',
    diffs: D.ENHLX,
    players: (_) => [
      [P.REIMU, P.MARISA, P.SAKUYA, P.YOUMU, P.REISEN],
      [P.CIRNO, P.LYRICA, P.MYSTIA, P.TEI, P.AYA],
      [P.MEDICINE, P.YUUKA, P.KOMACHI, P.EIKI],
    ],
  },
  {
    no: 'th10',
    title: '風神録',
    diffs: D.ENHLX,
    players: (_) => [[P.REIMU_A, P.REIMU_B, P.REIMU_C], [P.MARISA_A, P.MARISA_B, P.MARISA_C]],
  },
  {
    no: 'th11',
    title: '地霊殿',
    diffs: D.ENHLX,
    players: (_) => [[P.REIMU_A, P.REIMU_B, P.REIMU_C], [P.MARISA_A, P.MARISA_B, P.MARISA_C]],
  },
  {
    no: 'th12',
    title: '星蓮船',
    diffs: D.ENHLX,
    players: (_) => [[P.REIMU_A, P.MARISA_A, P.SANAE_A], [P.REIMU_B, P.MARISA_B, P.SANAE_B]],
    releasable: true,
  },
  {
    no: 'th13',
    title: '神霊廟',
    diffs: D.ENHLX,
    players: (_) => [[P.REIMU, P.MARISA], [P.SANAE, P.YOUMU]],
    releasable: true,
  },
  {
    no: 'th14',
    title: '輝針城',
    diffs: D.ENHLX,
    players: (_) => [[P.REIMU_A, P.MARISA_A, P.SAKUYA_A], [P.REIMU_B, P.MARISA_B, P.SAKUYA_B]],
  },
  {
    no: 'th15',
    title: '紺珠伝',
    diffs: D.ENHLX,
    players: (_) => [[P.REIMU, P.MARISA], [P.SANAE, P.REISEN]],
  },
  {
    no: 'th16',
    title: '天空璋',
    diffs: D.ENHLX,
    players: (d) => d < 4
      ? [
        [P.REIMU_SPRING, P.CIRNO_SPRING, P.AYA_SPRING, P.MARISA_SPRING],
        [P.REIMU_SUMMER, P.CIRNO_SUMMER, P.AYA_SUMMER, P.MARISA_SUMMER],
        [P.REIMU_AUTUMN, P.CIRNO_AUTUMN, P.AYA_AUTUMN, P.MARISA_AUTUMN],
        [P.REIMU_WINTER, P.CIRNO_WINTER, P.AYA_WINTER, P.MARISA_WINTER],
      ]
      : [
        [P.REIMU, P.CIRNO, P.AYA, P.MARISA],
      ],
    releasable: true,
  },
  {
    no: 'th17',
    title: '鬼形獣',
    diffs: D.ENHLX,
    players: (_) => [
      [P.REIMU_A, P.MARISA_A, P.YOUMU_A],
      [P.REIMU_B, P.MARISA_B, P.YOUMU_B],
      [P.REIMU_C, P.MARISA_C, P.YOUMU_C]
    ],
    releasable: true,
  },
  {
    no: 'th18',
    title: '虹龍洞',
    diffs: D.ENHLX,
    players: (_) => [[P.REIMU, P.MARISA], [P.SANAE, P.SAKUYA]],
    releasable: true,
  },
]

const HALF = Math.ceil(WORKS.length / 2)
const INDICES = [...Array(WORKS.length)].map((_, i) => i)

export const LastIndex = WORKS.length - 1
export const UpperIndices = INDICES.filter((i) => i < HALF)
export const LowerIndices = INDICES.filter((i) => i >= HALF)
