import NormalLayout from "@/app/_layout/normal"

import { Index } from "./posts/_components/post-index"
import { POST_DATA } from "./posts/data"

export default function Home() {
  return (
    <NormalLayout>
      <main>
        <div>
          {POST_DATA.map((n, i) => (
            <Index key={i} data={n} />
          ))}
        </div>
      </main>
    </NormalLayout>
  )
}