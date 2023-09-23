import PlainLayout from "@/app/_layout/plain"

export default function Layout({
  children,
}: {
  children: React.ReactNode
}) {
  return (
    <PlainLayout>
      {children}
    </PlainLayout>
  )
}