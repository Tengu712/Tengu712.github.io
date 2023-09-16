import style from "./quoteblock.module.css"

type Props = {
  text: string,
  cite?: string,
}

export function Quoteblock({ text, cite }: Props) {
  return (
    <blockquote className={style.quoteblock}>
      <p>{text}</p>
      { cite !== undefined && (<cite>{cite}</cite>) }
    </blockquote>
  )
}