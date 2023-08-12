import { Codeblock, Language } from "@/app/components/codeblock";
import { Deadline } from "../deadline";
import { Headline } from "../headline";

export default function Content() {
  const url = "allocate-descriptor-sets";
  return (
    <main>
      <Headline url={url} />
      <h2>概要</h2>

      <p>
        VkDescriptorPoolSize構造体は、ディスクリプタプールに含まれるディスクリプタの種類とそれぞれの数を指定する。
        VkDescriptorPoolCreateInfo構造体へ配列で渡され、vkCreateDescriptorPool関数によりディスクリプタプールオブジェクトが生成される。
        このディスクリプタプールオブジェクトをもとに、vkAllocateDescriptorSets関数によりメモリを確保する。
      </p>

      <p>
        状況に対して誤ったVkDescriptorPoolSize構造体配列を作成しても、次の環境ではエラーが検出されず、かつ期待通りの結果が得られた。
      </p>

      <ul>
        <li>OS:  Windows 10, Ubuntu 22.04.1</li>
        <li>CPU: AMD Ryzen 5 3600</li>
        <li>GPU: NVIDIA GeForce GTX 1650</li>
      </ul>

      <p>
        また、以下の環境では、vkAllocateDescriptorSets関数の返り値が VK_ERROR_OUT_OF_POOL_MEMORY となった。
      </p>

      <ul>
        <li>OS:  Windows 10, Archlinux</li>
        <li>CPU: AMD Ryzen 5 3500U</li>
        <li>GPU: Radeon Vega 8 Graphics</li>
      </ul>

      <h2>詳細</h2>

      <p>
        一つの Uniform Buffer と一つの Combined Image Sampler をバインディングとして持つとすると、
        VkDescriptorPoolSize構造体配列は、以下のようにならなければならない。
      </p>

      <Codeblock lang={Language.C} code={`const VkDescriptorPoolSize desc_pool_sizes[] = {
  {
    VK_DESCRIPTOR_TYPE_UNIFORM_BUFFER,
    1,
  },
  {
    VK_DESCRIPTOR_TYPE_COMBINED_IMAGE_SAMPLER,
    1,
  },
};`} />

      <p>
        しかし、以下のようにしても異常が検出されず、かつ期待通りに動作してしまった。
      </p>

      <Codeblock lang={Language.C} code={`const VkDescriptorPoolSize desc_pool_sizes[] = {
  {
    VK_DESCRIPTOR_TYPE_UNIFORM_BUFFER,
    2,
  },
};`} />

      <p>
        また、以下のようにしても同様である。
      </p>

      <Codeblock lang={Language.C} code={`const VkDescriptorPoolSize desc_pool_sizes[] = {
  {
    VK_DESCRIPTOR_TYPE_UNIFORM_BUFFER,
    1,
  },
  {
    VK_DESCRIPTOR_TYPE_SAMPLER,
    1,
  },
};`} />

      <p>
        非内蔵GPUでは、上手いことしてくれるのかもしれないが、バグの発見が遅れるのでやめてほしい。
      </p>
      
      <Deadline url={url} />
    </main>
  )
}