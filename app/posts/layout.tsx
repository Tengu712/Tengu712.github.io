import NormalLayout from "@/app/_layout/normal"

export default function Layout({
  children,
}: {
  children: React.ReactNode
}) {
  return (
    <NormalLayout>
      {children}
    </NormalLayout>
  )
}