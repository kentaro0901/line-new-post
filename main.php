<?php
add_action('transition_post_status', function($new_status, $old_status, $post){ // 記事投稿時に実行
	if ('publish' == $new_status && 'publish' != $old_status && 'post' == $post->post_type) { // 記事が公開状態になったなら
	
		/* 投稿準備 */
		$channelToken = ''; // チャンネルアクセストークン
		$headers = [
			'Authorization: Bearer ' . $channelToken,
			'Content-Type: application/json; charset=utf-8',
		];
		
		/* 投稿内容 */
		$defaultImageUrl = ''; // デフォルトサムネイルのパス
		$template = [
			'type'    => 'buttons',
			'thumbnailImageUrl' => get_the_post_thumbnail_url($post, 'medium') ?: $defaultImageUrl,
			'title'   => mb_substr($post->post_title, 0, 40),
			'text'    => mb_substr(strip_tags($post->post_content), 0, 60, 'UTF-8'),
			'actions' => [
				[
					'type' => 'uri',
					'uri' => esc_url(get_permalink($post->ID)),
					'label' => 'ウェブサイトへ',
				],				
			],
		];
		$line = [
			'messages' => [
				[
					'type'     => 'template',
					'altText'  => '記事が投稿されました',
					'template' => $template,
				],
			],
		];
		
		/* 投稿実行 */
		$line = json_encode($line); // JSONにエンコード
		$ch = curl_init('https://api.line.me/v2/bot/message/broadcast'); // データ転送初期化
		$options = [
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER => true,
			CURLOPT_POSTFIELDS => $line,
		];
		curl_setopt_array($ch, $options); // オプションの指定
		curl_exec($ch); // 転送の実行
		curl_close($ch); // 転送終了
	}
}, 10, 3);