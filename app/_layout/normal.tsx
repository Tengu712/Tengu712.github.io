import { Header } from "@/app/_components/header"
import { Footer } from "@/app/_components/footer"

import style from "./normal.module.css"

export default function NormalLayout({
  children,
}: {
  children: React.ReactNode
}) {
  return (
    <body className={style.body}>
      <Header />
      <div className={style.content}>
        {children}
      </div>
      <Footer />
    </body>
  )
}