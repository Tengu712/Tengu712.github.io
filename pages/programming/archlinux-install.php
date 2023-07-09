<!DOCTYPE html>
<html lang="ja">

<head>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/head.html"); ?>
    <title>Archlinux インストール手順</title>
</head>

<body>
    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/header.html"); ?>

    <div id="content-wrapper">
        <div id="content">

            <h1>Archlinux インストール手順</h1>

            <hr>

            <h2>Live USB起動</h2>

            <p><a href="https://www.archlinux.jp/download/">ここから</a>ISOをダウンロードして、<a
                    href="https://rufus.ie/ja/">Rufus</a>でLive USBを作成。</p>
            <p>Live USBを起動して「Arch Linux install medium (x86_64, UEFI)」を選択。Wifiに接続する場合は以下のように：</p>
            <pre class="codeblock">root@archiso ~ # iwctl
[iwd]# device list
[iwd]# station wlan0 scan
[iwd]# station wlan0 get-networks
[iwd]# station wlan0 connect SSID
[iwd]# exit</pre>

            <h2>archinstall</h2>

            <p>archinstallを実行。</p>
            <pre class="codeblock">root@archiso ~ # archinstall</pre>
            <p>以下のように設定（初期値から変更するもののみ掲載）：</p>
            <table>
                <tr>
                    <th>Key</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>Keyboard layout</td>
                    <td>jp106</td>
                </tr>
                <tr>
                    <td>Mirror region</td>
                    <td>['Japan']</td>
                </tr>
                <tr>
                    <td>Drive(s)</td>
                    <td>(インストール先を選択)</td>
                </tr>
                <tr>
                    <td>Disk layout</td>
                    <td>(Wipe all selected... → ext4 → yes)</td>
                </tr>
                <tr>
                    <td>Root password</td>
                    <td>(パスワード)</td>
                </tr>
                <tr>
                    <td>User account</td>
                    <td>(Add a userから指示に従って)</td>
                </tr>
                <tr>
                    <td>Profile</td>
                    <td>Profile(minimal)</td>
                </tr>
                <tr>
                    <td>Audio</td>
                    <td>No audio server</td>
                </tr>
                <tr>
                    <td>Additional Packages</td>
                    <td>['sudo', 'networkmanager']</td>
                </tr>
                <tr>
                    <td>Timezone</td>
                    <td>Japan</td>
                </tr>
            </table>
            <p>「Install」を押してエンターを押すとインストールが始まる。完了するとchrootに入るか訊かれるので「no」のあと、再起動。</p>
            <pre class="codeblock">root@archiso ~ # reboot</pre>

            <h2>Wifiに接続</h2>

            <p>NetworkManagerでWifiに接続するならば以下のように：</p>
            <pre class="codeblock">$ sudo systemctl start NetworkManager.service
$ sudo systemctl enable NetworkManager.service
$ nmcli device wifi connect SSID password PASSWORD</pre>

            <h2>Wayland+Sway</h2>

            <p>GUI環境は以下のような組み合わせとする：</p>
            <table>
                <tr>
                    <th>What for</th>
                    <th>Application</th>
                </tr>
                <tr>
                    <td>Display server</td>
                    <td>Wayland</td>
                </tr>
                <tr>
                    <td>Window manager</td>
                    <td>Sway</td>
                </tr>
                <tr>
                    <td>Status bar</td>
                    <td>Waybar</td>
                </tr>
                <tr>
                    <td>Terminal emulator</td>
                    <td>Wezterm</td>
                </tr>
                <tr>
                    <td>Application launcher</td>
                    <td>Wofi</td>
                </tr>
                <tr>
                    <td>Audio server</td>
                    <td>Pipewire</td>
                </tr>
            </table>
            <p>まずは以下のようにインストール：</p>
            <pre class="codeblock">$ sudo pacman -S wayland
$ sudo pacman -S sway swaybg waybar noto-fonts otf-font-awesome
$ sudo pacman -S wezterm
$ sudo pacman -S wofi</pre>
            <p>設定ファイルをコピーして編集：</p>
            <pre class="codeblock">$ mkdir ~/.config
$ mkdir ~/.config/sway
$ cp /etc/sway/config ~/.config/sway
$ vim ~/.config/sway/config
...
set $term wezterm
...
set $menu wofi -G --show drun | xargs swaymsg exec --
...
bindsym Mod4+space exec $term
...
bar {
    swaybar_command waybar
    ...
}
...
input * {
    xkb_layout "jp"
}
...</pre>

            <h2>日本語化</h2>

            <pre class="codeblock">$ sudo pacman -S noto-fonts-cjk noto-fonts-emoji</pre>

            <h2>参考文献</h2>

            <ol>
                <li><a href="https://aodag.dev/posts/2021-12-16-sway/">Atsushi Odagiri, swayでwayland</a></li>
                <li><a href="https://mako-note.com/ja/sway-desktop-environment-in-archlinux/">mako, Arch Linux での sway
                        デスクトップ環境の構築</a></li>
            </ol>

        </div>
    </div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . "/template/footer.html"); ?>

</body>

</html>