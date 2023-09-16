import style from './post-index.module.css'

import { PostData } from "../data"

type Props = {
  data: PostData,
}

export function Index({ data }: Props) {
  return (
    <div className={style.all}>
      <div className={style.title}>
        <a href={'posts/' + data.url}>{data.title}</a>
      </div>
      <div className={style.tags}>
        {data.tags.map((n, i) => (
          <span key={i}>#{n}</span>
        ))}
        <span>{data.date}</span>
      </div>
    </div>
  )
}