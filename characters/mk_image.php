<?php
  // phpinfo();
  // var_dump(gd_info());

  header("Content-type: image/png");

  $string = $_GET[text];
  // 6 hexadecimal digits for RGB
  $is_active = $_GET[active];
  $width = $_GET[width];

  $active_rgb = 'dcdcdc';
  $inactive_rgb = 'a0a0a0';
  $text_rgb = '000000';
  $height = 25;
  $radius = 4;
  $font = 4;
  $im = @imageCreateTrueColor($width, $height)
     or die("Cannot Initialize new GD image stream");
  $active = imageColorAllocate($im, hexdec('0x' . substr($active_rgb, 0, 2)), hexdec('0x' . substr($active_rgb, 2, 2)), hexdec('0x' . substr($active_rgb, 4, 2)));
  $inactive = imageColorAllocate($im, hexdec('0x' . substr($inactive_rgb, 0, 2)), hexdec('0x' . substr($inactive_rgb, 2, 2)), hexdec('0x' . substr($inactive_rgb, 4, 2)));
  $text_color = imageColorAllocate($im, hexdec('0x' . substr($text_rgb, 0, 2)), hexdec('0x' . substr($text_rgb, 2, 2)), hexdec('0x' . substr($text_rgb, 4, 2)));
  $black = imageColorAllocate($im, 0, 0, 0);
  $white = imageColorAllocate($im, 255, 255, 255);
  // fill full rectangle with white
  imageFill($im, 0, 0, $white);
  imageLine($im, 0, $radius, 0, $height - 5, $black);
  imageArc($im, $radius, $radius, $radius * 2, $radius * 2, 180, 270, $black);
  imageLine($im, $radius, 0, $width - $radius, 0, $black);
  imageArc($im, $width - $radius, $radius, $radius * 2, $radius * 2, 270, 0, $black);
  imageLine($im, $width - 1, $radius, $width - 1, $height - 5, $black);
  imageLine($im, 0, $height - 1, $width, $height - 1, $black);
  if (!$is_active) {
    imageLine($im, 0, $height - 5, $width, $height - 5, $black);
    imageFillToBorder($im, $width / 2, 2, $black, $inactive);
  }
  imageFillToBorder($im, $width / 2, $height - 2, $black, $active);
  imageString($im, $font, $radius, $radius,  $string, $text_color);

  imagePNG($im);
  imageDestroy($im);
?>
