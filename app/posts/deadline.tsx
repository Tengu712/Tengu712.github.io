import { POSTS_DATA, POST_DATA } from "./data"
import style from "./deadline.module.css"

type Props = {
  url: string,
}

type PropsPrevNextLink = {
  text: string,
  data: POST_DATA,
}

function getPrevNext(url: string): [POST_DATA | null, POST_DATA | null] {
  let prev = null
  let next = null
  let flag = false
  for (const n of POSTS_DATA) {
    if (flag) {
      prev = n
      break
    }
    if (n.url === url) {
      flag = true
      continue
    }
    next = n
  }
  return [prev, next]
}

function PrevNextLink({ text, data }: PropsPrevNextLink) {
  return (
    <div>
      <div>{text}</div>
      <div><a href={'./' + data.url}>{data.title}</a></div>
    </div>
  )
}

export function Deadline({ url }: Props) {
  const [prev, next] = getPrevNext(url)
  return (
    <>
      <p className="ta-right">■</p>
      <hr />
      <div className={style.links}>
        {next !== null && <PrevNextLink text="Next Article" data={next} />}
        {prev !== null && <PrevNextLink text="Prev Article" data={prev} />}
      </div>
    </>
  )
}