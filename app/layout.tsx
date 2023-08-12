import './default.css'
import { Header } from './components/header'
import { Footer } from './components/footer'
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
      <body>
        <Header />
        <div id='content'>
          {children}
        </div>
        <Footer />
      </body>
    </html>
  )
}
