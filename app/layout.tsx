import './default.css'

import type { Metadata } from 'next'

export const metadata: Metadata = {
  title: '天狗会議録',
  description: 'Skydog Association',
}

export default function RootLayout({
  children,
}: {
  children: React.ReactNode
}) {
  return (
    <html lang='ja'>
      {children}
    </html>
  )
}