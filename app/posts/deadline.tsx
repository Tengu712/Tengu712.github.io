import { POST_DATA, PostData } from "./data"
import style from "./deadline.module.css"

type Props = {
  data: PostData,
}

type PropsPrevNextLink = {
  text: string,
  data: PostData,
}

function getPrevNext(data: PostData): [PostData | null, PostData | null] {
  let prev = null
  let next = null
  let flag = false
  for (const n of POST_DATA) {
    if (flag) {
      prev = n
      break
    }
    if (n.url === data.url) {
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

export function Deadline({ data }: Props) {
  const [prev, next] = getPrevNext(data)
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
