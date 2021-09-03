
<p>名前：{{ $data['name'] }}さん</p>
<p>メールアドレス：{{ $data['email'] }}</p>
<p>---以下メッセージが送信されました---</p>
<p>{!! nl2br( $data['message'] ) !!}</p>