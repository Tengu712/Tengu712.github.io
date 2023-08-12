import { POSTS_DATA } from "./data";
import style from "./headline.module.css"

type Props = {
  url: string,
}

export function Headline({ url }: Props) {
  const data = POSTS_DATA.find((n) => n.url === url);
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