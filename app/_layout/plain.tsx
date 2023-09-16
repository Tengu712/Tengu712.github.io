export default function PlainLayout({
  children,
}: {
  children: React.ReactNode
}) {
  return (
    <body>
      <div>
        {children}
      </div>
    </body>
  )
}