export type PostData = {
  url: string;
  title: string;
  date: string;
  tags: string[];
}

export const POST_DATA: PostData[] = [
  {
    url: 'ai-illustration',
    title: 'AI絵を不快に感じる理由',
    date: '2023/6/13',
    tags: ['essay'],
  },
  {
    url: 'allocate-descriptor-sets',
    title: 'VkDescriptorPoolSizeの誤りが検出されない',
    date: '2023/5/17',
    tags: ['vulkan'],
  },
  {
    url: 'solink-speed',
    title: '動的リンクライブラリの暗黙的/動的リンクの速度比較',
    date: '2023/3/30',
    tags: ['experiment'],
  },
  {
    url: 'com-in-rust',
    title: 'COMの構造とRust FFIで扱う手法',
    date: '2023/3/22',
    tags: ['windowsapi', 'rust'],
  },
  {
    url: 'stdout-speed',
    title: 'printf vs fwrite',
    date: '2023/3/20',
    tags: ['experiment'],
  },
  {
    url: 'enum-windows',
    title: 'ウィンドウアプリケーションの列挙',
    date: '2023/2/14',
    tags: ['windowsapi'],
  },
  {
    url: 'windows-to-ubuntu',
    title: 'WindowsからUbuntuへ',
    date: '2022/11/22',
    tags: ['os', 'diary'],
  },
  {
    url: 'start',
    title: 'ブログ開設',
    date: '2022/11/21',
    tags: ['diary'],
  },
]

export function getPostData(url: string): PostData | undefined {
  return POST_DATA.find((n) => n.url === url)
}
