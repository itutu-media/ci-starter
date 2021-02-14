<?php

if (!function_exists('encryptUrl')) {
  function encryptUrl($string)
  {
    $encrypter = \Config\Services::encrypter();
    $output = strtr(base64_encode($encrypter->encrypt($string)), '+/=', '-_~');
    return $output;
  }
}

if (!function_exists('decryptUrl')) {
  function decryptUrl($string)
  {
    $encrypter = \Config\Services::encrypter();
    $output = $encrypter->decrypt(base64_decode(strtr($string, '-_~', '+/=')));
    return $output;
  }
}

if (!function_exists('getConfig')) {
  function getConfig($name = NULL, $array = FALSE)
  {
    $mConfig = new \IM\CI\Models\App\M_configuration();
    if ($name)
      $config = $mConfig->where('name', $name)->first();
    else
      $config = $mConfig->findAll();

    if ($config) {
      if ($array)
        return $config;
      else
        return $config['value'];
    } else {
      return '-';
    }
  }
}

if (!function_exists('cetak')) {
  function cetak($string)
  {
    echo htmlentities($string, ENT_QUOTES, 'UTF-8');
  }
}

if (!function_exists('adminBreadcrumb')) {
  function adminBreadcrumb(array $segments = [])
  {
    $breadcrumb = $uri = '';
    if (count($segments) > 1) {
      $breadcrumb .= '
      <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">';
      foreach ($segments as $title => $url) {
        $uri .= $url . '/';
        if (end($segments) == $url) {
          $title = '<a href="#">' . $title . '</a>';
        } else {
          $title = '<a href="' . site_url($uri) . '" class="text-muted">' . $title . '</a>';
        }
        $breadcrumb .= '
          <li class="breadcrumb-item">
            ' . $title . '
          </li>';
      }
      $breadcrumb .= '</ul>';
    }
    return $breadcrumb;
  }
}

if (!function_exists('toRomawi')) {
  function toRomawi($number)
  {
    $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
    $returnValue = '';
    while ($number > 0) {
      foreach ($map as $roman => $int) {
        if ($number >= $int) {
          $number -= $int;
          $returnValue .= $roman;
          break;
        }
      }
    }
    return $returnValue;
  }
}

if (!function_exists('bulan')) {
  function bulan($bln)
  {
    switch ($bln) {
      case 1:
        return "Januari";
        break;
      case 2:
        return "Februari";
        break;
      case 3:
        return "Maret";
        break;
      case 4:
        return "April";
        break;
      case 5:
        return "Mei";
        break;
      case 6:
        return "Juni";
        break;
      case 7:
        return "Juli";
        break;
      case 8:
        return "Agustus";
        break;
      case 9:
        return "September";
        break;
      case 10:
        return "Oktober";
        break;
      case 11:
        return "November";
        break;
      case 12:
        return "Desember";
        break;
    }
  }
}

if (!function_exists('dateTimeIndo')) {
  function dateTimeIndo($datetime)
  {
    $datetime = explode(" ", $datetime);
    $tanggal = $datetime[0];
    $jam = explode(':', $datetime[1]);
    $ubah = gmdate($tanggal, time() + 60 * 60 * 8);
    $pecah = explode("-", $ubah);
    $tanggal = $pecah[2];
    $bulan = bulan($pecah[1]);
    $tahun = $pecah[0];
    return $jam[0] . ':' . $jam[1] . ' WIB ' . $tanggal . ' ' . $bulan . ' ' . $tahun;
  }
}

if (!function_exists('fullDateTimeIndo')) {
  function fullDateTimeIndo($datetime)
  {
    $datetime = explode(" ", $datetime);
    $tanggal = $datetime[0];
    $jam = $datetime[1];
    $ubah = gmdate($tanggal, time() + 60 * 60 * 8);
    $pecah = explode("-", $ubah);
    $tanggal = $pecah[2];
    $bulan = bulan($pecah[1]);
    $tahun = $pecah[0];
    return $jam . ' ' . $tanggal . '  ' . $bulan . ' ' . $tahun;
  }
}

if (!function_exists('changeUserDirName')) {
  function changeUserDirName($oldName, $newName)
  {
    $folderPath = ROOTPATH . 'public/uploads/';
    $oldDirName = $folderPath . $oldName;
    $newDirName = $folderPath . $newName;
    if (file_exists($oldDirName) && is_dir($oldDirName))
      rename($oldDirName, $newDirName);
  }
}
