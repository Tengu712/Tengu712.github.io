import style from "./headline.module.css"

import { PostData } from "../data";

type Props = {
  data: PostData,
}

export function Headline({ data }: Props) {
  return (
    <div>
      <h1>{data.title}</h1>
      <div className={style.tags}>
        {data.tags.map((n, i) => (
          <span key={i}>#{n}</span>
        ))}
        <span>{data.date}</span>
      </div>
      <hr />
    </div>
  )
}