import { Metadata } from "next"

import NormalLayout from "@/app/_layout/normal"

export const metadata: Metadata = {
  title: 'Pages',
}

export default function Content() {
  return (
    <NormalLayout>
      <main>
        <h1>Pages</h1>

        <h2>プログラミング関連</h2>

        <ul>
          <li><a href="/pages/programming/license">ライセンスあれこれ</a></li>
        </ul>

        <h2>東方Project関連</h2>

        <ul>
          <li><a href="/pages/touhou/clear-table">クリア機体表</a></li>
          <li><a href="/pages/touhou/fanbooks-i-have">紙媒体で所有する・かつ既読の東方同人誌</a></li>
          <li><a href="/pages/touhou/gensou-no-yukue">『幻想の行方』解説</a></li>
          <li><a href="/pages/touhou/nameraka-na-uchuu-to-sono-teki">『なめらかな宇宙と、その敵。』解説</a></li>
        </ul>

        <h2>カレンダー</h2>

        <div className="ta-center" >
          <iframe
            src="https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%23ffffff&ctz=Asia%2FTokyo&showTitle=0&showPrint=0&showTz=0&showCalendars=0&showTabs=0&showDate=1&src=YWtpeWEua2F6dWtpLjEyMDdAZ21haWwuY29t&color=%23039BE5"
            width="600"
            height="450"
          />
        </div>
      </main>
    </NormalLayout>
  )
}