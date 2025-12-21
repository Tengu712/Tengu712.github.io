---
title: "CLIでiOSアプリビルド"
topic: "ios"
tags: ["cli"]
index: false
---

事前準備

- Xcodeをインストール
  - xcodesを使うと良い
- `xcode-select -p`でXcodeが指定されていることを確認
  - 指定されていないなら`sudo xcode-select --switch /path/to/Xcode`で指定する

スクリプト

```sh
#!/bin/bash -euo pipefail

# 定数定義
DEVICE_ID="00000000-0000-0000-0000-000000000000"
PROJECT_NAME="PROJECT_NAME"
SCHEME_NAME="SCHEME_NAME"
CONFIGURATION="Debug|Release"

# 定数定義(自動)
PROJECT_FILE="$PROJECT_NAME.xcodeproj"

# スキームが有効か確認
if ! xcodebuild -list -project "$PROJECT_FILE" 2>/dev/null | grep -q "^\s*${SCHEME_NAME}$"; then
	echo "error: scheme '$SCHEME_NAME' not found."
	echo "hint: available schemes:"
	xcodebuild -list -project "$PROJECT_FILE" | sed -n '/Schemes:/,/^$/p'
	exit 1
fi

# デバイスタイプ判定(デバイスorシミュレータ)
if xcrun devicectl list devices 2>/dev/null | grep -q "$DEVICE_ID"; then
	DEVICE_TYPE="physical"
	PLATFORM="iphoneos"
elif xcrun simctl list devices 2>/dev/null | grep -q "$DEVICE_ID"; then
	DEVICE_TYPE="simulator"
	PLATFORM="iphonesimulator"
else
	echo "error: device $DEVICE_ID not found."
	echo "hint: available physical devices:"
	xcrun devicectl list devices 2>/dev/null || true
	echo ""
	echo "hint: available simulators:"
	xcrun simctl list devices 2>/dev/null | grep -E "iPhone|iPad" || true
	exit 1
fi
echo "info: device type is $DEVICE_TYPE, the platform is $PLATFORM."

# シミュレータが起動しているか確認
if [ "$DEVICE_TYPE" = "simulator" ]; then
	if ! xcrun simctl list devices | grep "$DEVICE_ID" | grep -q "Booted"; then
		echo "error: simulator is not booted. boot it first."
		echo "hint: xcrun simctl boot $DEVICE_ID && open -a Simulator"
		exit 1
	fi
fi

# ビルド
# NOTE: 標準出力と標準エラーをxcodebuild.logにリダイレクト。
#       出力内容が煩わしいのと、LSPで使うので。
echo "trace: building..."
xcodebuild \
	-project "$PROJECT_FILE" \
	-scheme "$SCHEME_NAME" \
	-sdk "$PLATFORM" \
	-destination "platform=iOS Simulator,id=$DEVICE_ID" \
	-configuration "$CONFIGURATION" \
	build \
	&> xcodebuild.log
if [ "${PIPESTATUS[0]}" -ne 0 ]; then
	echo "error: build failed."
	exit 1
fi
echo "trace: build succeeded."

# .app生成確認
APP_PATH=$(find ~/Library/Developer/Xcode/DerivedData -name "$SCHEME_NAME.app" -type d | head -n 1)
if [ ! -d "$APP_PATH" ]; then
	echo "error: app path '$APP_PATH' not found."
	exit 1
fi
echo "info: app path is $APP_PATH."

# Bundle ID取得
BUNDLE_ID=$(/usr/libexec/PlistBuddy -c "Print :CFBundleIdentifier" "$APP_PATH/Info.plist")
echo "info: bundle id is $BUNDLE_ID"

# インストール&起動
echo "trace: install and launching..."
if [ "$DEVICE_TYPE" = "physical" ]; then
	xcrun devicectl device install app --device "$DEVICE_ID" "$APP_PATH"
	sleep 1
	xcrun devicectl device process launch --device "$DEVICE_ID" "$BUNDLE_ID"
else
	xcrun simctl install "$DEVICE_ID" "$APP_PATH"
	xcrun simctl launch "$DEVICE_ID" "$BUNDLE_ID"
fi
echo "trace: install and launch succeeded."
```
