---
title: Vulkanの座標系
topic: vulkan
tags: []
index: false
---

[Vulkan 1.4.335 - A Specification (with all registered extensions)](https://registry.khronos.org/vulkan/specs/latest/html/vkspec.html#preamble)
の中の座標系に関する部分をつまみ食いする。

パイプラインの一連の流れは「10. Pipelines」に書かれている。
パイプライン上の各シェーダはざっくり下のように構造化される:

1. プリミティブ処理
   - Primitive Shading
      1. Vertex Shader
      2. Tessellation Control Shader (optimal)
      3. Tessellation Evaluation Shader (optimal)
      4. Geometry Shader (optimal)
   - Mesh Shading
      1. Task Shader (optimal)
      2. Mesh Shader
2. フラグメント処理
   1. Fragment Shader

頂点処理終了時点の座標系はclip座標系である。
Clip座標系は3+1次元の同次座標系。
Clip座標を

$$
\begin{pmatrix}x_c\\y_c\\z_c\\w_c\end{pmatrix}
$$

と表すと、view volumeは

$$
\begin{gather*}
  -w_c \le x_c \le w_c\\
  -w_c \le y_c \le w_c\\
  z_m \le z_c \le w_c
\end{gather*}
$$

という制約に則る空間である(ただし、$z_m$はVulkanの拡張で$-w_c$にもできるが普通は0)。
さらに、このview volumeとユーザによって与えられた`CullDistance`との共通空間をclip volumeと言う。
このclip volume外のプリミティブは以降の処理で無視される[29.4. Primitive Clipping]。

ClipされたプリミティブはNDCに変換される。
NDCの座標は

$$
\begin{pmatrix}x_d\\y_d\\z_d\end{pmatrix}
=
\begin{pmatrix}x_c/w_c\\y_c/w_c\\z_c/w_c\end{pmatrix}
$$

である[29.7. Coordinate Transform]。

NDCは次のようにframebuffer coordinates $(x_f, y_f)$と深度$z_f$に変換される(ビューポート変換):

$$
\begin{gather*}
  x_f = \frac{p_x}{2}x_d + o_x\\
  y_f = \frac{p_y}{2}y_d + o_y\\
  z_f = p_z z_d + o_z
\end{gather*}
$$

ただし、`vk::Viewport(x, y, width, height, minDepth, maxDepth)`としたとき、

$$
\begin{align*}
  o_x &= \text{x} + \frac{\text{width}}{2}\\
  o_y &= \text{y} + \frac{\text{height}}{2}\\
  o_z &= \begin{cases}
      \text{minDepth} & \text{if $z_m = 0$,}\\
      \frac{\text{minDepth} + \text{maxDepth}}{2} & otherwise.
    \end{cases}\\
  p_x &= \text{width}\\
  p_y &= \text{height}\\
  p_z &= \begin{cases}
      \text{maxDepth} - \text{minDepth} & \text{if $z_m = 0$,}\\
      \frac{\text{maxDepth} - \text{minDepth}}{2} & otherwise.
    \end{cases}
\end{align*}
$$

である[29.9. Controlling the Viewport]。

ここで注意すべきことは:

- Framebuffer coordinatesと深度はそれぞれフレームバッファ上のレンダーターゲットであるカラーバッファとデプスバッファである
- テクスチャの座標系が左上原点$(0,0)$であることに注意すると、このビューポート変換によって上下が逆転する
- 上下逆転を嫌う場合、`height`を負の数にすると、上下逆転を実現できる(適切に`y`も指定する) [29.9. Controlling the Viewport]
- `minDepth`より`maxDepth`を大きくすることで深度値も逆転できる

また、31.10. Depth Testによると、$z_f$が$[0, 1]$に収まらない場合、次のようになる:

- `depthClampEnable`が有効化されている場合→$[0, 1]$外であってもその通りにクランプされる
- `depthClampEnable`が有効化されていない場合:
  - `depthClampZeroOne`が有効化されている場合:
    - 浮動小数点深度バッファを使っている場合→$[0, 1]$外であってもそのまま
    - 浮動小数点深度バッファを使っていない場合→$[0, 1]$にクランプされる
  - `depthClampZeroOne`が有効化されていない場合→未定義動作
