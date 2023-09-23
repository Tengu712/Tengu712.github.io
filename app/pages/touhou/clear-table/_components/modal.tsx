import style from './modal.module.css'

import { Data } from '../_ts/data'

import { Dispatch, SetStateAction } from 'react'

type Props = {
  data: Data | null,
  setData: Dispatch<SetStateAction<Data | null>>,
}

export default function Modal({ data, setData }: Props) {
  return (
    <>
      {data !== null &&
        <div className={style.modal}>
          <p className='ta-right'><a onClick={() => setData(null)}>×</a></p>
          <p>
            作品：{data.no}<br />
            難易度：{data.diff}<br />
            機体：{data.player}<br />
            実績：{data.achievement}
          </p>
          <p className='ta-center'><a href={'https://rpys.skdassoc.work/' + data.full}>ダウンロード</a></p>
        </div>
      }
    </>
  )
}