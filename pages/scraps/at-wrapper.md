---
title: .at()のラッパー関数を作るのが難しい
topic: c/cpp
tags: []
index: false
---

C++のコンテナ型の.at()は頻繁に呼ばれる関数であるにも拘らず例外から得られる情報が少ない。
ので、ラッパー関数を作りたい。
このとき、返戻値の型周辺で面倒事が起こる。

`value_type`で定義すると、`std::vector`は良いが、`std::unordered_map`は型の違いによりコンパイルエラーが生じる。`std::unordered_map<U, V>`の`value_type`は`std::pair<const U, V>`であり、`.at()`の返戻値の型`V`と異なるためである。同様に、`mapped_type`で定義すると、`std::unordered_map`は良いが、`std::vector`には定義されていないためコンパイルエラーが生じる。

```cpp
#include <format>
#include <string>
#include <unordered_map>

template<typename T, typename U>
const typename T::value_type &at(const T &c, const U &k, const std::string &s) {
	try {
		return c.at(k);
	} catch (const std::out_of_range &) {
		throw std::out_of_range(std::format("the key '{}' is invalid for {}.", k, s));
	}
}

int main() {
	const std::unordered_map<int, int> m;
	const auto &a = at(m, 0, "m");
	return 0;
}
```

`auto`で定義すると、参照ではなく値を返す関数とみなされ、参照として受け取れない。

```cpp
#include <format>
#include <string>
#include <unordered_map>

template<typename T, typename U>
auto at(const T &c, const U &k, const std::string &s) {
	try {
		return c.at(k);
	} catch (const std::out_of_range &) {
		throw std::out_of_range(std::format("the key '{}' is invalid for {}.", k, s));
	}
}

int main() {
	const std::unordered_map<int, int> m;
	const auto &a = at(m, 0, "m"); // 一時オブジェクトの参照取得によりコンパイルエラー
	return 0;
}
```

`const auto &`や`decltype(c.at(k))`で定義すると、Ubuntuのg++の`-Wextra`では参照ではなく値を返す関数とみなされ、参照として受け取れない。CIでbuild-essentialのみインストールして警告を強めに出しているいる場合は詰むことになる。

```cpp
// g++ --std=c++20 -Wall -Werror -Wextra main.cpp
#include <unordered_map>

template<typename T, typename U>
const auto &at1(const T &c, const U &k) {
	try {
		return c.at(k);
	} catch (...) {
		throw "at1";
	}
}

template<typename T, typename U>
auto at2(const T &c, const U &k) -> decltype(c.at(k)) {
	try {
		return c.at(k);
	} catch (...) {
		throw "at2";
	}
}

int main() {
	const std::unordered_map<int, int> m;
	const auto &a = at1(m, 0); // 一時オブジェクトの参照取得によりコンパイルエラー
	const auto &b = at2(m, 0); // 一時オブジェクトの参照取得によりコンパイルエラー
	(void)a;
	(void)b;
	return 0;
}
```

`std::invoke_result_t`で定義すると、`.at()`がconst版と非const版でオーバーロードされているために型を推論できずコンパイルエラーが生じる。

```cpp
#include <format>
#include <string>
#include <type_traits>
#include <unordered_map>

template<typename T, typename U>
std::invoke_result_t<decltype(&T::at), U> at(const T &c, const U &k, const std::string &s) {
	try {
		return c.at(k);
	} catch (const std::out_of_range &) {
		throw std::out_of_range(std::format("the key '{}' is invalid for {}.", k, s));
	}
}

int main() {
	const std::unordered_map<int, int> m;
	const auto &a = at(m, 0, "m"); // 一時オブジェクトの参照取得によりコンパイルエラー
	return 0;
}
```
