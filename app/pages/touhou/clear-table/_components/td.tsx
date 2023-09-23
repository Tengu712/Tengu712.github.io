import style from './td.module.css'

import { Data, DataMap } from "../_ts/data"

import { Dispatch, SetStateAction } from 'react'

type Props = {
  content: string,
  map: DataMap,
  no: string,
  diff: string,
  player: string,
  releasable?: true,
  setData: Dispatch<SetStateAction<Data | null>>,
}

function getClassName(achivement: string, releasable?: true): string {
  if (releasable) {
    if (achivement.includes('NMNBNR')) return style.nmnbnr
    if (achivement.includes('NMNBNV')) return style.nmnbnr
    if (achivement.includes('NMNBNT')) return style.nmnbnr
    if (achivement.includes('NMNBNC')) return style.nmnbnr
    if (achivement.includes('NMNB')) return style.nmnb
    if (achivement.includes('NMNR')) return style.nmnr
    if (achivement.includes('NMNV')) return style.nmnr
    if (achivement.includes('NMNT')) return style.nmnr
    if (achivement.includes('NMNC')) return style.nmnr
    if (achivement.includes('NM')) return style.nm
    if (achivement.includes('NBNR')) return style.nbnr
    if (achivement.includes('NBNV')) return style.nbnr
    if (achivement.includes('NBNT')) return style.nbnr
    if (achivement.includes('NBNC')) return style.nbnr
    if (achivement.includes('NB')) return style.nb
    return style.c
  }
  else {
    if (achivement.includes('NMNB')) return style.nmnbnr
    if (achivement.includes('NM')) return style.nmnr
    if (achivement.includes('NB')) return style.nbnr
    return style.c
  }
}

export default function Td(props: Props) {
  const data = props.map.get(props.no)?.get(props.diff)?.get(props.player)
  if (data === undefined) {
    return (
      <td>{props.content}</td>
    )
  }
  return (
    <td className={getClassName(data.achievement, props.releasable)}>
      <a onClick={() => props.setData(data)}>
        {props.content}
      </a>
    </td>
  )
}