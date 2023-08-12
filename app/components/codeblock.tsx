import style from "./codeblock.module.css"

export enum Language {
  C,
}

type Props = {
  lang: Language,
  code: string,
}

export function Codeblock({ lang, code }: Props) {
  return (
    <pre className={style.codeblock}>
      {code}
    </pre>
  )
}