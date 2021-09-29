# README

## line-new-post
WordPressに新規投稿をした際に公式LINEに投稿を知らせるプログラム．

## 実行環境
WordPress上で動作．

## 事前準備
1. LINE公式アカウントの作成
2. チャンネルアクセストークンの取得
3. CodeSnippetsなどの導入

## 使い方
1. `main.php`の内容をWordPressテーマディレクトリ内の`function.php`に書き移すか，CodeSnippetsプラグインに追加する．
2. チャンネルアクセストークンを取得したものに置き換える．
3. 記事を投稿すると公式LINEにサムネイル画像とタイトル，記事へのリンクが送信される．

## 注意点
環境やWordPressのバージョンによってはサムネイル画像がうまく取得できなかったり，投稿がうまく行かない場合がある．
記事を一度下書き保存してからクイック編集で公開するとうまく行くことがある．

## ライセンス
"line-new-post" is under [MIT license](https://en.wikipedia.org/wiki/MIT_License).

## リンク
- [作者のページ](https://okinotori.net/archives/414)