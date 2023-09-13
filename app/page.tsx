import { POST_DATA } from "./posts/data"
import { Index } from "./posts/post-index"

export default function Home() {
  return (
    <main>
      <div>
        {POST_DATA.map((n, i) => (
          <Index key={i} data={n} />
        ))}
      </div>
    </main>
  )
}
