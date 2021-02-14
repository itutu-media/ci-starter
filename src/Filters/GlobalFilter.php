<?php

namespace IM\CI\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Encryption\Encryption;

class GlobalFilter implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = null)
  {
    $mBannedIP  = new \IM\CI\Models\App\M_bannedIP();
    $ips        = $mBannedIP->eksis()['rows'];
    $banned_ips = [];
    if (!empty($ips)) {
      foreach ($ips as $ip) {
        $banned_ips[] = $ip['ip'];
      }
    }
    if (in_array($_SERVER['REMOTE_ADDR'], $banned_ips)) {
      return 'Your IP has been banned!';
    }

    helper(['cookie', 'default']);
    if (getConfig('publicMaintenance') === TRUE) {
      echo view('IM\CI\Views\vPublicMaintenance');
      exit;
    }

    // if (get_cookie('setLang', true)) {
    //   session()->remove('setLang');
    //   session()->set('setLang', get_cookie('setLang', true));
    //   echo get_cookie('setLang');
    // }

    // if (!session('setLang')) {
    //   $userIP = getenv('REMOTE_ADDR');
    //   $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$userIP"));
    //   session()->remove('setLang');
    //   session()->set('setLang', strtolower($geo["geoplugin_countryCode"]));
    // }

    $defaultLocale = config('App')->defaultLocale;
    $supportedLocales = config('App')->supportedLocales;

    $langSlug = $request->uri->getSegment(1);
    if (isset($langSlug)) {
      if (in_array($langSlug, $supportedLocales)) {
        session()->remove('setLang');
        session()->set('setLang', $langSlug);
        if ($langSlug == $defaultLocale) {
          $segs = $request->uri->getSegments();
          $newUrl = '/';
          if (count($segs) > 1) {
            unset($segs[0]);
            $newUrl = implode('/', $segs);
          }
          return redirect()->to(site_url($newUrl));
        }
      }
    }

    if (!in_array(session('setLang'), $supportedLocales)) {
      session()->remove('setLang');
      session()->set('setLang', $defaultLocale);
    }

    // if (!get_cookie('setLang', true) || get_cookie('setLang', true) != session('setLang')) {
    //   setcookie('setLang', session('setLang'), time() + (10 * 365 * 24 * 60 * 60), '/', '', false, false);
    // }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
  }
}
