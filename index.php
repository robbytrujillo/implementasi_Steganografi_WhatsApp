<?php
// 1. Buka file gambar
$image = imagecreatefromjpeg("coverImage/gambar.jpeg");
// 2. Tulis pesan yang ingin disisipkan
$message = "Apa Kabar?";

// 3. Ubah pesan menjadi biner
$binaryMessage = "";
for ($i = 0; $i < strlen($message); $i++) {
  $binaryMessage .= sprintf("%08b", ord($message[$i]));
}

// 4. Sisipkan pesan biner ke dalam pixel-pixel gambar
$index = 0;
for ($y = 0; $y < imagesy($image); $y++) {
  for ($x = 0; $x < imagesx($image); $x++) {
    
// 5. Sisipkan bit terakhir dari pesan biner ke dalam bit terakhir dari nilai pixel
  $color = imagecolorat($image, $x, $y);
  $r = ($color >> 16) & 0xFF;
  $g = ($color >> 8) & 0xFF;
  $b = $color & 0xFF;
  imagesetpixel($image, $x, $y, imagecolorallocate($image, $r, $g, $b | intval($binaryMessage[$index])));
  $index++;
  if ($index == strlen($binaryMessage)) {
    break;
  }
}
if ($index == strlen($binaryMessage)) {
    break;
  }
}

//6. Simpan gambar yang telah disisipkan pesan ke dalam file baru
imagejpeg($image, "steganografiImage/gambar_steganografi.jpeg");
?>