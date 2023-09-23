"use client"
import './style.css'

import WorkTable from './_components/workTable'
import Legend from './_components/legend'
import Modal from './_components/modal'

import { Data, DataMap, getList } from './_ts/data'
import { LowerIndices, UpperIndices } from './_ts/work'

import { useEffect, useState } from 'react'

export default function Content() {
  const [data, setData] = useState<Data | null>(null)
  const [map, setMap] = useState<DataMap>(new Map())
  useEffect(() => {
    getList().then((n) => n !== null ? setMap(n) : {})
  }, [])

  return (
    <main>
      <div className="ta-center">
        <p>
          SKD(天狗)の東方整数作品のクリア機体表兼リプレイ置き場です。
          <br />
          同階級の実績のうち、最も古いリプレイを安置しています。
        </p>
        <p>
          クリア済なのに登録していなかったり紛失していたりします。
        </p>
        <p>
          NBについて、3M以内であれば特筆してあります。
          <br />
          スコアタは紅EX魔Bしかやっていないのでありません。
        </p>
        <hr />
      </div>

      <br />

      <table id='main-table'>
        <tbody>
          <tr>
            {UpperIndices.map((i, j) =>
              <td key={j}><WorkTable idx={i} map={map} setData={setData} /></td>
            )}
          </tr>
          <tr>
            {LowerIndices.map((i, j) =>
              <td key={j}><WorkTable idx={i} map={map} setData={setData} /></td>
            )}
            <td><Legend /></td>
          </tr>
        </tbody>
      </table>

      <Modal data={data} setData={setData} />
    </main>
  )
}