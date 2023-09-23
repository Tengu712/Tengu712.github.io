import styleTd from './td.module.css'
import styleTable from './workTable.module.css'

export default function Legend(): JSX.Element {
  return (
    <table className={styleTable.th6}>
      <thead>
        <tr><th>　</th></tr>
      </thead>
      <tbody>
        <tr><td className={styleTd.nmnbnr}>NMNBNR</td></tr>
        <tr><td className={styleTd.nmnb}>NMNB</td></tr>
        <tr><td className={styleTd.nmnr}>NMNR</td></tr>
        <tr><td className={styleTd.nm}>NM</td></tr>
        <tr><td className={styleTd.nbnr}>NBNR</td></tr>
        <tr><td className={styleTd.nb}>NB</td></tr>
        <tr><td className={styleTd.c}>ALL</td></tr>
        <tr><td>not-cleared</td></tr>
      </tbody>
    </table>
  )
}