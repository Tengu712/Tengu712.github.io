"use client"

import style from './header.module.css'
import { useEffect, useRef, useState } from 'react'

export function Header() {
  const [height, setHeight] = useState(40)
  const ref = useRef<HTMLDivElement>(null);
  useEffect(() => {
    if (ref.current) {
      setHeight(ref.current.clientHeight);
    }
  }, [ref])
  return (
    <>
      <div className={style.header} ref={ref}>
        <div className={style.logo}><a href="/">天狗会議録</a></div>
        <div className={style.menu}><a href="/">Posts</a></div>
        <div className={style.menu}><a href="/pages">Pages</a></div>
        <div className={style.menu}><a href="/about">About</a></div>
      </div>
      <div className={style.spacer} style={{ height: height }}></div>
    </>
  )
}