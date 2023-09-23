import style from "./quoteblock.module.css"

type Props = {
  cite?: string,
}

export function Quoteblock({ cite, children }: Props & {children: React.ReactNode}) {
  return (
    <blockquote className={style.quoteblock}>
      {children}
      { cite !== undefined && (<cite>{cite}</cite>) }
    </blockquote>
  )
}