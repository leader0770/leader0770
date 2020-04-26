<?php
$admin = 'id raqamiz';
$token = 'token maydoni';

function bot($method,$datas=[]){
global $token;
    $url = "https://api.telegram.org/bot".$token."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$mid = $message->message_id;
$data = $update->callback_query->data;
$type = $message->chat->type;
$text = $message->text;
$cid = $message->chat->id;
$uid= $message->from->id;
$gname = $message->chat->title;
$left = $message->left_chat_member;
$new = $message->new_chat_member;
$name = $message->from->first_name;
$repid = $message->reply_to_message->from->id;
$repname = $message->reply_to_message->from->first_name;
$newid = $message->new_chat_member->id;
$leftid = $message->left_chat_member->id;
$newname = $message->new_chat_member->first_name;
$leftname = $message->left_chat_member->first_name;
$username = $message->from->username;
$cmid = $update->callback_query->message->message_id;
$cusername = $message->chat->username;
$repmid = $message->reply_to_message->message_id; 
$ccid = $update->callback_query->message->chat->id;
$cuid = $update->callback_query->message->from->id;
$cqid = $update->callback_query->id;

$photo = $update->message->photo;
$gif = $update->message->animation;
$video = $update->message->video;
$music = $update->message->audio;
$voice = $update->message->voice;
$sticker = $update->message->sticker;
$document = $update->message->document;
$for = $message->forward_from;
$forc = $message->forward_from_chat;
mkdir("pul");
mkdir("odam");
mkdir("qiwi");
$pul = file_get_contents("pul/$cid.txt");
$odam = file_get_contents("odam/$cid.dat");
$key = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"💳 Рефералы"],['text'=>"💰 Баланс"]],
[['text'=>"🚫Важно"],['text'=>"📊 Статистика"]],
]
]);

$key3 = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Назад"]],
]
]);

$key2 = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"◀️ Назад"],['text'=>"🔻 Вывод"]],
]
]);

$key4 = json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[['text'=>"✅ OK"]],
]
]);

if($text=="/start"){
$pul = file_get_contents("pul/$cid.txt");
$mm=$pul+0;
file_put_contents("pul/$cid.txt","$mm");
$odam = file_get_contents("odam/$cid.dat");
$kkd=$odam+0;
file_put_contents("odam/$cid.dat","$kkd");
bot('sendmessage',[
    'chat_id'=>$cid,
    'text'=>"🎯 Приветствую тебя снова!",
    'parse_mode'=>'html',
    'reply_markup'=>$key
    ]);
}
if(mb_stripos($text,"/start $cid")!==false){
bot('sendMessage',[
      'chat_id'=>$cid,
      'text'=>"📋 Главное меню!",
      'parse_mode'=>'html',
      'reply_markup'=>$key,
      ]);
}else{
      $idref = "pul/$ex.db";
      $idref2 = file_get_contents($idref);
      $id = "$cid\n";
      $handle = fopen($idref, 'a+');
      fwrite($handle, $id);
      fclose($handle);
if(mb_stripos($idref2,$cid) !== false ){
}else{
$pub=explode(" ",$text);
$ex=$pub[1];
$pul = file_get_contents("pul/$ex.txt");
$a=$pul+50;
file_put_contents("pul/$ex.txt","$a");
$odam = file_get_contents("odam/$ex.dat");
$b=$odam+1;
file_put_contents("odam/$ex.dat","$b");
bot('sendMessage',[
'chat_id'=>$cid,
'text'=>"💥 Приветствую своих друзей! <b>50 сум</b> будет дано за каждого человека, входящего в ваш реферал. Если вы соберете <b>5000сум</b>, ваши деньги будут переведены на ваш кошелек!

💰 Начать зарабатывать, нажав на <b>Рефералы</b>",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
bot('sendmessage',[
'chat_id'=>$ex,
'text'=>"💥 <b>50 сум</b> добавлено в ваш кошелек за приглашение друга.",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}
}
if($text=="◀️ Назад"){
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"🏡 Вы вернулись в главное меню!",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}
if($text=="✅ OK"){
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"🏡 Вы вернулись в главное меню!",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}
if($text=="💳 Рефералы"){
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"Ваша реферальная ссылка:
https://t.me/paynet_probot?start=$cid

Если пользователь перейдет по вашей ссылке вы получите 50сум.",
'parse_mode'=>'html',
'reply_markup'=>$key3,
]);
}
if($text=="💰 Баланс"){
$pul = file_get_contents("pul/$cid.txt");
$odam = file_get_contents("odam/$cid.dat");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"🆔 Мой id: <code>$cid</code>

🔸 Вас пригласили <b>$odam</b> пользователей
🔹 Ваш баланс: <b>$pul сум</b>",
'parse_mode'=>'html',
'reply_markup'=>$key2,
]);
}
if($text=="🔻 Вывод"){
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"Введите свой номер PAYNET

Например: +99899xxxxxxx

💸 Мин. сумма для вывода: <b>5000 сум</b>",   
'parse_mode'=>'html',
'reply_markup'=>$key3,
]);
}
if(mb_stripos($text,"+")!==false){
file_put_contents("qiwi/$cid.txt","$text");
$qiwi=file_get_contents("qiwi/$cid.txt");
$pul = file_get_contents("pul/$cid.txt");
$odam = file_get_contents("odam/$cid.dat");
if($pul>=10){
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"💳 Qiwi кошелек: <b>$qiwi</b>
💸 Для вывода: <b>$pul сум</b>

✔ Запрос получен. В течение 24 часов ваши деньги будут зачислены на ваш  номер.",
'parse_mode'=>'html',
'reply_markup'=>$key4
]);
bot('sendmessage',[
'chat_id'=>$admin,
'text'=>"Diqqat <b>$cid</b> pul yechmoqchi!

Qiwi raqami: <b>$qiwi</b>
Balansi: <b>$pul сум</b>
Taklif qilgan odamlari: <b>$odam</b> ta
ID raqami: <code>$cid</code>",
'parse_mode'=>'html',
]);
$pul = file_get_contents("pul/$cid.txt");
$k=$pul-$pul;
file_put_contents("pul/$cid.txt","$k");
$sum=file_get_contents("tolandi.txt");
$uio=$pul+$sum;
file_put_contents("tolandi.txt","$uio");
}else{
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"Ошибка! У вас недостаточно средств на счету.",
'parse_mode'=>'html',
'reply_markup'=>$key,
]);
}
}
if($text=="🚫Важно"){
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"✅ По вопросам @Abdullax_admin. Если вы хотите зарабатывать денги, вы должна подписаться наш 3 канал⚠
Пул ишламохчи болсангиз 3 та каналимизга обуна болин. Агар обуна болмай пул ишласангиз пулингиз куйип кетади ва толов килинмайди⚠
Потписайте👇 | Обуна болинг👇",
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>"1 канал👑",'url'=>"https://telegram.me/joinchat/AAAAAEKtWLXmlOh8UHMWtg"]],
[['text'=>"2 канал🔱",'url'=>"https://t.me/joinchat/AAAAAFMpkTFweZD4wPC-ig"]],
[['text'=>"3 канал оплаты💵",'url'=>"https://t.me/joinchat/AAAAAFYNokFOm2A8KvJPNw"]],
]
])
]);
}
if((mb_stripos($text,"/plus")!==false) and $cid==$admin){
$exx=explode(" ",$text);
$ex1=$exx[1];
$ex2=$exx[2];
$pul = file_get_contents("pul/$ex1.txt");
$rr=$pul+$ex2;
file_put_contents("pul/$ex1.txt","$rr");
$pul = file_get_contents("pul/$ex1.txt");
$odam = file_get_contents("odam/$ex1.dat");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"Diqqat <b>$ex1</b> ga <b>$ex2 сум</b> qo'shildi!

Balansi: <b>$pul сум</b>
ID raqami: <code>$ex1</code>",
'parse_mode'=>'html',
]);
bot('sendmessage',[
'chat_id'=>$ex1,
'text'=>"✅ Привет! <b>$ex2 сум</b> добавлено на ваш кошелек.

Текущий баланс: <b>$pul сум</b>",
'parse_mode'=>'html',
]);
}
if((mb_stripos($text,"/minus")!==false) and $cid==$admin){
$exxx=explode(" ",$text);
$ex3=$exxx[1];
$ex4=$exxx[2];
$pul = file_get_contents("pul/$ex3.txt");
$rr=$pul-$ex4;
file_put_contents("pul/$ex3.txt","$rr");
$pul = file_get_contents("pul/$ex3.txt");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"Diqqat <b>$ex1</b> dan <b>$ex2 сум</b> olib tashlandi!

Balansi: <b>$pul сум</b>
ID raqami: <code>$ex1</code>",
'parse_mode'=>'html',
]);
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"✅ <b>$ex2 сум</b> было получено от вас за нарушение правил!

