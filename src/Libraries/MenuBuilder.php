<?php

namespace IM\CI\Libraries;

class MenuBuilder
{

  public function __construct()
  {
    $this->uri = service('uri');
  }

  public function adminSidebarBuilder($array, $parent_id = 0, $parents = [])
  {
    $path = service('uri')->getPath();
    if ($parent_id == 0) {
      foreach ($array as $element) {
        if (($element['parent_id'] != 0) && !in_array($element['parent_id'], $parents)) {
          $parents[] = $element['parent_id'];
        }
      }
    }
    $menu_html = '';
    foreach ($array as $element) {
      if ($element['parent_id'] == $parent_id) {
        if (in_array($element['id'], $parents)) {
          if ($path == $element['url'])
            $menu_html .= '<li class="menu-item menu-item-submenu menu-item-open menu-item-here" aria-haspopup="true" data-menu-toggle="hover">';
          else
            $menu_html .= '<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">';
          $menu_html .= '<a href="javascript:;" class="menu-link menu-toggle">';
          $menu_html .= '<i class="menu-icon flaticon-responsive"></i>';
          $menu_html .= '<span class="menu-text">' . $element['title'] . '</span>';
          $menu_html .= '<i class="menu-arrow"></i>';
          $menu_html .= '</a>';
        } else {
          if ($element['parent_id'] == 0 && $element['icon'] == null && $element['url'] == null) {
            $menu_html .= '<li class="menu-section">';
            $menu_html .= '<h4 class="menu-text">' . $element['title'] . '</h4>';
            $menu_html .= '<i class="menu-icon ki ki-bold-more-hor icon-md"></i>';
          } else if ($element['parent_id'] == 0 && $element['icon'] != null && $element['url'] != null) {
            if ($path == $element['url'])
              $menu_html .= '<li class="menu-item menu-item-active" aria-haspopup="true">';
            else
              $menu_html .= '<li class="menu-item" aria-haspopup="true">';
            $menu_html .= '<a href="' . site_url($element['url']) . '" class="menu-link">';
            $menu_html .= '<i class="' . $element['icon'] . '"></i>';
            $menu_html .= '<span class="menu-text">' . $element['title'] . '</span></a>';
          } else {
            if ($path == $element['url'])
              $menu_html .= '<li class="menu-item menu-item-active" aria-haspopup="true">';
            else
              $menu_html .= '<li class="menu-item" aria-haspopup="true">';
            $menu_html .= '<a href="' . site_url($element['url']) . '" class="menu-link">';
            $menu_html .= '<i class="menu-bullet menu-bullet-dot"><span></span></i>';
            $menu_html .= '<span class="menu-text">' . $element['title'] . '</span></a>';
          }
        }
        if (in_array($element['id'], $parents)) {
          $height = count($parents) * 40;
          $menu_html .= '<div class="menu-submenu" kt-hidden-height="' . $height . '" style="">';
          $menu_html .= '<i class="menu-arrow"></i>';
          $menu_html .= '<ul class="menu-subnav">';
          $menu_html .= '<li class="menu-item menu-item-parent" aria-haspopup="true">';
          $menu_html .= '<span class="menu-link">';
          $menu_html .= '<span class="menu-text">' . $element['title'] . '</span>';
          $menu_html .= '</span>';
          $menu_html .= '</li>';
          $menu_html .= $this->adminSidebarBuilder($array, $element['id'], $parents);
          $menu_html .= '</ul>';
          $menu_html .= '</div>';
        }
        $menu_html .= '</li>';
      }
    }
    return $menu_html;
  }
}
