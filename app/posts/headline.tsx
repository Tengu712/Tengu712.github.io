import { PostData } from "./data";
import style from "./headline.module.css"

type Props = {
  data: PostData,
}

export function Headline({ data }: Props) {
  if (data === undefined) {
    return (
      <></>
    )
  }
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