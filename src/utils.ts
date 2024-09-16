/**
 * ファイルパスから拡張子を除くファイル名を取得する関数。
 */
export function getId(file: string): string {
	const filename = file.split("/").slice(-1)[0];
	return filename.substring(0, filename.indexOf("."));
}
