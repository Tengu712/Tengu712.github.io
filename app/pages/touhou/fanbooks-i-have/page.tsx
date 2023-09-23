import './style.css'

import { Metadata } from 'next'

import { Fanbooks } from './data'

export const metadata: Metadata = {
  title: '紙媒体で所有する・かつ既読の東方同人誌',
}

export default function Content() {
  const isTopline = (() => {
    let prev = ''
    return (circle: string) => {
      if (prev === circle) return false
      prev = circle
      return true
    }
  })()
  return (
    <main>
      <h1>紙媒体で所有する・かつ既読の東方同人誌</h1>

      <p>
        「∀本∈{'{'}表中にある{'}'}, 紙媒体として所有している∧読了している」であって、
        <br />
        「∀本∈{'{'}紙媒体として所有している∧読了している{'}'}, 表中にある」でないことに留意せよ。
      </p>
      <p className="ta-right">
        2023/6/21更新
      </p>

      <table>
        <thead>
          <tr>
            <th>サークル名</th>
            <th className="hidable">作者名</th>
            <th>題名</th>
            <th className="hidable">発行日</th>
          </tr>
        </thead>
        <tbody>
          {Fanbooks.map((n, i) => (
            <tr key={i} className={isTopline(n[0]) ? 'topline' : ''}>
              <td>{n[0]}</td>
              <td className='hidable'>{n[1]}</td>
              <td>{n[2]}</td>
              <td className='hidable'>{n[3]}</td>
            </tr>
          ))}
        </tbody>
      </table>

      <p className='ta-center'>
        <a href='/pages'>戻る</a>
      </p>
    </main>
  )
}