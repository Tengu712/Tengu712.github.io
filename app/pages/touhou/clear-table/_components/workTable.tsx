import style from './workTable.module.css'

import Td from './td'

import { Data, DataMap } from "../_ts/data"
import { WORKS } from "../_ts/work"

import { Dispatch, SetStateAction } from 'react'

type Props = {
  idx: number,
  map: DataMap,
  setData: Dispatch<SetStateAction<Data | null>>,
}

function getClassName(no: string): string {
  switch (no) {
    case 'th6': return style.th6
    case 'th7': return style.th7
    case 'th8': return style.th8
    case 'th9': return style.th9
    case 'th10': return style.th10
    case 'th11': return style.th11
    case 'th12': return style.th12
    case 'th13': return style.th13
    case 'th14': return style.th14
    case 'th15': return style.th15
    case 'th16': return style.th16
    case 'th17': return style.th17
    case 'th18': return style.th18
    default: return style.th6
  }
}

export default function WorkTable({ idx, map, setData }: Props): JSX.Element {
  const n = WORKS[idx]
  return (
    <table className={getClassName(n.no)}>
      <thead>
        <tr>
          <th colSpan={n.players(0)[0].length + 1}>{n.title}</th>
        </tr>
      </thead>
      <tbody>
        {n.diffs.map((diff, i) => {
          const pplayers = n.players(i)
          return (
            n.players(i).map((players, j) =>
              <tr key={j}>
                {j === 0 && (<td rowSpan={pplayers.length}>{diff.short}</td>)}
                {players.map((player, k) =>
                  <Td
                    key={k}
                    content={player.short}
                    map={map}
                    no={n.no}
                    diff={diff.long}
                    player={player.eng}
                    releasable={n.releasable}
                    setData={setData}
                  />
                )}
              </tr>
            ))
        })}
      </tbody>
    </table>
  )
}