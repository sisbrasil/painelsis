<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT']."/class/conexao.php");


echo('<pre>');

$topo = '{
"status": 200,
"data": {
"prev_page": null,
"next_page": null,
"has_prev": false,
"has_next": false,
"total": 10,
"current_page": 1,
"pages": 1,
"results": [';
$rodape = '
  ]
 }
}';
$id_login = $_SESSION['painel']['login'];
$result_produtos_login = "SELECT * FROM usuario WHERE login LIKE '$id_login'";
$resultado_produtos_login = mysqli_query($conn, $result_produtos_login);
while ($row_produto_login = mysqli_fetch_assoc($resultado_produtos_login)) {
  $db_user_id_up = $row_produto_login['id'];
  $db_token_up = $row_produto_login['token'];
}
$result_produtos2 = "SELECT * FROM config WHERE status LIKE 'ACTIVE' && user_id LIKE '$db_user_id_up' LIMIT 100";
$resultado_produtos2 = mysqli_query($conn, $result_produtos2);
while ($row_produto2 = mysqli_fetch_assoc($resultado_produtos2)) {

  $config_cat1 = '"category": { "name": "SEM CATEGORIA", "id": '.$row_produto2['category_id'].', "status": "ACTIVE", "sort_order": 1000, "user_id": '.$row_produto2['user_id'].', "slug": "", "description": "" }';

  $db_cat_category_id = $row_produto2['category_id'];
  $result_produtos3 = "SELECT * FROM categoria WHERE id='$db_cat_category_id' && status LIKE 'ACTIVE' && user_id LIKE '$db_user_id_up' LIMIT 1";
  $resultado_produtos3 = mysqli_query($conn, $result_produtos3);
  while ($row_produto3 = mysqli_fetch_assoc($resultado_produtos3)) {

    $config_cat1 = '
    "category": {
    "name": "'.$row_produto3['name'].'",
    "id": '.$row_produto2['category_id'].',
    "category_color": "'.$row_produto3['category_color'].'",
    "status": "'.$row_produto3['status'].'",
    "sort_order": '.$row_produto3['sort_order'].',
    "user_id": '.$row_produto2['user_id'].',
    "slug": "'.$row_produto3['slug'].'",
    "description": "'.$row_produto3['description'].'"
      }';
  }

  $payload = $row_produto2['payload'];
  $payload = str_replace('99r99', '\r', $payload);
  $payload = str_replace('99n99', '\n', $payload);

  $config_payloads2 = $config_payloads;
  $config_payloads = '
{
  "name": "'.$row_produto2['name'].'",
  "SSH": "'.$row_produto2['SSH'].'",
  "server_hostname": "'.$row_produto2['server_hostname'].'",
  "description": "'.$row_produto2['description'].'",
  "username": "'.$row_produto2['username'].'",
  "server_port": '.$row_produto2['server_port'].',
  "icon_image": "'.$row_produto2['icon_image'].'",
  "user_id": '.$row_produto2['user_id'].',
  "password": "'.$row_produto2['password'].'",
  "udp_port": "'.$row_produto2['udp_port'].'",
  "category_id": '.$row_produto2['category_id'].',
  "v2ray_uuid": "'.$row_produto2['v2ray_uuid'].'",
  "primary_dns_server": "'.$row_produto2['primary_dns_server'].'",
  "payload": "'.$payload.'",
  "status": "'.$row_produto2['status'].'",
  "secondary_dns_server": "'.$row_produto2['secondary_dns_server'].'",
  "sni": "'.$row_produto2['sni'].'",
  "config_mode": "'.$row_produto2['config_mode'].'",
  "config_v2ray": "'.$row_produto2['config_v2ray'].'",
  "url_check_user": "'.$row_produto2['url_check_user'].'",
  "config_openvpn": "'.$row_produto2['ovpn_config'].'",
  "proxy_hostname": "'.$row_produto2['proxy_hostname'].'",
  "sort_order": '.$row_produto2['sort_order'].',
  "id": '.$row_produto2['id'].',
  "proxy_port": '.$row_produto2['proxy_port'].','.$config_cat1.'
 }';

  if ($config_payloads2 != "") {
    $config_payloads2 = $config_payloads2.",";
  }
  $config_payloads = $config_payloads2.$config_payloads;
}
$tudo = json_decode($topo.$config_payloads.$rodape);
$data = json_encode($tudo, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
print_r($data);
?>