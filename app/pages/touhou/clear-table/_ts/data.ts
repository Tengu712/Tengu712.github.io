export type Data = {
  full: string,
  no: string,
  diff: string,
  player: string,
  achievement: string,
  date: string,
}
export type MapPlayer = Map<string, Data>
export type MapDiff = Map<string, MapPlayer>
export type DataMap = Map<string, MapDiff>

function parse(map: DataMap, s: string) {
  if (s.startsWith('_')) {
    return
  }
  const splitted = s.split('_')
  if (splitted.length !== 5) {
    console.warn('[ warning ] pages/touhou/ts/data.ts: parse(): invalid file name found: ', s)
    return
  }
  if (!map.has(splitted[0])) map.set(splitted[0], new Map())
  const diffs = map.get(splitted[0])!
  if (!diffs.has(splitted[1])) diffs.set(splitted[1], new Map())
  const players = diffs.get(splitted[1])!
  if (players.has(splitted[2])) {
    console.warn('[ warning] pages/touhou/ts/data.ts: parse(): duplicated data found: ', s)
    return null
  }
  players.set(splitted[2], {
    full: s,
    no: splitted[0],
    diff: splitted[1],
    player: splitted[2],
    achievement: splitted[3],
    date: splitted[4].slice(0, 8),
  })
}

/// WARNING: this must be called just one time on document loaded because fetch called in this function.
export async function getList(): Promise<DataMap | null> {
  const response = await fetch('https://listrpys.genreihoutengu.workers.dev')
  if (!response.ok) {
    console.error('[ error ] pages/touhou/ts/data.ts: getList(): failed to get list of replay files.')
    return null
  }
  const json = await response.json() as { list: string[] }
  const map = new Map<string, MapDiff>()
  for (const n of json.list) {
    parse(map, n)
  }
  return map
}