Текущий баланс: <b>$pul сум</b>",
'parse_mode'=>'html',
]);
}
$lichka = file_get_contents("lichka.db");
$xabar = file_get_contents("xabarlar.txt");

if($type=="private"){
if(strpos($lichka,"$cid") !==false){
}else{
file_put_contents("lichka.db","$lichka\n$cid");
}
} 
$reply = $message->reply_to_message->text;
$rpl = json_encode([
            'resize_keyboard'=>false,
            'force_reply'=>true,
            'selective'=>true
        ]);
if($text=="/send" and $cid==$admin){
  bot('sendmessage',[
    'chat_id'=>$admin,
    'text'=>"Yuboriladigan xabar matnini kiriting!",
    'parse_mode'=>"html",
]);
    file_put_contents("xabarlar.txt","user");
}
if($xabar=="user" and $cid==$admin){
if($text=="/cancel"){
	file_put_contents("xabarlar.txt","");
}else{
  $lich = file_get_contents("lichka.db");
  $lichka = explode("\n",$lich);
  foreach($lichka as $lichkalar){
  $okuser=bot("sendmessage",[
    'chat_id'=>$lichkalar,
    'text'=>$text,
    'parse_mode'=>'html'
]);
}
if($okuser){
  bot("sendmessage",[
    'chat_id'=>$admin,
    'text'=>"Hamma userlarga yuborildi!",
    'parse_mode'=>'html',
]);
  file_put_contents("xabarlar.txt","");
}
}
}
$sum=file_get_contents("tolandi.txt");
if($text=="📊 Статистика"){
$soat = date('H:i', strtotime('5 hour'));
$sana = date('d-M Y',strtotime('5 hour'));
$sum=file_get_contents("tolandi.txt");
$lich = substr_count($lichka,"\n");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"📶 Пользователей всего: <b>$lich</b>
💳 Выплачено денег: <b>$sum сум</b>",
'parse_mode'=>'html',
'reply_markup'=>$key3,
]);
}
if(mb_stripos($text,"/pul")!==false){
$him=explode(" ",$text);
$hm=$him[1];
file_put_contents("tolandi.txt","$hm");
$sum=file_get_contents("tolandi.txt");
bot('sendmessage',[
'chat_id'=>$cid,
'text'=>"$sum сум qo'shildi!",
'parse_mode'=>'html',
]);
}
///////////////////////////////@SystemUz\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
iltimos kodni manbasi bilan oling. manba @Xvest. hech bo'lmasa @SystemUz dan sovg'a deb qo'yarsz bu yog'i vijdonizga bog'liq